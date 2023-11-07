<?php

namespace Modules\Pos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pos\Entities\Purchase;
use Modules\Pos\Entities\Warehouse;
use Modules\Pos\Entities\PurchaseProduct;
use Modules\Pos\Entities\PurchasePayment;
use Illuminate\Support\Facades\Crypt;
use App\Models\EmailTemplate;
use App\Models\User;
use Modules\Pos\Entities\PosUtility;
use Rawilk\Settings\Support\Context;
use Modules\Pos\Entities\WarehouseProduct;
use Modules\Pos\Events\CreatePaymentPurchase;
use Modules\Pos\Events\CreatePurchase;
use Modules\Pos\Events\DestroyPurchase;
use Modules\Pos\Events\PaymentDestroyPurchase;
use Modules\Pos\Events\ResentPurchase;
use Modules\Pos\Events\SentPurchase;
use Modules\Pos\Events\UpdatePurchase;
use Illuminate\Support\Facades\File;
use Modules\Pos\Entities\PurchaseAttachment;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(\Auth::user()->can('purchase manage'))
        {
            $vender=[];
            if(module_is_active('Account'))
            {
                $vender = \Modules\Account\Entities\Vender::where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
                $vender->prepend('Select Vendor', '');
            }

            $status =  \Modules\Pos\Entities\Purchase::$statues;
            $purchases =  \Modules\Pos\Entities\Purchase::where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get();
            return view('pos::purchase.index', compact('purchases', 'status','vender'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($vendorId)
    {
        if(\Auth::user()->can('purchase create'))
        {
            if(module_is_active('ProductService'))
            {
                $category=[];
                if(module_is_active('ProductService'))
                {
                    $category     = \Modules\ProductService\Entities\Category::where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->where('type', 2)->get()->pluck('name', 'id');
                    $category->prepend('Select Category', '');

                }
                if(module_is_active('CustomField')){
                    $customFields =  \Modules\CustomField\Entities\CustomField::where('workspace_id',getActiveWorkSpace())->where('module', '=', 'pos')->where('sub_module','purchase')->get();
                }else{
                    $customFields = null;
                }

                $purchase_number = Purchase::purchaseNumberFormat($this->purchaseNumber());

                $venders=[];
                if(module_is_active('Account'))
                {

                    $venders     =  User::where('type','vendor')->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->get()->pluck('name', 'id');
                    $venders->prepend('Select Vendor', '');
                }

                $warehouse     = Warehouse::where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
                $warehouse->prepend('Select Warehouse', '');

                $product_services=[];
                $product_type=[];
                if(module_is_active('ProductService'))
                {
                    $product_services =  \Modules\ProductService\Entities\ProductService::where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->get()->pluck('name', 'id');
                    $product_services->prepend('Select Items', '');
                    $product_type =\Modules\ProductService\Entities\ProductService::$product_type;
                }

            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
         return view('pos::purchase.create', compact('venders', 'purchase_number', 'product_services', 'category','vendorId','warehouse','customFields','product_type'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        if(\Auth::user()->can('purchase create'))
        {
            if(module_is_active('Account')){
                $validator = \Validator::make(
                    $request->all(), [
                        'vender_id' => 'required',
                        'warehouse_id' => 'required',
                        'purchase_date' => 'required',
                        'category_id' => 'required',
                        'items' => 'required',
                    ]
                );
            }elseif(!empty($request->vender_name))
            {
                $validator = \Validator::make(
                    $request->all(), [
                        'vender_name' => 'required',
                        'warehouse_id' => 'required',
                        'purchase_date' => 'required',
                        'category_id' => 'required',
                        'items' => 'required',
                    ]
                );
            }
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }if(!empty($request->vender_id)){
                $vender = \Modules\Account\Entities\Vender::where('user_id',$request->vender_id)->first();
            }
            $purchase                  = new Purchase();
            $purchase->purchase_id     = $this->purchaseNumber();
            $purchase->vender_id       = $request->vender_id;
            $purchase->user_id         = !empty($vender)? $vender->user_id : null;
            $purchase->vender_name     = !empty($request->vender_name) ? $request->vender_name : '';
            $purchase->warehouse_id    = $request->warehouse_id;
            $purchase->purchase_date   = $request->purchase_date;
            $purchase->purchase_number = !empty($request->purchase_number) ? $request->purchase_number : 0;
            $purchase->status          =  0;
            $purchase->category_id     = $request->category_id;
            $purchase->workspace       = getActiveWorkSpace();
            $purchase->created_by      = creatorId();
            $purchase->save();

            if(module_is_active('CustomField'))
            {
                \Modules\CustomField\Entities\CustomField::saveData($purchase, $request->customField);
            }

            event(new CreatePurchase($request,$purchase));
            $products = $request->items;
            for($i = 0; $i < count($products); $i++)
            {
                $purchaseProduct                = new PurchaseProduct();
                $purchaseProduct->purchase_id   = $purchase->id;
                $purchaseProduct->product_type  = $products[$i]['product_type'];
                $purchaseProduct->product_id    = $products[$i]['item'];
                $purchaseProduct->quantity      = $products[$i]['quantity'];
                $purchaseProduct->tax           = $products[$i]['tax'];
                $purchaseProduct->discount      = $products[$i]['discount'];
                $purchaseProduct->price         = $products[$i]['price'];
                $purchaseProduct->description   = $products[$i]['description'];
                $purchaseProduct->workspace     = getActiveWorkSpace();

                $purchaseProduct->save();
                //inventory management (Quantity)
                Purchase::total_quantity('plus',$purchaseProduct->quantity,$purchaseProduct->product_id);

                //Product Stock Report
                if(module_is_active('Account'))
                {
                    $type='Purchase';
                    $type_id = $purchase->id;
                    $description=$products[$i]['quantity'].'  '.__(' quantity add in purchase').' '. Purchase::purchaseNumberFormat($purchase->purchase_id);
                    Purchase::addProductStock( $products[$i]['item'],$products[$i]['quantity'],$type,$description,$type_id);
                }

                //Warehouse Stock Report
                if(isset($products[$i]['item']))
                {
                    Purchase::addWarehouseStock( $products[$i]['item'],$products[$i]['quantity'],$request->warehouse_id);
                }

            }


            return redirect()->route('purchase.index', $purchase->id)->with('success', __('Purchase successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($ids)
    {
        if(\Auth::user()->can('purchase show'))
        {
            try {
                $id       = Crypt::decrypt($ids);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Purchase Not Found.'));
            }

            $purchase = Purchase::find($id);

            if(!empty($purchase) && $purchase->created_by == creatorId() && $purchase->workspace == getActiveWorkSpace())
            {

                $purchasePayment = PurchasePayment::where('purchase_id', $purchase->id)->first();
                $vendor=[];
               if(module_is_active('Account'))
               {
                   $vendor      = $purchase->vender;
               }
                $iteams      = $purchase->items;
                if(module_is_active('CustomField')){
                    $purchase->customField = \Modules\CustomField\Entities\CustomField::getData($purchase, 'pos','purchase');
                    $customFields             = \Modules\CustomField\Entities\CustomField::where('workspace_id', '=', getActiveWorkSpace())->where('module', '=', 'pos')->where('sub_module','purchase')->get();
                }else{
                    $customFields = null;
                }

		$purchase_attachment = PurchaseAttachment::where('purchase_id',$purchase->id)->get();

                return view('pos::purchase.view', compact('purchase', 'vendor', 'iteams', 'purchasePayment','customFields','purchase_attachment'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($idsd)
    {
        if(module_is_active('ProductService'))
        {
            if(\Auth::user()->can('purchase edit'))
            {
                try {
                    $idwww   = Crypt::decrypt($idsd);
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error', __('Purchase Not Found.'));
                }
                $purchase     = \Modules\Pos\Entities\Purchase::find($idwww);
                $category = \Modules\ProductService\Entities\Category::where('created_by', '=', creatorId())->where('workspace_id',getActiveWorkSpace())->where('type', 2)->get()->pluck('name', 'id');
                $category->prepend('Select Category', '');
                $warehouse     = warehouse::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');

                $purchase_number  = \Modules\Pos\Entities\Purchase::purchaseNumberFormat($purchase->purchase_id);
                $venders=[];
                if(module_is_active('Account'))
                {
                    $venders          = \Modules\Account\Entities\Vender::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'user_id');
                }

                $product_services = \Modules\ProductService\Entities\ProductService::where('workspace_id', getActiveWorkSpace())->get()->pluck('name', 'id');

                if(module_is_active('CustomField')){
                    $purchase->customField = \Modules\CustomField\Entities\CustomField::getData($purchase, 'pos','purchase');
                    $customFields             = \Modules\CustomField\Entities\CustomField::where('workspace_id', '=', getActiveWorkSpace())->where('module', '=', 'pos')->where('sub_module','purchase')->get();
                }else{
                    $customFields = null;
                }
                $product_type =\Modules\ProductService\Entities\ProductService::$product_type;

                return view('pos::purchase.edit', compact('venders', 'product_services', 'purchase', 'warehouse','purchase_number', 'category','customFields','product_type'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Please Enable Product & Service Module'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */

    public function update(Request $request, Purchase $purchase)
    {
        if(\Auth::user()->can('purchase edit'))
        {
            if($purchase->created_by == creatorId() && $purchase->workspace == getActiveWorkSpace())
            {
                if(!empty($request->vender_name)){
                    $validator = \Validator::make(
                        $request->all(), [
                            'vender_name' => 'required',
                            'purchase_date' => 'required',
                            'items' => 'required',
                            ]
                    );
                }
                elseif(!empty($request->vender_id))
                {
                    $validator = \Validator::make(
                        $request->all(), [
                            'vender_id' => 'required',
                            'purchase_date' => 'required',
                            'items' => 'required',
                        ]
                    );
                }
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('purchase.index')->with('error', $messages->first());
                }

                if(!empty($request->vender_id)){
                    $purchase->vender_id      = $request->vender_id;
                    $purchase->vender_name      =  NULL;
                }else{
                    $purchase->vender_name      = $request->vender_name;
                    $purchase->vender_id      = 0;
                }


                $purchase->purchase_date      = $request->purchase_date;
                $purchase->category_id    = $request->category_id;
                $purchase->save();
                $products = $request->items;

                if(module_is_active('CustomField'))
                {
                    \Modules\CustomField\Entities\CustomField::saveData($purchase, $request->customField);
                }

                for($i = 0; $i < count($products); $i++)
                {
                    $purchaseProduct = PurchaseProduct::find($products[$i]['id']);
                    if ($purchaseProduct == null)
                    {
                        $purchaseProduct             = new PurchaseProduct();
                        $purchaseProduct->purchase_id    = $purchase->id;
                        Purchase::total_quantity('plus',$products[$i]['quantity'],$products[$i]['item']);
                        $old_qty=0;

                    }
                    else{
                        $old_qty = $purchaseProduct->quantity;
                        Purchase::total_quantity('minus',$purchaseProduct->quantity,$purchaseProduct->product_id);
                    }
                    //inventory management (Quantity)
                    if(isset($products[$i]['item']))
                    {
                        $purchaseProduct->product_id = $products[$i]['item'];
                    }
                    $purchaseProduct->product_type  = $products[$i]['product_type'];
                    $purchaseProduct->quantity      = $products[$i]['quantity'];
                    $purchaseProduct->tax           = $products[$i]['tax'];
                    $purchaseProduct->discount      = $products[$i]['discount'];
                    $purchaseProduct->price         = $products[$i]['price'];
                    $purchaseProduct->description   = $products[$i]['description'];
                    $purchaseProduct->save();
                    //inventory management (Quantity)
                    if ($products[$i]['id']>0) {
                        Purchase::total_quantity('plus',$products[$i]['quantity'],$purchaseProduct->product_id);
                    }

                     //Product Stock Report
                    if(module_is_active('Account'))
                    {
                        $type='Purchase';
                        $type_id = $purchase->id;
                        \Modules\Account\Entities\StockReport::where('type','=','purchase')->where('type_id','=',$purchase->id)->delete();
                        $description=$products[$i]['quantity'].'  '.__(' quantity add in purchase').' '. Purchase::purchaseNumberFormat($purchase->purchase_id);
                        if(empty($products[$i]['id'])){
                            Purchase::addProductStock( $products[$i]['item'],$products[$i]['quantity'],$type,$description,$type_id);
                        }
                    }
                     //Warehouse Stock Report
                    $new_qty = $purchaseProduct->quantity;
                    $total_qty= $new_qty - $old_qty;
                    if(isset($products[$i]['item'])){

                        Purchase::addWarehouseStock( $products[$i]['item'],$total_qty,$request->warehouse_id);
                    }
                    event(new UpdatePurchase($request,$purchase));

                }

                return redirect()->route('purchase.index')->with('success', __('Purchase successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Purchase $purchase)
    {
        if(\Auth::user()->can('purchase delete'))
        {
            if($purchase->created_by == creatorId() && $purchase->workspace == getActiveWorkSpace())
            {
                $purchase_products = PurchaseProduct::where('purchase_id',$purchase->id)->get();
                $purchase_payments=PurchasePayment::where('purchase_id', '=', $purchase->id)->get();
                foreach($purchase_payments as $purchase_payment){

                    delete_file($purchase_payment->add_receipt);
                    $purchase_payment->delete();
                }
                foreach($purchase_products as $purchase_product)
                {
                    $warehouse_qty = WarehouseProduct::where('warehouse_id',$purchase->warehouse_id)->where('product_id',$purchase_product->product_id)->first();
                    if(!empty($warehouse_qty))
                    {
                        $warehouse_qty->quantity = $warehouse_qty->quantity - $purchase_product->quantity;

                        if( $warehouse_qty->quantity > 0)
                        {
                            $warehouse_qty->save();
                        }
                        else
                        {
                            $warehouse_qty->delete();
                        }
                    }
                    $product_qty = \Modules\ProductService\Entities\ProductService::where('id',$purchase_product->product_id)->first();
                    if(!empty($product_qty))
                    {
                        $product_qty->quantity = $product_qty->quantity - $purchase_product->quantity;
                        $product_qty->save();
                    }

                    $purchase_product->delete();

                }
                if(module_is_active('CustomField'))
                {
                    $customFields = \Modules\CustomField\Entities\CustomField::where('module','pos')->where('sub_module','warehouse')->get();
                    foreach($customFields as $customField)
                    {
                        $value = \Modules\CustomField\Entities\CustomFieldValue::where('record_id', '=', $purchase->id)->where('field_id',$customField->id)->first();
                        if(!empty($value))
                        {

                            $value->delete();
                        }
                    }
                }
                event(new DestroyPurchase($purchase));
                $purchase->delete();
                PurchaseProduct::where('purchase_id', '=', $purchase->id)->delete();

                return redirect()->back()->with('success', __('Purchase successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    function purchaseNumber()
    {
        $latest = Purchase::where('created_by', '=',creatorId())->where('workspace',getActiveWorkSpace())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->purchase_id + 1;
    }
    public function product(Request $request)
    {
        $data['product']     = $product = \Modules\ProductService\Entities\ProductService::find($request->product_id);
        $data['unit']        = !empty($product) ? ((!empty($product->unit())) ? $product->unit()->name : '') : '';
        $data['taxRate']     = $taxRate = !empty($product) ? (!empty($product->tax_id) ? $product->taxRate($product->tax_id) : 0 ): 0;
        $data['taxes']       =  !empty($product) ? ( !empty($product->tax_id) ? $product->tax($product->tax_id) : 0) : 0;
        $salePrice           = !empty($product) ?  $product->purchase_price : 0;
        $quantity            = 1;
        $taxPrice            = !empty($product) ? (($taxRate / 100) * ($salePrice * $quantity)) : 0;
        $data['totalAmount'] = !empty($product) ?  ($salePrice * $quantity) : 0;
        return json_encode($data);
    }

    public function productDestroy(Request $request)
    {
        if(\Auth::user()->can('purchase delete'))
        {
            PurchaseProduct::where('id', '=', $request->id)->delete();

            return redirect()->back()->with('success', __('Purchase product successfully deleted.'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function sent($id)
    {
        if(\Auth::user()->can('purchase send'))
        {
            $purchase            = Purchase::where('id', $id)->first();
            $purchase->send_date = date('Y-m-d');
            $purchase->status    = 1;
            $purchase->save();

            event(new SentPurchase($purchase));
            if(!empty($purchase->vender_id != 0))
            {
                $vender = \Modules\Account\Entities\Vender::where('user_id', $purchase->vender_id)->first();
                if(empty($vender))
                {
                    $vender = User::where('id',$purchase->vender_id)->first();
                }
                Purchase::userBalance('vendor', $vender->id, $purchase->getTotal(), 'credit');

                $purchase->name = !empty($vender) ? $vender->name : '';
                $purchase->purchase =\Modules\Pos\Entities\Purchase::purchaseNumberFormat($purchase->purchase_id);

                $purchaseId    = Crypt::encrypt($purchase->id);
                $purchase->url = route('purchase.pdf', $purchaseId);
                if(!empty(company_setting('Purchase Send')) && company_setting('Purchase Send')  == true)
                {
                    $uArr = [
                        'purchase_name' => $purchase->name,
                        'purchase_number' =>$purchase->purchase,
                        'purchase_url' => $purchase->url,
                    ];
                    try
                    {
                        $resp = EmailTemplate::sendEmailTemplate('Purchase Send', [$vender->id => $vender->email], $uArr);
                    }
                    catch (\Exception $e) {
                        $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                    }
                    return redirect()->back()->with('success', __('Purchase successfully sent.') . ((isset($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
                }
                else{

                    return redirect()->back()->with('error', __('Purchase sent notification is off'));
                }
            }
            else{
                return redirect()->back()->with('success', __('Purchase successfully sent.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    public function resent($id)
    {
        if(\Auth::user()->can('purchase send'))
        {
            $purchase = Purchase::where('id', $id)->first();

            if(!empty($purchase->vender_id != 0))
            {
                $vender = \Modules\Account\Entities\Vender::where('id', $purchase->vender_id)->first();

                $purchase->name = !empty($vender) ? $vender->name : '';
                $purchase->purchase =\Modules\Pos\Entities\Purchase::purchaseNumberFormat($purchase->purchase_id);

                $purchaseId    = Crypt::encrypt($purchase->id);
                $purchase->url = route('purchase.pdf', $purchaseId);

                if(!empty(company_setting('Purchase Send')) && company_setting('Purchase Send')  == true)
                {
                    $uArr = [
                        'bill_name' => $purchase->name,
                        'bill_number' =>$purchase->purchase,
                        'bill_url' => $purchase->url,
                    ];
                    try
                    {
                        $resp = EmailTemplate::sendEmailTemplate('Bill Send', [$vender->id => $vender->email], $uArr);
                    }
                    catch (\Exception $e) {
                        $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                    }
                }
                event(new ResentPurchase($purchase));
                return redirect()->back()->with('success', __('Purchase successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
            }
            else{
                return redirect()->back()->with('success', __('Purchase successfully sent.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    public function purchase($purchase_id)
    {
        $purchaseId   = Crypt::decrypt($purchase_id);

        $purchase  = Purchase::where('id', $purchaseId)->first();
        $vendor=[];
        if(module_is_active('Account'))
        {
            $vendor = $purchase->vender;
        }

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate     = 0;
        $totalDiscount = 0;
        $taxesData     = [];
        $items         = [];

        foreach($purchase->items as $product)
        {

            $item                   = new \stdClass();
            $item->product_type     = !empty($product->product_type) ? $product->product_type : '';
            $item->name             = !empty($product->product()) ? $product->product()->name : '';
            $item->quantity         = $product->quantity;
            $item->tax              = $product->tax;
            $item->discount         = $product->discount;
            $item->price            = $product->price;
            $item->description      = $product->description;

            $totalQuantity += $item->quantity;
            $totalRate     += $item->price;
            $totalDiscount += $item->discount;

            $taxes     = Purchase::taxs($product->tax);
            $itemTaxes = [];
            if(!empty($item->tax))
            {
                foreach($taxes as $tax)
                {
                    $taxPrice      = Purchase::taxRate($tax->rate, $item->price, $item->quantity,$item->discount);
                    $totalTaxPrice += $taxPrice;

                    $itemTax['name']  = $tax->name;
                    $itemTax['rate']  = $tax->rate . '%';
                    $itemTax['price'] = currency_format_with_sym( $taxPrice,$purchase->created_by, $purchase->workspace);
                    $itemTaxes[]      = $itemTax;


                    if(array_key_exists($tax->name, $taxesData))
                    {
                        $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
                    }
                    else
                    {
                        $taxesData[$tax->name] = $taxPrice;
                    }

                }

                $item->itemTax = $itemTaxes;
            }
            else
            {
                $item->itemTax = [];
            }
            $items[] = $item;
        }

        $purchase->itemData      = $items;
        $purchase->totalTaxPrice = $totalTaxPrice;
        $purchase->totalQuantity = $totalQuantity;
        $purchase->totalRate     = $totalRate;
        $purchase->totalDiscount = $totalDiscount;
        $purchase->taxesData     = $taxesData;
        if(module_is_active('CustomField')){
            $purchase->customField = \Modules\CustomField\Entities\CustomField::getData($purchase, 'pos','purchase');
            $customFields             = \Modules\CustomField\Entities\CustomField::where('workspace_id', '=', getActiveWorkSpace($purchase->created_by, $purchase->workspace))->where('module', '=', 'pos')->where('sub_module','purchase')->get();
        }else{
            $customFields = null;
        }

        if ($purchase)
        {
            $color=company_setting('purchase_color',$purchase->created_by, $purchase->workspace);
            if($color){
                $color=$color;
            }else{
                $color='ffffff';
            }
            $color      = '#' .$color ;
            $font_color   = PosUtility::getFontColor($color);

            $company_logo = get_file(sidebar_logo());

            $purchase_logo = company_setting('purchase_logo',$purchase->created_by, $purchase->workspace);

            if(isset($purchase_logo) && !empty($purchase_logo))
            {
                $img = get_file($purchase_logo);
            }
            else{
                $img          =  $company_logo;
            }
            $settings['site_rtl'] = company_setting('site_rtl',$purchase->created_by, $purchase->workspace);
            $settings['company_email'] = company_setting('company_email',$purchase->created_by, $purchase->workspace);
            $settings['company_telephone'] = company_setting('company_telephone',$purchase->created_by, $purchase->workspace);
            $settings['company_name'] = company_setting('company_name',$purchase->created_by, $purchase->workspace);
            $settings['company_address'] = company_setting('company_address',$purchase->created_by, $purchase->workspace);
            $settings['company_city'] = company_setting('company_city',$purchase->created_by, $purchase->workspace);
            $settings['company_state'] = company_setting('company_state',$purchase->created_by, $purchase->workspace);
            $settings['company_zipcode'] = company_setting('company_zipcode',$purchase->created_by, $purchase->workspace);
            $settings['company_country'] = company_setting('company_country',$purchase->created_by, $purchase->workspace);
            $settings['registration_number'] = company_setting('registration_number',$purchase->created_by, $purchase->workspace);
            $settings['tax_type'] = company_setting('tax_type',$purchase->created_by, $purchase->workspace);
            $settings['vat_number'] = company_setting('vat_number',$purchase->created_by, $purchase->workspace);
            $settings['purchase_footer_title'] = company_setting('purchase_footer_title',$purchase->created_by, $purchase->workspace);
            $settings['purchase_footer_notes'] = company_setting('purchase_footer_notes',$purchase->created_by, $purchase->workspace);
            $settings['purchase_shipping_display'] = company_setting('purchase_shipping_display',$purchase->created_by, $purchase->workspace);
            $settings['purchase_template'] = company_setting('purchase_template',$purchase->created_by, $purchase->workspace);


            return view('pos::purchase.templates.' . $settings['purchase_template'], compact('purchase', 'color', 'settings', 'vendor', 'img', 'font_color','customFields'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    public function payment($purchase_id)
    {
        if(\Auth::user()->can('purchase payment create'))
        {
            $purchase    = Purchase::where('id', $purchase_id)->first();
            $venders =  \Modules\Account\Entities\Vender::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');

            $categories = \Modules\ProductService\Entities\Category::where('created_by', '=', creatorId())->where('workspace_id',getActiveWorkSpace())->get()->pluck('name', 'id');
            $accounts   = \Modules\Account\Entities\BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
            return view('pos::purchase.payment', compact('venders', 'categories', 'accounts', 'purchase'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);


        }
    }
    public function createPayment(Request $request, $purchase_id)
    {
        if(\Auth::user()->can('purchase payment create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'date' => 'required',
                    'amount' => 'required',
                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $purchasePayment                 = new PurchasePayment();

            if(module_is_active('Account'))
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'account_id' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $purchasePayment->account_id     = $request->account_id;
            }

            $purchasePayment->purchase_id        = $purchase_id;
            $purchasePayment->date           = $request->date;
            $purchasePayment->amount         = $request->amount;
            $purchasePayment->account_id     = $request->account_id;
            $purchasePayment->payment_method = 0;
            $purchasePayment->reference      = $request->reference;
            $purchasePayment->description    = $request->description;
            if(!empty($request->add_receipt))
            {
                $fileName = time() . "_" . $request->add_receipt->getClientOriginalName();
                $uplaod = upload_file($request,'add_receipt',$fileName,'payment');
                if($uplaod['flag'] == 1)
                {
                    $url = $uplaod['url'];
                }
                else{
                    return redirect()->back()->with('error',$uplaod['msg']);
                }
                $purchasePayment->add_receipt = $url;
            }
            $purchasePayment->save();

            $purchase  = Purchase::where('id', $purchase_id)->first();
            $due   = $purchase->getDue();
            $total = $purchase->getTotal();

            if($purchase->status == 0)
            {
                $purchase->send_date = date('Y-m-d');
                $purchase->save();
            }

            if($due <= 0)
            {
                $purchase->status = 4;
                $purchase->save();
            }
            else
            {
                $purchase->status = 3;
                $purchase->save();
            }
            if($purchase->vender_name){

                $purchasePayment->vendor_name    = $purchase->vender_name;
            }
            else{
                $purchasePayment->user_id    = $purchase->vender_id;
            }
            $purchasePayment->user_type  = 'Vendor';
            $purchasePayment->type       = 'Partial';
            $purchasePayment->created_by = \Auth::user()->id;
            $purchasePayment->payment_id = $purchasePayment->id;
            $purchasePayment->category   = 'Purchase';
            $purchasePayment->account    = $request->account_id;

            if(module_is_active('Account'))
            {
                \Modules\Account\Entities\Transaction::addTransaction($purchasePayment);

                $vender_acc = \Modules\Account\Entities\Vender::where('id', $purchase->vender_id)->first();
                if(empty($vender_acc))
                {
                    $Vendor = $vender_acc;
                }
                \Modules\Account\Entities\AccountUtility::userBalance('Vendor', $purchase->vender_id, $request->amount, 'debit');

                \Modules\Account\Entities\Transfer::bankAccountBalance($request->account_id, $request->amount, 'credit');
            }

            $payment         = new PurchasePayment();
            $payment->name   = !empty($vender['name']) ? $purchasePayment->vendor_name: '';
            $payment->method = '-';
            $payment->date   = company_date_formate($request->date);
            $payment->amount = currency_format_with_sym($request->amount);
            $payment->bill   = 'purchase' . Purchase::purchaseNumberFormat($purchasePayment->purchase_id);

            Purchase::userBalance('vendor', $purchase->vender_id, $request->amount, 'debit');

            Purchase::bankAccountBalance($request->account_id, $request->amount, 'debit');

            if(!empty(company_setting('Purchase Payment Create')) && company_setting('Purchase Payment Create')  == true)
            {
                $uArr = [
                    'payment_name' => $payment->name,
                    'payment_bill' => $payment->bill,
                    'payment_amount' => $payment->amount,
                    'payment_date' => $payment->date,
                    'payment_method'=> $payment->method

                ];
                try
                {

                    $resp = EmailTemplate::sendEmailTemplate('Purchase Payment Create', [$vender_acc->id => $vender_acc->email], $uArr);
                }

                catch (\Exception $e) {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }
            }

            event(new CreatePaymentPurchase($request,$payment));
            return redirect()->back()->with('success', __('Payment successfully added.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));

        }

    }
    public function posPrintIndex()
    {
        if(\Auth::user()->can('pos manage'))
        {

            return view('pos::purchase.pos');
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
    public function previewPurchase($template, $color)
    {
        $objUser  = \Auth::user();
        $purchase     = new Purchase();

        $vendor                   = new \stdClass();
        $vendor->email            = '<Email>';
        $vendor->shipping_name    = '<Vendor Name>';
        $vendor->shipping_country = '<Country>';
        $vendor->shipping_state   = '<State>';
        $vendor->shipping_city    = '<City>';
        $vendor->shipping_phone   = '<Vendor Phone Number>';
        $vendor->shipping_zip     = '<Zip>';
        $vendor->shipping_address = '<Address>';
        $vendor->billing_name     = '<Vendor Name>';
        $vendor->billing_country  = '<Country>';
        $vendor->billing_state    = '<State>';
        $vendor->billing_city     = '<City>';
        $vendor->billing_phone    = '<Vendor Phone Number>';
        $vendor->billing_zip      = '<Zip>';
        $vendor->billing_address  = '<Address>';

        $totalTaxPrice = 0;
        $taxesData     = [];
        $items         = [];
        for($i = 1; $i <= 3; $i++)
        {
            $item           = new \stdClass();
            $item->name     = 'Item ' . $i;
            $item->quantity = 1;
            $item->tax      = 5;
            $item->discount = 50;
            $item->price    = 100;
            $item->description    = 'In publishing and graphic design, Lorem ipsum is a placeholder';

            $taxes = [
                'Tax 1',
                'Tax 2',
            ];

            $itemTaxes = [];
            foreach($taxes as $k => $tax)
            {
                $taxPrice         = 10;
                $totalTaxPrice    += $taxPrice;
                $itemTax['name']  = 'Tax ' . $k;
                $itemTax['rate']  = '10 %';
                $itemTax['price'] = '$10';
                $itemTaxes[]      = $itemTax;
                if(array_key_exists('Tax ' . $k, $taxesData))
                {
                    $taxesData['Tax ' . $k] = $taxesData['Tax 1'] + $taxPrice;
                }
                else
                {
                    $taxesData['Tax ' . $k] = $taxPrice;
                }
            }
            $item->itemTax = $itemTaxes;
            $items[]       = $item;
        }

        $purchase->purchase_id    = 1;
        $purchase->issue_date = date('Y-m-d H:i:s');
        $purchase->itemData   = $items;

        $purchase->totalTaxPrice = 60;
        $purchase->totalQuantity = 3;
        $purchase->totalRate     = 300;
        $purchase->totalDiscount = 10;
        $purchase->taxesData     = $taxesData;
        $purchase->customField   = [];
        $customFields        = [];

        $preview      = 1;
        $color        = '#' . $color;
        $font_color   = User::getFontColor($color);

        $company_logo = get_file(sidebar_logo());

        $purchase_logo = company_setting('purchase_logo');

        if(isset($purchase_logo) && !empty($purchase_logo))
        {
            $img = get_file($purchase_logo);
        }
        else{
            $img          =  $company_logo;
        }
        $settings['site_rtl'] = company_setting('site_rtl');
        $settings['company_email'] = company_setting('company_email');
        $settings['company_telephone'] = company_setting('company_telephone');
        $settings['company_name'] = company_setting('company_name');
        $settings['company_address'] = company_setting('company_address');
        $settings['company_city'] = company_setting('company_city');
        $settings['company_state'] = company_setting('company_state');
        $settings['company_zipcode'] = company_setting('company_zipcode');
        $settings['company_country'] = company_setting('company_country');
        $settings['registration_number'] = company_setting('registration_number');
        $settings['tax_type'] = company_setting('tax_type');
        $settings['vat_number'] = company_setting('vat_number');
        $settings['purchase_footer_title'] = company_setting('purchase_footer_title');
        $settings['purchase_footer_notes'] = company_setting('purchase_footer_notes');
        $settings['purchase_shipping_display'] = company_setting('purchase_shipping_display');

        return view('pos::purchase.templates.' . $template, compact('purchase', 'preview', 'color', 'img', 'settings', 'vendor', 'font_color','customFields'));
    }

    public function savePurchaseTemplateSettings(Request $request)
    {

        $user = \Auth::user();
        $validator = \Validator::make($request->all(),
        [
            'purchase_template' => 'required',
        ]);
        if($validator->fails()){
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        if($request->purchase_logo)
        {
            $request->validate(
                [
                    'purchase_logo' => 'image|mimes:png',
                ]
            );

            $purchase_logo         = $user->id.'_purchase_logo.png';
            $uplaod = upload_file($request,'purchase_logo',$purchase_logo,'purchase_logo');
            if($uplaod['flag'] == 1)
            {
                $url = $uplaod['url'];
            }
            else{
                return redirect()->back()->with('error',$uplaod['msg']);
            }
        }

        if (isset($post['purchase_template']) && (!isset($post['purchase_color']) || empty($post['purchase_color'])))
        {
            $post['purchase_color'] = "ffffff";
        }

        $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
        \Settings::context($userContext)->set('purchase_prefix', $request->purchase_prefix);
        \Settings::context($userContext)->set('purchase_footer_title', $request->purchase_footer_title);
        \Settings::context($userContext)->set('purchase_footer_notes', $request->purchase_footer_notes);
        \Settings::context($userContext)->set('purchase_shipping_display', $request->purchase_shipping_display);
        \Settings::context($userContext)->set('purchase_template', $request->purchase_template);
        \Settings::context($userContext)->set('purchase_color', !empty($request->purchase_color) ? $request->purchase_color : 'ffffff');
        if($request->purchase_logo)
        {
            \Settings::context($userContext)->set('purchase_logo', $url);
        }
        return redirect()->back()->with('success','Purchase Setting updated successfully');

    }

    public function items(Request $request)
    {
        $items = PurchaseProduct::where('purchase_id', $request->purchase_id)->where('product_id', $request->product_id)->first();
        return json_encode($items);

    }

    public function purchaseLink($purchaseId)
    {
        $id             = Crypt::decrypt($purchaseId);
        $purchase       = Purchase::find($id);

        if(!empty($purchase))
        {
            $user_id        = $purchase->created_by;
            $user           = User::find($user_id);

            $purchasePayment = PurchasePayment::where('purchase_id', $purchase->id)->first();
            $vendor = $purchase->vender;
            $iteams = $purchase->items;

            return view('pos::purchase.customer_bill', compact('purchase', 'vendor', 'iteams','purchasePayment','user'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

    }
    public function paymentDestroy(Request $request, $purchase_id, $payment_id)
    {

        if(\Auth::user()->can('purchase payment delete'))
        {
            $payment = PurchasePayment::find($payment_id);
            PurchasePayment::where('id', '=', $payment_id)->delete();

            $purchase = Purchase::where('id', $purchase_id)->first();

            $due   = $purchase->getDue();
            $total = $purchase->getTotal();

            if($due > 0 && $total != $due)
            {
                $purchase->status = 3;

            }
            else
            {
                $purchase->status = 2;
            }

            Purchase::userBalance('vendor', $purchase->vender_id, $payment->amount, 'credit');
            Purchase::bankAccountBalance($payment->account_id, $payment->amount, 'credit');

            event(new PaymentDestroyPurchase($payment));
            $purchase->save();
            $type = 'Partial';
            $user = 'Vender';
            \Modules\Account\Entities\Transaction::destroyTransaction($payment_id, $type, $user);

            return redirect()->back()->with('success', __('Payment successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function vender(Request $request)
    {
        if(module_is_active('Account'))
        {
            $vender = \Modules\Account\Entities\Vender::where('user_id', '=', $request->id)->first();
            if(empty($vender))
            {
                $user = User::find($request->id);
                $vender['name'] =!empty($user->name)? $user->name:'';
                $vender['email'] =!empty($user->email)? $user->email:'';
            }
        }
        else{
            $user = User::find($request->id);
            $vender['name'] = !empty($user->name) ? $user->name : '';
            $vender['email'] = !empty($user->email) ? $user->email : '';
        }

        return view('pos::purchase.vender_detail', compact('vender'));
    }


    public function grid()
    {
        if(\Auth::user()->can('purchase manage'))
        {
            $vender=[];
            if(module_is_active('Account'))
            {

                $vender = \Modules\Account\Entities\Vender::where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
                $vender->prepend('Select Vendor', '');
            }

            $status =  \Modules\Pos\Entities\Purchase::$statues;
            $purchases =  \Modules\Pos\Entities\Purchase::where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get();
            return view('pos::purchase.grid', compact('purchases', 'status','vender'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function fileUpload( $id, Request $request)
    {
        $purchase = Purchase::find($id);
        $file_name = time() . "_" . $request->file->getClientOriginalName();

        $upload = upload_file($request,'file',$file_name,'purchase_attachment',[]);

        $fileSizeInBytes = File::size($upload['url']);
        $fileSizeInKB = round($fileSizeInBytes / 1024, 2);

        if ($fileSizeInKB < 1024) {
            $fileSizeFormatted = $fileSizeInKB . " KB";
        } else {
            $fileSizeInMB = round($fileSizeInKB / 1024, 2);
            $fileSizeFormatted = $fileSizeInMB . " MB";
        }

        if($upload['flag'] == 1){
            $file                 = PurchaseAttachment::create(
                [
                    'purchase_id' => $purchase->id,
                    'file_name' => $file_name,
                    'file_path' => $upload['url'],
                    'file_size' => $fileSizeFormatted,
                ]
            );
            $return               = [];
            $return['is_success'] = true;

            // event(new PurchaseUploadFiles($request , $upload , $purchase));    // this event is not created

            // ActivityLog::create(
            //     [
            //         'user_id' => Auth::user()->id,
            //         'user_type' => get_class(Auth::user()),
            //         'purchase_id' => $purchase->id,
            //         'log_type' => 'Upload File',
            //         'remark' => json_encode(['file_name' => $file_name]),
            //     ]
            // );
            return response()->json($return);
        }else{

            return response()->json(
                [
                    'is_success' => false,
                    'error' => $upload['msg'],
                ], 401
            );
        }
    }

    public function fileUploadDestroy($id)
    {
        $file = PurchaseAttachment::find($id);
        
        if (!empty($file->file_path)) {
            delete_file($file->file_path);
        }
        $file->delete();
        return redirect()->back()->with('success', __('File successfully deleted.'));
            
    }

}
