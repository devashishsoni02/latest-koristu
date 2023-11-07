<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Rawilk\Settings\Support\Context;



class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'vendor_id',
        'user_id',
        'bill_date',
        'due_date',
        'order_number',
        'status',
        'bill_shipping_display',
        'send_date',
        'discount_apply',
        'bill_module',
        'category_id',
        'workspace',
        'created_by'
    ];

    protected static function newFactory()
    {
        return \Modules\Account\Database\factories\BillFactory::new();
    }
    public static $statues = [
        'Draft',
        'Sent',
        'Unpaid',
        'Partialy Paid',
        'Paid',
    ];
    public function vendor()
    {
        return $this->hasOne(Vender::class, 'id', 'vendor_id');
    }
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }
    public function category()
    {
        if(module_is_active('ProductService'))
        {
            return $this->hasOne(\Modules\ProductService\Entities\Category::class, 'id', 'category_id');
        }
    }
    public function items()
    {
        return $this->hasMany(BillProduct::class, 'bill_id', 'id');
    }
    public function debitNote()
    {
        return $this->hasMany(DebitNote::class, 'bill', 'id');
    }
    public function billTotalDebitNote()
    {
        return $this->hasMany(DebitNote::class, 'bill', 'id')->sum('amount');
    }
    public function payments()
    {
        return $this->hasMany(BillPayment::class, 'bill_id', 'id');
    }
    public function getSubTotal()
    {
        $subTotal = 0;
        foreach ($this->items as $product) {
            $subTotal += ($product->price * $product->quantity);
        }

        return $subTotal;
    }
    public function getTotalDiscount()
    {
        $totalDiscount = 0;
        foreach ($this->items as $product) {
            $totalDiscount += $product->discount;
        }

        return $totalDiscount;
    }
    public function getTotal()
    {
        return ($this->getSubTotal() + $this->getTotalTax()) - $this->getTotalDiscount();
    }
    public function getTotalTax()
    {
        $totalTax = 0;
        foreach ($this->items as $product) {
            $taxes = AccountUtility::totalTaxRate($product->tax);
            $totalTax += ($taxes / 100) * ($product->price * $product->quantity - $product->discount) ;
        }

        return $totalTax;
    }
    public function getDue()
    {
        $due = 0;
        foreach ($this->payments as $payment) {
            $due += $payment->amount;
        }
        return ($this->getTotal() - $due) - ($this->billTotalDebitNote());
    }
    public static function billNumberFormat($number,$company_id = null,$workspace_id = null)
    {
        if(!empty($company_id)&& empty($workspace_id)){
            $data = !empty(company_setting('bill_prefix',$company_id)) ? company_setting('bill_prefix',$company_id) : '#BILL0000';

        }elseif(!empty($company_id)&& !empty($workspace_id)){
            $data = !empty(company_setting('bill_prefix',$company_id,$workspace_id)) ? company_setting('bill_prefix',$company_id,$workspace_id) : '#BILL0000';
        }else{
            $data = !empty(company_setting('bill_prefix')) ? company_setting('bill_prefix') : '#BILL0000';
        }
        return $data. sprintf("%05d", $number);
    }

     //add quantity in product stock
     public static function addProductStock($product_id, $quantity, $type, $description,$type_id)
     {
        $stocks                = new StockReport();
        $stocks->product_id    = $product_id;
        $stocks->quantity	   = $quantity;
        $stocks->type          = $type;
        $stocks->type_id       = $type_id;
        $stocks->description   = $description;
        $stocks->workspace     = getActiveWorkSpace();
        $stocks->created_by    = \Auth::user()->id;
        $stocks->save();
     }
     public static function weeklyBill()
     {
         $staticstart = date('Y-m-d', strtotime('last Week'));
         $currentDate = date('Y-m-d');
         $bills       = Bill:: select('*')->where('workspace', getActiveWorkSpace())->where('bill_date', '>=', $staticstart)->where('bill_date', '<=', $currentDate)->get();
         $billTotal   = 0;
         $billPaid    = 0;
         $billDue     = 0;
         foreach($bills as $bill)
         {
             $billTotal += $bill->getTotal();
             $billPaid  += ($bill->getTotal() - $bill->getDue());
             $billDue   += $bill->getDue();
         }

         $billDetail['billTotal'] = $billTotal;
         $billDetail['billPaid']  = $billPaid;
         $billDetail['billDue']   = $billDue;

         return $billDetail;
     }

     public static function monthlyBill()
     {
         $staticstart = date('Y-m-d', strtotime('last Month'));
         $currentDate = date('Y-m-d');
         $bills       = Bill:: select('*')->where('workspace', getActiveWorkSpace())->where('bill_date', '>=', $staticstart)->where('bill_date', '<=', $currentDate)->get();
         $billTotal   = 0;
         $billPaid    = 0;
         $billDue     = 0;
         foreach($bills as $bill)
         {
             $billTotal += $bill->getTotal();
             $billPaid  += ($bill->getTotal() - $bill->getDue());
             $billDue   += $bill->getDue();
         }

         $billDetail['billTotal'] = $billTotal;
         $billDetail['billPaid']  = $billPaid;
         $billDetail['billDue']   = $billDue;

         return $billDetail;
     }
     public function lastPayments()
    {
        return $this->hasOne(BillPayment::class, 'bill_id', 'bill_id');
    }
     public static function starting_number($id, $type)
    {
        if($type == 'invoice')
        {
            $userContext = new Context(['user_id' => creatorId(),'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('invoice_starting_number', $id);
        }
        elseif($type == 'proposal')
        {
            $userContext = new Context(['user_id' => creatorId(),'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('proposal_starting_number', $id);
        }
        elseif($type == 'retainer')
        {
            $userContext = new Context(['user_id' => creatorId(),'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('retainer_starting_number', $id);
        }
        elseif($type == 'bill')
        {
            $userContext = new Context(['user_id' => creatorId(),'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('bill_starting_number', $id);
        }
        return true;
    }

}
