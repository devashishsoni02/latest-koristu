<?php

namespace Modules\ProductService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ProposalProduct;
use Illuminate\Support\Facades\Auth;
use Modules\ProductService\Entities\Category;
use Modules\ProductService\Entities\ProductService;
use Modules\ProductService\Entities\Tax;
use Modules\ProductService\Entities\Unit;
use App\Events\DeleteProductService;
use App\Models\InvoiceProduct;
use Modules\ProductService\Events\CreateProduct;
use Modules\ProductService\Events\DestroyProduct;
use Modules\ProductService\Events\UpdateProduct;

class ProductServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(Auth::user()->can('product&service manage'))
        {
            $category = Category::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('type', '=', 0)->get()->pluck('name', 'id');
            if (!empty($request->category))
            {
                $productServices = ProductService::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('category_id', $request->category)->get();
            } else {
                $productServices = ProductService::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->get();
            }

            return view('productservice::index',compact('productServices', 'category'));
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
    public function create()
    {
        if(Auth::user()->can('product&service create'))
        {
            $category     = Category::where('created_by', '=',creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('type', '=', 0)->get()->pluck('name', 'id');
            $unit         = Unit::where('created_by', '=',creatorId())->where('workspace_id', '=', getActiveWorkSpace())->get()->pluck('name', 'id');
            $tax          = Tax::where('created_by', '=',creatorId())->where('workspace_id', '=', getActiveWorkSpace())->get()->pluck('name', 'id');

            if(module_is_active('CustomField')){
                $customFields =  \Modules\CustomField\Entities\CustomField::where('workspace_id',getActiveWorkSpace())->where('module', '=', 'ProductService')->where('sub_module','product & service')->get();
            }else{
                $customFields = null;
            }

            return view('productservice::create', compact('category', 'unit', 'tax','customFields'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if(Auth::user()->can('product&service create'))
        {
            $rules = [
                'name' => 'required',
                'sku' => 'required',
                'sale_price' => 'required|numeric',
                'purchase_price' => 'required|numeric',
                'category_id' => 'required',
                'unit_id' => 'required',
                'type' => 'required',
            ];

            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->route('product-service.index')->with('error', $messages->first());
            }

            $productService                 = new ProductService();
            $productService->name           = $request->name;
            $productService->description    = $request->description;
            $productService->sku            = $request->sku;
            if($request->hasFile('image')){
                $name = time() . "_" . $request->image->getClientOriginalName();
                $path = upload_file($request,'image',$name,'products');
                $productService->image          = empty($path) ? null : $path['url'];
            }

            $productService->sale_price     = $request->sale_price;
            $productService->purchase_price = $request->purchase_price;
            $productService->tax_id         = !empty($request->tax_id) ? implode(',', $request->tax_id) : '';
            $productService->unit_id        = $request->unit_id;
            if(!empty($request->quantity))
            {
                $productService->quantity        = $request->quantity;
            }
            else{
                $productService->quantity   = 0;
            }
            $productService->type           = $request->type;
            $productService->category_id    = $request->category_id;
            $productService->created_by     = creatorId();
            $productService->workspace_id     = getActiveWorkSpace();
            $productService->save();

            event(new CreateProduct($request,$productService));
            if(module_is_active('CustomField'))
            {
                \Modules\CustomField\Entities\CustomField::saveData($productService, $request->customField);
            }
            return redirect()->back()->with('success', __('Product successfully created.'));
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
    public function show($id)
    {
        return redirect()->back();
        return view('productservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if(Auth::user()->can('product&service edit'))
        {
            $productService = ProductService::find($id);
            $category     = Category::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('type', '=', 0)->get()->pluck('name', 'id');
            $unit         = Unit::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->get()->pluck('name', 'id');
            $tax          = Tax::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->get()->pluck('name', 'id');
            $productService->tax_id      = explode(',', $productService->tax_id);

            if(module_is_active('CustomField')){
                $productService->customField = \Modules\CustomField\Entities\CustomField::getData($productService, 'ProductService','product & service');
                $customFields             = \Modules\CustomField\Entities\CustomField::where('workspace_id', '=', getActiveWorkSpace())->where('module', '=', 'ProductService')->where('sub_module','product & service')->get();
            }else{
                $customFields = null;
            }
            return view('productservice::edit', compact('category', 'unit', 'tax', 'productService','customFields'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->can('product&service edit'))
        {
            $productService = ProductService::find($id);

            $rules = [
                'name' => 'required',
                'sku' => 'required',
                'sale_price' => 'required|numeric',
                'purchase_price' => 'required|numeric',
                'category_id' => 'required',
                'unit_id' => 'required',
                'type' => 'required',
            ];

            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->route('product-service.index')->with('error', $messages->first());
            }

            $productService->name           = $request->name;
            $productService->description    = $request->description;
            $productService->sku            = $request->sku;
            $productService->sale_price     = $request->sale_price;
            $productService->purchase_price = $request->purchase_price;
            $productService->tax_id         = !empty($request->tax_id) ? implode(',', $request->tax_id) : '';
            $productService->unit_id        = $request->unit_id;
            $productService->quantity        = $request->quantity;
            $productService->type           = $request->type;
            if($request->hasFile('image'))
            {
                // old file delete
                if(!empty($productService->image))
                {
                    delete_file($productService->image);
                }

                $name = time() . "_" . $request->image->getClientOriginalName();
                $path = upload_file($request,'image',$name,'products');
                $productService->image          = empty($path) ? null : $path['url'];
            }
            $productService->category_id    = $request->category_id;
            $productService->save();

            event(new UpdateProduct($request,$productService));

            if(module_is_active('CustomField'))
            {
                \Modules\CustomField\Entities\CustomField::saveData($productService, $request->customField);
            }
            return redirect()->back()->with('success', __('Product successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function grid(Request $request)
    {
        if(Auth::user()->can('product&service manage'))
        {
            $category = Category::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('type', '=', 0)->get()->pluck('name', 'id');
            if (!empty($request->category))
            {
                $productServices = ProductService::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('category_id', $request->category)->get();
            } else {
                $productServices = ProductService::where('created_by', '=', creatorId())->where('workspace_id', '=', getActiveWorkSpace())->get();
            }

            return view('productservice::grid',compact('productServices', 'category'));
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
    public function destroy($id)
    {
        if(Auth::user()->can('product&service delete'))
        {
            $invoice_product=InvoiceProduct::where('product_id',$id)->first();
            $proposal_product=ProposalProduct::where('product_id',$id)->first();
            $data = event(new DeleteProductService($id));

            if((empty($invoice_product) && empty($proposal_product)) && !in_array('false',array_filter($data))){
            $productService = ProductService::find($id);
            if(!empty($productService->image))
            {
                delete_file($productService->image);
            }
            event(new DestroyProduct($productService));
            $productService->delete();
            return redirect()->back()->with('success', __('Product successfully deleted.'));
        }else{

            return redirect()->back()->with('error', __('Please delete'.(!empty($invoice_product) ? ' Invoice ' : '').(!empty($proposal_product) ? ' and Proposal ' : '').'related record of this Product.'));

        }
        }
        else
        {

            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function fileImportExport()
    {
        if(Auth::user()->can('product&service import'))
        {
            return view('productservice::import');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function fileImport(Request $request)
    {
        if(Auth::user()->can('product&service import'))
        {
            session_start();

            $error = '';

            $html = '';

            if ($request->file->getClientOriginalName() != '') {
                $file_array = explode(".", $request->file->getClientOriginalName());

                $extension = end($file_array);
                if ($extension == 'csv') {
                    $file_data = fopen($request->file->getRealPath(), 'r');

                    $file_header = fgetcsv($file_data);
                    $html .= '<table class="table table-bordered"><tr>';

                    for ($count = 0; $count < count($file_header); $count++) {
                        $html .= '
                                <th>
                                    <select name="set_column_data" class="form-control set_column_data" data-column_number="' . $count . '">
                                    <option value="">Set Count Data</option>
                                    <option value="name">Name</option>
                                    <option value="sku">SKU</option>
                                    <option value="sale_price">Sale Price</option>
                                    <option value="purchase_price">Purchase Price</option>
                                    <option value="quantity">Quantity</option>
                                    <option value="type">Type</option>
                                    <option value="description">Description</option>
                                    </select>
                                </th>
                                ';

                    }
                    $html .= '</tr>';
                    $limit = 0;
                    while (($row = fgetcsv($file_data)) !== false) {
                        $limit++;

                        $html .= '<tr>';

                        for ($count = 0; $count < count($row); $count++) {
                            $html .= '<td>' . $row[$count] . '</td>';
                        }

                        $html .= '</tr>';

                        $temp_data[] = $row;

                    }
                    $_SESSION['file_data'] = $temp_data;
                } else {
                    $error = 'Only <b>.csv</b> file allowed';
                }
            } else {

                $error = 'Please Select CSV File';
            }
            $output = array(
                'error' => $error,
                'output' => $html,
            );

            echo json_encode($output);
        }
        else
        {
            return redirect()->back()->with('error', 'permission Denied');
        }

    }

    public function fileImportModal()
    {
        if(Auth::user()->can('product&service import'))
        {
            return view('productservice::import_modal');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function productserviceImportdata(Request $request)
    {
        if(Auth::user()->can('product&service import'))
        {
            session_start();
            $html = '<h3 class="text-danger text-center">Below data is not inserted</h3></br>';
            $flag = 0;
            $html .= '<table class="table table-bordered"><tr>';
            $file_data = $_SESSION['file_data'];

            unset($_SESSION['file_data']);

            $user = \Auth::user();


            foreach ($file_data as $row) {
                    $product = ProductService::where('created_by',creatorId())->where('workspace_id',getActiveWorkSpace())->Where('name', 'like',$row[$request->name])->get();

                    if($product->isEmpty()){

                    try {
                        ProductService::create([
                            'name' => $row[$request->name],
                            'sku' => $row[$request->sku],
                            'sale_price' => $row[$request->sale_price],
                            'purchase_price' => $row[$request->purchase_price],
                            'quantity' => $row[$request->quantity],
                            'type' => $row[$request->type],
                            'description' => $row[$request->description],
                            'created_by' => creatorId(),
                            'workspace_id' => getActiveWorkSpace(),
                        ]);
                    }
                    catch (\Exception $e)
                    {
                        $flag = 1;
                        $html .= '<tr>';

                        $html .= '<td>' . $row[$request->name] . '</td>';
                        $html .= '<td>' . $row[$request->sku] . '</td>';
                        $html .= '<td>' . $row[$request->sale_price] . '</td>';
                        $html .= '<td>' . $row[$request->purchase_price] . '</td>';
                        $html .= '<td>' . $row[$request->quantity] . '</td>';
                        $html .= '<td>' . $row[$request->type] . '</td>';
                        $html .= '<td>' . $row[$request->description] . '</td>';

                        $html .= '</tr>';
                    }
                }
                else
                {
                    $flag = 1;
                    $html .= '<tr>';

                    $html .= '<td>' . $row[$request->name] . '</td>';
                    $html .= '<td>' . $row[$request->sku] . '</td>';
                    $html .= '<td>' . $row[$request->sale_price] . '</td>';
                    $html .= '<td>' . $row[$request->purchase_price] . '</td>';
                    $html .= '<td>' . $row[$request->quantity] . '</td>';
                    $html .= '<td>' . $row[$request->type] . '</td>';
                    $html .= '<td>' . $row[$request->description] . '</td>';

                    $html .= '</tr>';
                }
            }

            $html .= '
                            </table>
                            <br />
                            ';
            if ($flag == 1)
            {

                return response()->json([
                            'html' => true,
                    'response' => $html,
                ]);
            } else {
                return response()->json([
                    'html' => false,
                    'response' => 'Data Imported Successfully',
                ]);
            }
        }
        else
        {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    public function GetItem(Request $request)
    {
        $product_services = \Modules\ProductService\Entities\ProductService::where('workspace_id', getActiveWorkSpace());
        if(!empty($request->product_type)){
            $product_services = $product_services->where('type',$request->product_type);
        }
        $product_services = $product_services->get()->pluck('name', 'id');
        return response()->json($product_services);
    }

    public function getTaxes(Request $request)
    {
        if(module_is_active('ProductService'))
        {
            $taxs_data = \Modules\ProductService\Entities\Tax::whereIn('id',$request->tax_id)->where('workspace_id', getActiveWorkSpace())->get();
            return json_encode($taxs_data);
        }else{
            $taxs_data = [];
            return json_encode($taxs_data);
        }
    }

}
