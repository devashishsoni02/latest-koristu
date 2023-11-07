<?php

namespace Modules\Account\Database\Seeders;

use App\Models\Sidebar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SidebarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $dashboard = Sidebar::where('title',__('Dashboard'))->where('parent_id',0)->where('type','company')->first();
        $Account_dash = Sidebar::where('title',__('Accounting Dashboard'))->where('parent_id',$dashboard->id)->where('type','company')->first();
        if($Account_dash == null)
        {
                 Sidebar::create( [
                'title' => 'Accounting Dashboard',
                'icon' => '',
                'parent_id' => $dashboard->id,
                'sort_order' => 20,
                'route' => 'dashboard.account',
                'permissions' => 'account dashboard manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }

        $check = Sidebar::where('title',__('Accounting'))->where('parent_id',0)->where('type','company')->first();
        if($check == null)
        {
            $check = Sidebar::create( [
                'title' => 'Accounting',
                'icon' => 'ti ti-layout-grid-add',
                'parent_id' => 0,
                'sort_order' => 320,
                'route' => null,
                'permissions' => 'account manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $customer = Sidebar::where('title',__('Customer'))->where('parent_id',$check->id)->where('type','company')->first();
        if($customer == null)
        {
            Sidebar::create( [
                'title' => 'Customer',
                'icon' => '',
                'parent_id' => $check->id,
                'sort_order' => 10,
                'route' => 'customer.index',
                'permissions' => 'customer manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $vendor = Sidebar::where('title',__('Vendor'))->where('parent_id',$check->id)->where('type','company')->first();
        if($vendor == null)
        {
            Sidebar::create( [
                'title' => 'Vendor',
                'icon' => '',
                'parent_id' => $check->id,
                'sort_order' => 15,
                'route' => 'vendors.index',
                'permissions' => 'vendor manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $banking = Sidebar::where('title',__('Banking'))->where('parent_id',$check->id)->where('type','company')->first();
        if($banking == null)
        {
            $banking = Sidebar::create( [
                'title' => 'Banking',
                'icon' => '',
                'parent_id' => $check->id,
                'sort_order' => 20,
                'route' => '',
                'permissions' => 'sidebar banking manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $bank_account = Sidebar::where('title',__('Account'))->where('parent_id',$banking->id)->where('type','company')->first();
        if($bank_account == null)
        {
            Sidebar::create( [
                'title' => 'Account',
                'icon' => '',
                'parent_id' => $banking->id,
                'sort_order' => 10,
                'route' => 'bank-account.index',
                'permissions' => 'bank account manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $transfer = Sidebar::where('title',__('Transfer'))->where('parent_id',$banking->id)->where('type','company')->first();
        if($transfer == null)
        {
            Sidebar::create( [
                'title' => 'Transfer',
                'icon' => '',
                'parent_id' => $banking->id,
                'sort_order' => 15,
                'route' => 'bank-transfer.index',
                'permissions' => 'bank transfer manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $Income = Sidebar::where('title',__('Income'))->where('parent_id',$check->id)->where('type','company')->first();
        if($Income == null)
        {
           $Income =  Sidebar::create( [
                'title' => 'Income',
                'icon' => '',
                'parent_id' => $check->id,
                'sort_order' => 25,
                'route' => null,
                'permissions' => 'sidebar income manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $revenue = Sidebar::where('title',__('Revenue'))->where('parent_id',$Income->id)->where('type','company')->first();
        if($revenue == null)
        {
            Sidebar::create( [
                'title' => 'Revenue',
                'icon' => '',
                'parent_id' => $Income->id,
                'sort_order' => 10,
                'route' => 'revenue.index',
                'permissions' => 'revenue manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }

        $expense = Sidebar::where('title',__('Expense'))->where('parent_id',$check->id)->where('type','company')->first();
        if($expense == null)
        {
           $expense =  Sidebar::create( [
                'title' => 'Expense',
                'icon' => '',
                'parent_id' => $check->id,
                'sort_order' => 30,
                'route' => '',
                'permissions' => 'sidebar expanse manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $bill = Sidebar::where('title',__('Bill'))->where('parent_id',$expense->id)->where('type','company')->first();
        if($bill == null)
        {
            Sidebar::create( [
                    'title' => 'Bill',
                    'icon' => '',
                    'parent_id' => $expense->id,
                    'sort_order' => 10,
                    'route' => 'bill.index',
                    'permissions' => 'bill manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $payment = Sidebar::where('title',__('Payment'))->where('parent_id',$expense->id)->where('type','company')->first();
        if($payment == null)
        {
            Sidebar::create( [
                'title' => 'Payment',
                'icon' => '',
                'parent_id' => $expense->id,
                'sort_order' => 15,
                'route' => 'payment.index',
                'permissions' => 'bill payment manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $report = Sidebar::where('title',__('Report'))->where('parent_id',$check->id)->where('type','company')->first();
        if($report == null)
        {
           $report =  Sidebar::create( [
                'title' => 'Report',
                'icon' => '',
                'parent_id' => $check->id,
                'sort_order' => 50,
                'route' => null,
                'permissions' => 'report manage',
                'module' => 'Account',
                'type'=>'company',
            ]);
        }
        $transaction = Sidebar::where('title',__('Transaction'))->where('parent_id',$report->id)->where('type','company')->first();
        if($transaction == null)
        {
            Sidebar::create( [
                    'title' => 'Transaction',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 10,
                    'route' => 'transaction.index',
                    'permissions' => 'report transaction manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }

        $account_statement = Sidebar::where('title',__('Account Statement'))->where('parent_id',$report->id)->where('type','company')->first();
        if($account_statement == null)
        {
            Sidebar::create( [
                    'title' => 'Account Statement',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 15,
                    'route' => 'report.account.statement',
                    'permissions' => 'report statement manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $income_summary = Sidebar::where('title',__('Income Summary'))->where('parent_id',$report->id)->where('type','company')->first();
        if($income_summary == null)
        {
            Sidebar::create( [
                    'title' => 'Income Summary',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 20,
                    'route' => 'report.income.summary',
                    'permissions' => 'report income manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $expense_summary = Sidebar::where('title',__('Expense Summary'))->where('parent_id',$report->id)->where('type','company')->first();
        if($expense_summary == null)
        {
            Sidebar::create( [
                    'title' => 'Expense Summary',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 25,
                    'route' => 'report.expense.summary',
                    'permissions' => 'report expense',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $income_vs_expense = Sidebar::where('title',__('Income Vs Expense'))->where('parent_id',$report->id)->where('type','company')->first();
        if($income_vs_expense == null)
        {
            Sidebar::create( [
                    'title' => 'Income Vs Expense',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 30,
                    'route' => 'report.income.vs.expense.summary',
                    'permissions' => 'report income vs expense manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $tax_summary = Sidebar::where('title',__('Tax Summary'))->where('parent_id',$report->id)->where('type','company')->first();
        if($tax_summary == null)
        {
            Sidebar::create([
                    'title' => 'Tax Summary',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 35,
                    'route' => 'report.tax.summary',
                    'permissions' => 'report tax manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $profit_loss = Sidebar::where('title',__('Profit & Loss'))->where('parent_id',$report->id)->where('type','company')->first();
        if($profit_loss == null)
        {
            Sidebar::create([
                    'title' => 'Profit & Loss',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 40,
                    'route' => 'report.profit.loss.summary',
                    'permissions' => 'report loss & profit  manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $invoice_summary = Sidebar::where('title',__('Invoice Summary'))->where('parent_id',$report->id)->where('type','company')->first();
        if($invoice_summary == null)
        {
            Sidebar::create([
                    'title' => 'Invoice Summary',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 45,
                    'route' => 'report.invoice.summary',
                    'permissions' => 'report invoice manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $bill_summary = Sidebar::where('title',__('Bill Summary'))->where('parent_id',$report->id)->where('type','company')->first();
        if($bill_summary == null)
        {
            Sidebar::create([
                    'title' => 'Bill Summary',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 50,
                    'route' => 'report.bill.summary',
                    'permissions' => 'report bill manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
        $product_stock = Sidebar::where('title',__('Product Stock'))->where('parent_id',$report->id)->where('type','company')->first();
        if($product_stock == null)
        {
            Sidebar::create([
                    'title' => 'Product Stock',
                    'icon' => '',
                    'parent_id' => $report->id,
                    'sort_order' => 55,
                    'route' => 'report.product.stock.report',
                    'permissions' => 'report stock manage',
                    'module' => 'Account',
                'type'=>'company',
                ]);
        }
    }
}
