<?php

namespace Modules\Pos\Entities;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Rawilk\Settings\Support\Context;
use App\Models\User;
use App\Models\WorkSpace;




class Pos extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_id',
        'customer_id',
        'warehouse_id',
        'pos_date',
        'category_id',
        'status',
        'shipping_display',
        'created_by',
    ];

    protected static function newFactory()
    {
        return \Modules\Pos\Database\factories\PosFactory::new();
    }

    public function customer()
    {
        if(module_is_active('Account'))
        {
            return $this->hasOne(\Modules\Account\Entities\Customer::class, 'user_id', 'customer_id');
        }else{
            return $this->hasOne(User::class, 'id', 'customer_id');
        }
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function posPayment(){
        return $this->hasOne(PosPayment::class,'pos_id','id');
    }

    public function PosProduct(){

        return $this->hasMany(PosProduct::class,'pos_id','pos_id');
    }

    public function items()
    {
        return $this->hasMany(PosProduct::class, 'pos_id', 'id');
    }

    public function taxes()
    {
        return $this->hasOne('\Modules\ProductService\Entities\Tax', 'id', 'tax');
    }

    public static function getallCategories()
    {
        $cat=[];
        if(module_is_active('ProductService'))
        {
            $cat = \Modules\ProductService\Entities\Category::select('categories.*', \DB::raw("COUNT(pu.category_id) product_services"))
                ->leftjoin('product_services as pu','categories.id' ,'=','pu.category_id')
                ->where('categories.created_by', '=', creatorId())
                ->where('categories.workspace_id', '=', getActiveWorkSpace())
                ->where('categories.type', 0)
                ->orderBy('categories.id', 'DESC')->groupBy('categories.id')->get();
        }
        return $cat;

    }
    public static function getallproducts()
    {
        if(module_is_active('ProductService'))
        {
            return \Modules\ProductService\Entities\ProductService::select('product_services.*', 'c.name as categoryname')
            // ->where('product_services.type', '=', 'product')
                ->leftjoin('categories as c', 'c.id', '=', 'product_services.category_id')
                ->where('product_services.created_by', '=', creatorId())
                ->where('product_services.workspace_id', '=', getActiveWorkSpace())
                ->orderBy('product_services.id', 'DESC');


        }
    }
    public static function posNumberFormat($number)
    {
        $data = !empty(company_setting('pos_prefix')) ? company_setting('pos_prefix') : '#SLO0000';
        return $data. sprintf("%05d", $number);
    }


    public static function customer_id($customer_name)
    {

        $customers = \DB::select(
            \DB::raw("SELECT IFNULL( (SELECT id from users where name = :name and created_by = :created_by  limit 1), '0') as customer_id"), ['name' => $customer_name,  'created_by' => creatorId(), ]
        );
        return $customers[0]->customer_id;

    }
    public static function tax_id($product_id)
    {
        if(module_is_active('ProductService'))
        {

            $results = \Modules\ProductService\Entities\ProductService::where(['id'=>$product_id, 'created_by'=> creatorId(), 'workspace_id' => getActiveWorkSpace() ])->first();
            return $results->tax_id;
        }


    }

    public static function totalSelledAmount($month = false)
    {
        $sells = new Pos();

        $sells = $sells->where('created_by', creatorId())->where('workspace',getActiveWorkSpace());

        if($month)
        {
            $sells = $sells->whereRaw('MONTH(created_at) = ?', [date('m')]);
        }

        $selledAmount = 0;
        foreach($sells->get() as $key => $sell)
        {
            $selledAmount += $sell->getTotal();
        }

        return currency_format_with_sym($selledAmount);
    }

    public function getTotal()
    {
        $subtotals = 0;
        foreach($this->PosProduct as $item)
        {

            $subtotals += ($item->price * $item->quantity);

        }

        return $subtotals;
    }
    public static function getSalesReportChart()
    {
        $sales = Pos::whereDate('created_at', '>', Carbon::now()->subDays(10))->where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->orderBy('created_at')->get()->groupBy(
                function ($val){
                    return Carbon::parse($val->created_at)->format('dm');
                }
            );
        $total = [];
        if(!empty($sales) && count($sales) > 0)
        {
            foreach($sales as $day => $onesale)
            {
                $totals = 0;
                foreach($onesale as $sale)
                {
                    $totals += $sale->getTotal();
                }
                $total[$day] = $totals;
            }
        }
        $m = date("m");
        $d = date("d");
        $y = date("Y");
        for($i = 0; $i <= 9; $i++)
        {
            $date                  = date('Y-m-d', mktime(0, 0, 0, $m, ($d - $i), $y));
            $salesArray['label'][] = $date;
            $date                  = date('dm', strtotime($date));
            $salesArray['value'][] = array_key_exists($date, $total) ? $total[$date] : 0;;
        }

        return $salesArray;
    }
    public static function templateData()
    {
        $arr              = [];
        $arr['colors']    = [
            '003580',
            '666666',
            '6676ef',
            'f50102',
            'f9b034',
            'fbdd03',
            'c1d82f',
            '37a4e4',
            '8a7966',
            '6a737b',
            '050f2c',
            '0e3666',
            '3baeff',
            '3368e6',
            'b84592',
            'f64f81',
            'f66c5f',
            'fac168',
            '46de98',
            '40c7d0',
            'be0028',
            '2f9f45',
            '371676',
            '52325d',
            '511378',
            '0f3866',
            '48c0b6',
            '297cc0',
            'ffffff',
            '000',
        ];
        $arr['templates'] = [
            "template1" => "New York",
            "template2" => "Toronto",
            "template3" => "Rio",
            "template4" => "London",
            "template5" => "Istanbul",
            "template6" => "Mumbai",
            "template7" => "Hong Kong",
            "template8" => "Tokyo",
            "template9" => "Sydney",
            "template10" => "Paris",
        ];
        return $arr;
    }

    public static function GivePermissionToRoles($role_id = null,$rolename = null)
    {
        if(module_is_active('Account'))
        {
            $vender_permissions=[

            ];
            if($role_id == Null)
            {
                // vender
                $roles_v = Role::where('name','vendor')->get();

                foreach($roles_v as $role)
                {
                    foreach($vender_permissions as $permission_v){
                        $permission = Permission::where('name',$permission_v)->first();
                        $role->givePermissionTo($permission);
                    }
                }
            }
            else
            {
                if($rolename == 'vendor'){
                    $roles_v = Role::where('name','vendor')->where('id',$role_id)->first();
                    foreach($vender_permissions as $permission_v){
                        $permission = Permission::where('name',$permission_v)->first();
                        $roles_v->givePermissionTo($permission);
                    }
                }
            }
        }

    }
    public static function defaultdata($company_id = null,$workspace_id = null)
    {
        $company_setting = [
            "purchase_prefix" => "#PUR",
            "pos_prefix" => "#POS",
            "low_product_stock_threshold" => "1",
            "purchase_template" => "template1",
            "pos_template" => "template1",
        ];
        $default_warehouses = [
            0=>[
                'name' => 'North Warehouse',
                'address' => '723 N. Tillamook Street Portland, OR Portland, United States',
                'city' => 'Portland',
                'city_zip' => 97227,
                'created_by' => 2,
            ],
        ];
        if($company_id == Null)
        {
            $companys = User::where('type','company')->get();
            foreach($companys as $company)
            {
                $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
                foreach($WorkSpaces as $WorkSpace)
                {

                    $userContext = new Context(['user_id' => $company->id,'workspace_id'=> !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
                    foreach($company_setting as $key =>  $p)
                    {
                            \Settings::context($userContext)->set($key, $p);
                    }
                    foreach($default_warehouses as $default_warehouse)
                    {
                        $warehouse= Warehouse::where('created_by',$company_id)->where('workspace',$WorkSpace->id)->first();
                        if($warehouse==null){
                            $new = new Warehouse();
                            $new->name = $default_warehouse['name'];
                            $new->address = $default_warehouse['address'];
                            $new->city = $default_warehouse['city'];
                            $new->city_zip = $default_warehouse['city_zip'];
                            $new->created_by = !empty($company->id) ? $company->id : 2;
                            $new->workspace = !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                            $new->save();
                        }
                    }
                }
            }
        }elseif($workspace_id == Null){
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
            foreach($WorkSpaces as $WorkSpace)
            {
                $userContext = new Context(['user_id' => $company->id,'workspace_id'=> !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
                foreach($company_setting as $key =>  $p)
                {
                        \Settings::context($userContext)->set($key, $p);
                }
                foreach($default_warehouses as $default_warehouse)
                {
                    $warehouse= Warehouse::where('created_by',$company_id)->where('workspace',$WorkSpace->id)->first();
                    if($warehouse==null){
                        $new = new Warehouse();
                        $new->name = $default_warehouse['name'];
                        $new->address = $default_warehouse['address'];
                        $new->city = $default_warehouse['city'];
                        $new->city_zip = $default_warehouse['city_zip'];
                        $new->created_by = !empty($company->id) ? $company->id : 2;
                        $new->workspace = !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                        $new->save();
                    }
                }
            }
        }else{
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpace = WorkSpace::where('created_by',$company->id)->where('id',$workspace_id)->first();
            $userContext = new Context(['user_id' => $company->id,'workspace_id'=> !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
            foreach($company_setting as $key =>  $p)
            {
                    \Settings::context($userContext)->set($key, $p);
            }
            foreach($default_warehouses as $default_warehouse)
            {
                $warehouse= Warehouse::where('created_by',$company_id)->where('workspace',$WorkSpace->id)->first();
                if($warehouse==null){
                    $new = new Warehouse();
                    $new->name = $default_warehouse['name'];
                    $new->address = $default_warehouse['address'];
                    $new->city = $default_warehouse['city'];
                    $new->city_zip = $default_warehouse['city_zip'];
                    $new->created_by = !empty($company->id) ? $company->id : 2;
                    $new->workspace = !empty($WorkSpace->id) ? $WorkSpace->id : 0 ;
                    $new->save();
                }
            }
        }
    }


    public static function tax($taxData)
    {

        $taxes  = [];
        if(!empty($taxData)){
            $taxArr = explode(',', $taxData);

            foreach($taxArr as $tax)
            {
                $taxes[] = \Modules\ProductService\Entities\Tax::find($tax);
            }
        }


        return $taxes;
    }

    public static function taxRate($taxRate, $price, $quantity)
    {
        return ($taxRate / 100) * ($price * $quantity);
    }

    public static function totalTaxRate($taxes)
    {

        $taxArr  = explode(',', $taxes);
        $taxRate = 0;

        foreach($taxArr as $tax)
        {

            $tax     = \Modules\ProductService\Entities\Tax::find($tax);
            $taxRate += !empty($tax->rate) ? $tax->rate : 0;
        }

        return $taxRate;
    }

    public function getSubTotal()
    {
        $subTotal = 0;
        foreach($this->items as $product)
        {

            $subTotal += ($product->price * $product->quantity);

        }

        return $subTotal;
    }

    public function getTotalDiscount()
    {
        $totalDiscount = 0;
        foreach($this->items as $product)
        {

            $totalDiscount += $product->discount;
        }

        return $totalDiscount;
    }

    public static function total_quantity($type, $quantity, $product_id)
    {
        if(module_is_active('ProductService'))
        {
            $product      = \Modules\ProductService\Entities\ProductService::find($product_id);
            if(($product->type == 'product'))
            {
                $pro_quantity = $product->quantity;

                if($type == 'minus')
                {
                    $product->quantity = $pro_quantity - $quantity;
                }
                else
                {
                    $product->quantity = $pro_quantity + $quantity;
                }
                $product->save();
            }
        }
    }
    public static function addWarehouseStock($product_id, $quantity, $warehouse_id)
    {

        $product     = WarehouseProduct::where('product_id' , $product_id)->where('warehouse_id' , $warehouse_id)->first();

        if($product){
            $pro_quantity = $product->quantity;
            $product_quantity = $pro_quantity + $quantity;
        }else{
            $product_quantity = $quantity;
        }

        $data = WarehouseProduct::updateOrCreate(
            ['warehouse_id' => $warehouse_id, 'product_id' => $product_id,'created_by' => \Auth::user()->id,'workspace'=>getActiveWorkSpace()],
            ['warehouse_id' => $warehouse_id, 'product_id' => $product_id, 'quantity' => $product_quantity,'created_by' => \Auth::user()->id,'workspace'=>getActiveWorkSpace()])
          ;


    }

    public static function addProductStock($product_id, $quantity, $type, $description,$type_id)
    {
        $stocks                = new \Modules\Account\Entities\StockReport();
        $stocks->product_id    = $product_id;
        $stocks->quantity	    = $quantity;
        $stocks->type          = $type;
        $stocks->type_id       = $type_id;
        $stocks->description   = $description;
        $stocks->workspace     = getActiveWorkSpace();
        $stocks->created_by    = creatorId();
        $stocks->save();
    }

     //quantity update in warehouse details
     public static function warehouse_quantity($type, $quantity, $product_id,$warehouse_id)
     {

        $product      = WarehouseProduct::where('warehouse_id',$warehouse_id)->where('product_id',$product_id)->first();

        $pro_quantity = (!empty($product) && !empty($product->quantity))?$product->quantity:0;

        if($type == 'minus')
        {
            $product->quantity = $pro_quantity!=0 ? $pro_quantity - $quantity : $quantity;
        }
        else
        {
            $product->quantity = $pro_quantity + $quantity;

        }
        $product->save();

     }

    //warehouse transfer
    public static function warehouse_transfer_qty($from_warehouse,$to_warehouse,$product_id,$quantity,$delete=null)
    {

        $toWarehouse      = WarehouseProduct::where('warehouse_id',$to_warehouse)->where('product_id',$product_id)->first();
        if(empty($toWarehouse)){
            if($delete != 'delete')
            {
                $transfer                = new WarehouseProduct();
                $transfer->warehouse_id  = $to_warehouse;
                $transfer->product_id    = $product_id;
                $transfer->quantity      = $quantity;
                $transfer->workspace     = getActiveWorkSpace();
                $transfer->created_by    = creatorId();
                $transfer->save();
            }
        }else{
            $toWarehouse->quantity   = $toWarehouse->quantity+$quantity;
            $toWarehouse->save();
        }
        $fromWarehouse               = WarehouseProduct::where('warehouse_id',$from_warehouse)->where('product_id',$product_id)->first();
        if(!empty($fromWarehouse))
        {
            $fromWarehouse->quantity     = ($fromWarehouse->quantity) - ($quantity);
            if($fromWarehouse->quantity <= 0){
                $fromWarehouse->delete();
            }
            else{
                $fromWarehouse->save();
            }
        }


    }


}
