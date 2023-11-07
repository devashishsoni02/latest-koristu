<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\WorkSpace;
use Rawilk\Settings\Support\Context;

class AccountUtility extends Model
{
    use HasFactory;

    public static function countCustomers()
    {
        return Customer::where('workspace', '=', getActiveWorkSpace())->count();
    }
    public static function countVendors()
    {
        return Vender::where('workspace', '=', getActiveWorkSpace())->count();
    }
    public static function countBills()
    {
        return Bill::where('workspace', '=', getActiveWorkSpace())->count();
    }
    public static function todayIncome()
    {
        $revenue      = Revenue::where('workspace', '=', getActiveWorkSpace())->whereRaw('Date(date) = CURDATE()')->sum('amount');
        $invoices     = \App\Models\Invoice:: select('*')->where('workspace', getActiveWorkSpace())->where('invoice_module','account')->whereRAW('Date(send_date) = CURDATE()')->get();
        $invoiceArray = array();
        foreach($invoices as $invoice)
        {
            $invoiceArray[] = $invoice->getTotal();
        }
        $totalIncome = (!empty($revenue) ? $revenue : 0) + (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);

        return $totalIncome;
    }

    public static function todayExpense()
    {
        $payment = Payment::where('workspace', '=', getActiveWorkSpace())->whereRaw('Date(date) = CURDATE()')->sum('amount');

        $bills = Bill:: select('*')->where('workspace', getActiveWorkSpace())->whereRAW('Date(send_date) = CURDATE()')->get();

        $billArray = array();
        foreach($bills as $bill)
        {
            $billArray[] = $bill->getTotal();
        }

        $totalExpense = (!empty($payment) ? $payment : 0) + (!empty($billArray) ? array_sum($billArray) : 0);

        return $totalExpense;
    }

    public static function incomeCurrentMonth()
    {
        $currentMonth = date('m');
        $revenue      = Revenue::where('workspace', '=', getActiveWorkSpace())->whereRaw('MONTH(date) = ?', [$currentMonth])->sum('amount');

        $invoices = \App\Models\Invoice:: select('*')->where('workspace', getActiveWorkSpace())->where('invoice_module','account')->whereRAW('MONTH(send_date) = ?', [$currentMonth])->get();

        $invoiceArray = array();
        foreach($invoices as $invoice)
        {
            $invoiceArray[] = $invoice->getTotal();
        }
        $totalIncome = (!empty($revenue) ? $revenue : 0) + (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);

        return $totalIncome;

    }

    public static function expenseCurrentMonth()
    {
        $currentMonth = date('m');

        $payment = Payment::where('workspace', '=', getActiveWorkSpace())->whereRaw('MONTH(date) = ?', [$currentMonth])->sum('amount');

        $bills     = Bill:: select('*')->where('workspace', getActiveWorkSpace())->whereRAW('MONTH(send_date) = ?', [$currentMonth])->get();
        $billArray = array();
        foreach($bills as $bill)
        {
            $billArray[] = $bill->getTotal();
        }

        $totalExpense = (!empty($payment) ? $payment : 0) + (!empty($billArray) ? array_sum($billArray) : 0);

        return $totalExpense;
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
    public static function taxRate($taxRate, $price, $quantity,$discount= 0)
    {
        return (($price*$quantity) - $discount) * ($taxRate /100);
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

    //start for customer and vendor balance update
    public static function userBalance($users, $id, $amount, $type)
    {
        if($users == 'customer')
        {
            $user = Customer::find($id);
        }
        else
        {
            $user = Vender::find($id);
        }

        if(!empty($user))
        {
            if($type == 'credit')
            {
                $oldBalance    = $user->balance;
                $userBalance = $oldBalance + $amount;
                $user->balance = $userBalance;
                $user->save();
            }
            elseif($type == 'debit')
            {
                $oldBalance    = $user->balance;
                $userBalance = $oldBalance - $amount;
                $user->balance = $userBalance;
                $user->save();
            }
        }
    }

    public static function updateUserBalance($users, $id, $amount, $type)
    {
        if($users == 'customer')
        {
            $user = Customer::find($id);
        }
        else
        {
            $user = Vender::find($id);
        }
        if(!empty($user))
        {
            if($type == 'credit')
            {
                $oldBalance    = $user->balance;
                $userBalance = $oldBalance - $amount;
                $user->balance = $userBalance;
                $user->save();
            }
            elseif($type == 'debit')
            {
                $oldBalance    = $user->balance;
                $userBalance = $oldBalance + $amount;
                $user->balance = $userBalance;
                $user->save();
            }
        }
    }
    //end for customer and vendor balance update

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
    // get font-color code accourding to bg-color
    public static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3)
        {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        }
        else
        {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array(
            $r,
            $g,
            $b,
        );

        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
    public static function getFontColor($color_code)
    {
        $rgb = self::hex2rgb($color_code);
        $R   = $G = $B = $C = $L = $color = '';

        $R = (floor($rgb[0]));
        $G = (floor($rgb[1]));
        $B = (floor($rgb[2]));

        $C = [
            $R / 255,
            $G / 255,
            $B / 255,
        ];

        for($i = 0; $i < count($C); ++$i)
        {
            if($C[$i] <= 0.03928)
            {
                $C[$i] = $C[$i] / 12.92;
            }
            else
            {
                $C[$i] = pow(($C[$i] + 0.055) / 1.055, 2.4);
            }
        }

        $L = 0.2126 * $C[0] + 0.7152 * $C[1] + 0.0722 * $C[2];

        if($L > 0.179)
        {
            $color = 'black';
        }
        else
        {
            $color = 'white';
        }

        return $color;
    }
    public static function addProductStock($product_id, $quantity, $type, $description,$type_id)
    {
        $stocks                = new StockReport();
        $stocks->product_id    = $product_id;
        $stocks->quantity	    = $quantity;
        $stocks->type          = $type;
        $stocks->type_id       = $type_id;
        $stocks->description   = $description;
        $stocks->workspace     = getActiveWorkSpace();
        $stocks->created_by    = \Auth::user()->id;
        $stocks->save();
    }

    public static function incomeCategoryRevenueAmount($id = null)
    {
        if($id != null)
        {
            $year    = date('Y');
            $revenue = Revenue::where('category_id', $id)->where('workspace', getActiveWorkSpace())->whereRAW('YEAR(date) =?', [$year])->sum('amount');

            $invoices     = \App\Models\Invoice::where('category_id',$id)->where('workspace', getActiveWorkSpace())->where('invoice_module','account')->whereRAW('YEAR(send_date) =?', [$year])->get();
            $invoiceArray = array();
            foreach($invoices as $invoice)
            {
                $invoiceArray[] = $invoice->getTotal();
            }
            $totalIncome = (!empty($revenue) ? $revenue : 0) + (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);
            return $totalIncome;
        }
        else
        {
            return 0;
        }


    }
    public static function expenseCategoryAmount($id = null)
    {
        if($id != null)
        {
            $year    = date('Y');
            $payment = Payment::where('category_id', $id)->where('workspace', getActiveWorkSpace())->whereRAW('YEAR(date) =?', [$year])->sum('amount');

            $bills     = Bill::where('category_id', $id)->where('workspace', getActiveWorkSpace())->whereRAW('YEAR(send_date) =?', [$year])->get();
            $billArray = array();
            foreach($bills as $bill)
            {
                $billArray[] = $bill->getTotal();
            }

            $totalExpense = (!empty($payment) ? $payment : 0) + (!empty($billArray) ? array_sum($billArray) : 0);

            return $totalExpense;
        }
        else
        {
            return 0;
        }
    }
    public static function getincExpBarChartData()
    {
        $month[]          = __('January');
        $month[]          = __('February');
        $month[]          = __('March');
        $month[]          = __('April');
        $month[]          = __('May');
        $month[]          = __('June');
        $month[]          = __('July');
        $month[]          = __('August');
        $month[]          = __('September');
        $month[]          = __('October');
        $month[]          = __('November');
        $month[]          = __('December');
        $dataArr['month'] = $month;

        for($i = 1; $i <= 12; $i++)
        {
            $monthlyIncome = Revenue::selectRaw('sum(amount) amount')->where('workspace', '=', getActiveWorkSpace())->whereRaw('year(`date`) = ?', array(date('Y')))->whereRaw('month(`date`) = ?', $i)->first();
            $invoices      = \App\Models\Invoice::select('*')->where('workspace', getActiveWorkSpace())->whereRaw('year(`send_date`) = ?', array(date('Y')))->where('invoice_module','account')->whereRaw('month(`send_date`) = ?', $i)->get();

            $invoiceArray = array();
            foreach($invoices as $invoice)
            {
                $invoiceArray[] = $invoice->getTotal();
            }
            $totalIncome = (!empty($monthlyIncome) ? $monthlyIncome->amount : 0) + (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);

            $incomeArr[] = !empty($totalIncome) ? number_format($totalIncome, 2) : 0;

            $monthlyExpense = Payment::selectRaw('sum(amount) amount')->where('workspace', '=', getActiveWorkSpace())->whereRaw('year(`date`) = ?', array(date('Y')))->whereRaw('month(`date`) = ?', $i)->first();
            $bills          = Bill::select('*')->where('workspace', getActiveWorkSpace())->whereRaw('year(`send_date`) = ?', array(date('Y')))->whereRaw('month(`send_date`) = ?', $i)->get();
            $billArray      = array();
            foreach($bills as $bill)
            {
                $billArray[] = $bill->getTotal();
            }
            $totalExpense = (!empty($monthlyExpense) ? $monthlyExpense->amount : 0) + (!empty($billArray) ? array_sum($billArray) : 0);

            $expenseArr[] = !empty($totalExpense) ? number_format($totalExpense, 2) : 0;
        }

        $dataArr['income']  = $incomeArr;
        $dataArr['expense'] = $expenseArr;
        return $dataArr;
    }
    public static function getIncExpLineChartDate()
    {
        $m             = date("m");
        $de            = date("d");
        $y             = date("Y");
        $format        = 'Y-m-d';
        $arrDate       = [];
        $arrDateFormat = [];

        for($i = 0; $i <= 15 - 1; $i++)
        {
            $date = date($format, mktime(0, 0, 0, $m, ($de - $i), $y));

            $arrDay[]        = date('D', mktime(0, 0, 0, $m, ($de - $i), $y));
            $arrDate[]       = $date;
            $arrDateFormat[] = date("d-M", strtotime($date));
        }
        $dataArr['day'] = $arrDateFormat;

        for($i = 0; $i < count($arrDate); $i++)
        {
            $dayIncome = Revenue::selectRaw('sum(amount) amount')->where('workspace', getActiveWorkSpace())->whereRaw('date = ?', $arrDate[$i])->first();

            $invoices     = \App\Models\Invoice:: select('*')->where('workspace', getActiveWorkSpace())->where('invoice_module','account')->whereRAW('send_date = ?', $arrDate[$i])->get();
            $invoiceArray = array();
            foreach($invoices as $invoice)
            {
                $invoiceArray[] = $invoice->getTotal();
            }

            $incomeAmount = (!empty($dayIncome->amount) ? $dayIncome->amount : 0) + (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);
            $incomeArr[]  = str_replace(",", "", number_format($incomeAmount, 2));

            $dayExpense = Payment::selectRaw('sum(amount) amount')->where('workspace', getActiveWorkSpace())->whereRaw('date = ?', $arrDate[$i])->first();

            $bills     = Bill:: select('*')->where('workspace', getActiveWorkSpace())->whereRAW('send_date = ?', $arrDate[$i])->get();
            $billArray = array();
            foreach($bills as $bill)
            {
                $billArray[] = $bill->getTotal();
            }
            $expenseAmount = (!empty($dayExpense->amount) ? $dayExpense->amount : 0) + (!empty($billArray) ? array_sum($billArray) : 0);
            $expenseArr[]  = str_replace(",", "", number_format($expenseAmount, 2));
        }

        $dataArr['income']  = $incomeArr;
        $dataArr['expense'] = $expenseArr;

        return $dataArr;
    }

    public static function GivePermissionToRoles($role_id = null,$rolename = null)
    {
        $client_permissions=[
            'creditnote manage',
            'revenue manage',
            'account manage',
            'sidebar income manage',

        ];


        $vendor_permissions=[
            'account manage',
            'vendor show',
            'bill show',
            'user profile manage',
            'vendor manage',
            'sidebar expanse manage',
            'bill manage',
            'bill payment manage',
            'workspace manage',


        ];

        if($role_id == Null)
        {
            // client
            $roles_c = Role::where('name','client')->get();
            foreach($roles_c as $role)
            {
                foreach($client_permissions as $permission_c){
                    $permission = Permission::where('name',$permission_c)->first();
                    $role->givePermissionTo($permission);
                }
            }

            // vendor
            $roles_v = Role::where('name','vendor')->get();

            foreach($roles_v as $role)
            {
                foreach($vendor_permissions as $permission_v){
                    $permission = Permission::where('name',$permission_v)->first();
                    $role->givePermissionTo($permission);
                }
            }

        }
        else
        {
            if($rolename == 'client')
            {
                $roles_c = Role::where('name','client')->where('id',$role_id)->first();
                foreach($client_permissions as $permission_c){
                    $permission = Permission::where('name',$permission_c)->first();
                    $roles_c->givePermissionTo($permission);
                }
            }
            elseif($rolename == 'vendor')
            {
                $roles_v = Role::where('name','vendor')->where('id',$role_id)->first();
                foreach($vendor_permissions as $permission_v){
                    $permission = Permission::where('name',$permission_v)->first();
                    $roles_v->givePermissionTo($permission);
                }
            }
        }

    }
    public static function defaultdata($company_id = null,$workspace_id = null)
    {
        $company_setting = [
            "customer_prefix" => "#CUST",
            "vendor_prefix" => "#VEND",
            "bill_prefix" => "#BILL",
            "bill_starting_number" => "1",
            "bill_template" => "template1",
        ];
        if(!empty($company_id)){
            $vendor_role = Role::where('name','vendor')->where('created_by',$company_id)->where('guard_name','web')->first();
            if(empty($vendor_role))
            {
                $vendor_role                   = new Role();
                $vendor_role->name             = 'vendor';
                $vendor_role->guard_name       = 'web';
                $vendor_role->module           = 'Base';
                $vendor_role->created_by       = $company_id;
                $vendor_role->save();

            }
            if(!empty($workspace_id)){
                $bank_account= New BankAccount();
                $bank_account->holder_name= 'cash';
                $bank_account->bank_name= '';
                $bank_account->account_number= '-';
                $bank_account->opening_balance='0.00';
                $bank_account->contact_number= '-';
                $bank_account->bank_address= '-';
                $bank_account->workspace= $workspace_id;
                $bank_account->created_by= $company_id;
                $bank_account->save();
            }
        }
        if($company_id == Null)
        {
            $companys = User::where('type','company')->get();
            foreach($companys as $company)
            {
                $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
                foreach($WorkSpaces as $WorkSpace)
                {
                    $bank=BankAccount::where('workspace',$WorkSpace->id)->where('created_by',$company->id)->first();
                    if(empty($bank)){
                        $bank_account= New BankAccount();
                        $bank_account->holder_name= 'cash';
                        $bank_account->bank_name= '';
                        $bank_account->account_number= '-';
                        $bank_account->opening_balance='0.00';
                        $bank_account->contact_number= '-';
                        $bank_account->bank_address= '-';
                        $bank_account->workspace= $WorkSpace->id;
                        $bank_account->created_by= $company->id;
                        $bank_account->save();
                    }

                    $userContext = new Context(['user_id' => $company->id,'workspace_id'=> !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
                    foreach($company_setting as $key =>  $p)
                    {
                            \Settings::context($userContext)->set($key, $p);
                    }
                }
            }
        }elseif($workspace_id == Null){
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpaces = WorkSpace::where('created_by',$company->id)->get();
            foreach($WorkSpaces as $WorkSpace)
            {
                $bank=BankAccount::where('workspace',$WorkSpace->id)->where('created_by',$company->id)->first();
                    if(empty($bank)){
                        $bank_account= New BankAccount();
                        $bank_account->holder_name= 'cash';
                        $bank_account->bank_name= '';
                        $bank_account->account_number= '-';
                        $bank_account->opening_balance='0.00';
                        $bank_account->contact_number= '-';
                        $bank_account->bank_address= '-';
                        $bank_account->workspace= $WorkSpace->id;
                        $bank_account->created_by= $company->id;
                        $bank_account->save();
                    }
                $userContext = new Context(['user_id' => $company->id,'workspace_id'=> !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
                foreach($company_setting as $key =>  $p)
                {
                        \Settings::context($userContext)->set($key, $p);
                }
            }
        }else{
            $company = User::where('type','company')->where('id',$company_id)->first();
            $WorkSpace = WorkSpace::where('created_by',$company->id)->where('id',$workspace_id)->first();
            $userContext = new Context(['user_id' => $company->id,'workspace_id'=> !empty($WorkSpace->id) ? $WorkSpace->id : 0]);
            $bank=BankAccount::where('workspace',$WorkSpace->id)->where('created_by',$company->id)->first();
                    if(empty($bank)){
                        $bank_account= New BankAccount();
                        $bank_account->holder_name= 'cash';
                        $bank_account->bank_name= '';
                        $bank_account->account_number= '-';
                        $bank_account->opening_balance='0.00';
                        $bank_account->contact_number= '-';
                        $bank_account->bank_address= '-';
                        $bank_account->workspace= $WorkSpace->id;
                        $bank_account->created_by= $company->id;
                        $bank_account->save();
                    }
            foreach($company_setting as $key =>  $p)
            {
                    \Settings::context($userContext)->set($key, $p);
            }
        }
    }
}
