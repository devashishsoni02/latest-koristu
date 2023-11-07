<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\StockReport;
use Rawilk\Settings\Support\Context;


class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'customer_id',
        'issue_date',
        'due_date',
        'send_date',
        'category_id',
        'ref_number',
        'status',
        'invoice_module',
        'shipping_display',
        'discount_apply',
        'workspace',
        'created_by'
    ];
    public static $statues = [
        'Draft',
        'Sent',
        'Unpaid',
        'Partialy Paid',
        'Paid',
    ];
    public static function countInvoices()
    {
        return Invoice::where('workspace', '=', getActiveWorkSpace())->count();
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function category()
    {
        return $this->hasOne(\Modules\ProductService\Entities\Category::class, 'id', 'category_id');
    }
    public static function invoiceNumberFormat($number,$company_id = null,$workspace = null)
    {
        // dd($number);
        if(!empty($company_id) && empty($workspace))
        {
            $data = !empty(company_setting('invoice_prefix',$company_id)) ? company_setting('invoice_prefix',$company_id) : '#INVO0';
        }
        elseif(!empty($company_id) && !empty($workspace))
        {
            $data = !empty(company_setting('invoice_prefix',$company_id,$workspace)) ? company_setting('invoice_prefix',$company_id,$workspace) : '#INVO';
        }
        else
        {
            $data = !empty(company_setting('invoice_prefix')) ? company_setting('invoice_prefix') : '#INVO0';
        }

        return $data. sprintf("%05d", $number);
    }
    public function items()
    {
        return $this->hasMany(InvoiceProduct::class, 'invoice_id', 'id');
    }
    public function payments()
    {
        return $this->hasMany(InvoicePayment::class, 'invoice_id', 'id');
    }
    public function creditNote()
    {
        if(module_is_active('Account'))
        {
            return $this->hasMany(\Modules\Account\Entities\CreditNote::class, 'invoice', 'id');
        }
        else
        {
            return [];
        }
    }
    public function invoiceTotalCreditNote()
    {
        if(module_is_active('Account'))
        {
            return $this->hasMany(\Modules\Account\Entities\CreditNote::class, 'invoice', 'id')->sum('amount');
        }
        else
        {
            return 0;
        }
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
        foreach($this->items as $product)
        {
            $totalDiscount += $product->discount;
        }
        return $totalDiscount;
    }
    public static function taxRate($taxRate, $price, $quantity,$discount = 0)
    {
        return ($taxRate / 100) * (($price * $quantity) - $discount);
    }
    public static function tax($taxes)
    {
        if(module_is_active('ProductService'))
        {
            $taxArr = explode(',', $taxes);
            $taxes  = [];
            foreach($taxArr as $tax)
            {
                $taxes[] = \Modules\ProductService\Entities\Tax::find($tax);
            }

            return $taxes;
        }
        else
        {
            return [];
        }
    }
    public static function totalTaxRate($taxes)
    {
        if(module_is_active('ProductService'))
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
        else
        {
            return 0;
        }
    }
    public function getTotalTax()
    {
        $totalTax = 0;
        foreach ($this->items as $product)
        {
            if(module_is_active('ProductService'))
            {
                $taxes = $this->totalTaxRate($product->tax);
            }
            else
            {
                $taxes = 0;
            }
            $totalTax += ($taxes / 100) * (($product->price * $product->quantity) - $product->discount);
        }

        return $totalTax;
    }
    public function getTotal()
    {
        return ($this->getSubTotal() - $this->getTotalDiscount() + $this->getTotalTax());
    }
    public function getDue()
    {
        $due = 0;
        foreach ($this->payments as $payment)
        {
            $due += $payment->amount;
        }

        return ($this->getTotal() - $due) - $this->invoiceTotalCreditNote();
    }

    public static function starting_number($id, $type)
    {
        if($type == 'invoice')
        {
            $userContext = new Context(['user_id' => Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('invoice_starting_number', $id);
        }
        elseif($type == 'proposal')
        {
            $userContext = new Context(['user_id' => Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('proposal_starting_number', $id);
        }
        elseif($type == 'retainer')
        {
            $userContext = new Context(['user_id' => Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('retainer_starting_number', $id);
        }
        elseif($type == 'bill')
        {
            $userContext = new Context(['user_id' => Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);
            \Settings::context($userContext)->set('bill_starting_number', $id);
        }
        return true;
    }
    public static function total_quantity($type, $quantity, $product_id)
    {
        if(module_is_active('ProductService'))
        {
            $product      = \Modules\ProductService\Entities\ProductService::find($product_id);
            if(!empty($product)){
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
    }

    public static function weeklyInvoice()
    {
        $staticstart  = date('Y-m-d', strtotime('last Week'));
        $currentDate  = date('Y-m-d');
        $invoices     = Invoice:: select('*')->where('workspace', getActiveWorkSpace())->where('issue_date', '>=', $staticstart)->where('invoice_module','account')->where('issue_date', '<=', $currentDate)->get();
        $invoiceTotal = 0;
        $invoicePaid  = 0;
        $invoiceDue   = 0;
        foreach($invoices as $invoice)
        {
            $invoiceTotal += $invoice->getTotal();
            $invoicePaid  += ($invoice->getTotal() - $invoice->getDue());
            $invoiceDue   += $invoice->getDue();
        }

        $invoiceDetail['invoiceTotal'] = $invoiceTotal;
        $invoiceDetail['invoicePaid']  = $invoicePaid;
        $invoiceDetail['invoiceDue']   = $invoiceDue;

        return $invoiceDetail;
    }

    public static function monthlyInvoice()
    {
        $staticstart  = date('Y-m-d', strtotime('last Month'));
        $currentDate  = date('Y-m-d');
        $invoices     = Invoice:: select('*')->where('workspace', getActiveWorkSpace())->where('issue_date', '>=', $staticstart)->where('invoice_module','account')->where('issue_date', '<=', $currentDate)->get();
        $invoiceTotal = 0;
        $invoicePaid  = 0;
        $invoiceDue   = 0;
        foreach($invoices as $invoice)
        {
            $invoiceTotal += $invoice->getTotal();
            $invoicePaid  += ($invoice->getTotal() - $invoice->getDue());
            $invoiceDue   += $invoice->getDue();
        }

        $invoiceDetail['invoiceTotal'] = $invoiceTotal;
        $invoiceDetail['invoicePaid']  = $invoicePaid;
        $invoiceDetail['invoiceDue']   = $invoiceDue;

        return $invoiceDetail;
    }

    public static function addProductStock($product_id, $quantity, $type, $description,$type_id)
    {
        $stocks                = new \Modules\Account\Entities\StockReport();
        $stocks->product_id    = $product_id;
        $stocks->quantity	   = $quantity;
        $stocks->type          = $type;
        $stocks->type_id       = $type_id;
        $stocks->description   = $description;
        $stocks->workspace     = getActiveWorkSpace();
        $stocks->created_by    = \Auth::user()->id;
        $stocks->save();
    }
}
