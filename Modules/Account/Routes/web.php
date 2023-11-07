<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => 'PlanModuleCheck:Account'], function ()
    {
    Route::prefix('account')->group(function() {
        Route::get('/', 'AccountController@index');
    });
    // dashboard
    Route::get('dashboard/account',['as' => 'dashboard.account','uses' =>'AccountController@index'])->middleware(['auth']);




    // Bank account
    Route::resource('bank-account', 'BankAccountController')->middleware(
        [
            'auth'
        ]
    );
    // Transfer
    Route::resource('bank-transfer', 'TransferController')->middleware(
        [
            'auth'
        ]
    );

    // customer
    Route::resource('customer', 'CustomerController')->middleware(
        [
            'auth'
        ]
    );
    Route::get('customer-grid', 'CustomerController@grid')->name('customer.grid')->middleware(
        [
            'auth'
        ]
    );

    Route::ANY('customer/{id}/statement', 'CustomerController@statement')->name('customer.statement')->middleware(
        [
            'auth'
        ]
    );

    // Customer import
     Route::get('customer/import/export', 'CustomerController@fileImportExport')->name('customer.file.import')->middleware(['auth']);
     Route::post('customer/import', 'CustomerController@fileImport')->name('customer.import')->middleware(['auth']);
     Route::get('customer/import/modal', 'CustomerController@fileImportModal')->name('customer.import.modal')->middleware(['auth']);
     Route::post('customer/data/import/', 'CustomerController@customerImportdata')->name('customer.import.data')->middleware(['auth']);


    // Vendor
    Route::resource('vendors', 'VenderController')->middleware(
        [
            'auth'
        ]
    );
    Route::get('vendors-grid', 'VenderController@grid')->name('vendors.grid')->middleware(
        [
            'auth'
        ]
    );
    Route::ANY('vendors/{id}/statement', 'VenderController@statement')->name('vendor.statement')->middleware(
        [
            'auth'
        ]
    );

     // Vendor import
     Route::get('vendor/import/export', 'VenderController@fileImportExport')->name('vendor.file.import')->middleware(['auth']);
     Route::post('vendor/import', 'VenderController@fileImport')->name('vendor.import')->middleware(['auth']);
     Route::get('vendor/import/modal', 'VenderController@fileImportModal')->name('vendor.import.modal')->middleware(['auth']);
     Route::post('vendor/data/import/', 'VenderController@vendorImportdata')->name('vendor.import.data')->middleware(['auth']);

    // credit note
    Route::get('invoice/{id}/credit-note', 'CreditNoteController@create')->name('invoice.credit.note')->middleware(
        [
            'auth'
        ]
    );
    Route::post('invoice/{id}/credit-note', 'CreditNoteController@store')->name('invoice.credit.note')->middleware(
        [
            'auth'
        ]
    );
    Route::get('invoice/{id}/credit-note/edit/{cn_id}', 'CreditNoteController@edit')->name('invoice.edit.credit.note')->middleware(
        [
            'auth'
        ]
    );
    Route::post('invoice/{id}/credit-note/edit/{cn_id}', 'CreditNoteController@update')->name('invoice.edit.credit.note')->middleware(
        [
            'auth'
        ]
    );
    Route::delete('invoice/{id}/credit-note/delete/{cn_id}', 'CreditNoteController@destroy')->name('invoice.delete.credit.note')->middleware(
        [
            'auth'
        ]
    );

    // revenue
    Route::resource('revenue', 'RevenueController')->middleware(
        [
            'auth',
        ]
    );

    // bill payment
    Route::resource('payment', 'PaymentController')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill-attechment/{id}', 'BillController@billAttechment')->name('bill.file.upload')->middleware(
        [
            'auth'
        ]
    );
    Route::delete('bill-attechment/destroy/{id}', 'BillController@billAttechmentDestroy')->name('bill.attachment.destroy')->middleware(
        [
            'auth'
        ]
    );
    Route::post('bill/vendors', 'BillController@vendor')->name('bill.vendor')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill/product', 'BillController@product')->name('bill.product')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill/items', 'BillController@items')->name('bill.items')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('bill', 'BillController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill-grid', 'BillController@grid')->name('bill.grid')->middleware(
        [
            'auth'
        ]
    );
    Route::get('bill/create/{cid}', 'BillController@create')->name('bill.create')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill/product/destroy', 'BillController@productDestroy')->name('bill.product.destroy')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill/{id}/duplicate', 'BillController@duplicate')->name('bill.duplicate')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill/{id}/sent', 'BillController@sent')->name('bill.sent')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill/{id}/payment', 'BillController@payment')->name('bill.payment')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill/{id}/payment', 'BillController@createPayment')->name('bill.payment')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill/{id}/payment/{pid}/destroy', 'BillController@paymentDestroy')->name('bill.payment.destroy')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill/{id}/resent', 'BillController@resent')->name('bill.resent')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill/section/type', 'BillController@BillSectionGet')->name('bill.section.type')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill/{id}/debit-note', 'DebitNoteController@create')->name('bill.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill/{id}/debit-note', 'DebitNoteController@store')->name('bill.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bill/{id}/debit-note/edit/{cn_id}', 'DebitNoteController@edit')->name('bill.edit.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bill/{id}/debit-note/edit/{cn_id}', 'DebitNoteController@update')->name('bill.edit.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::delete('bill/{id}/debit-note/delete/{cn_id}', 'DebitNoteController@destroy')->name('bill.delete.debit.note')->middleware(
        [
            'auth',
        ]
    );

    // settig in account
    Route::post('/accountss/setting/store', 'AccountController@setting')->name('accounts.setting.save')->middleware(['auth']);


    // bill template settig in account

    Route::get('/bill/preview/{template}/{color}', ['as' => 'bill.preview','uses' => 'BillController@previewBill',]);

    Route::post('/account/setting/store', 'BillController@saveBillTemplateSettings')->name('bill.template.setting')->middleware(['auth']);

    // Account Report
    Route::get('report/transaction', 'TransactionController@index')->name('transaction.index')->middleware(['auth']);
    Route::get('report/account-statement-report', 'ReportController@accountStatement')->name('report.account.statement')->middleware(['auth']);
    Route::get('report/income-summary', 'ReportController@incomeSummary')->name('report.income.summary')->middleware(['auth']);
    Route::get('report/expense-summary', 'ReportController@expenseSummary')->name('report.expense.summary')->middleware(['auth']);
    Route::get('report/income-vs-expense-summary', 'ReportController@incomeVsExpenseSummary')->name('report.income.vs.expense.summary')->middleware(['auth']);
    Route::get('report/tax-summary', 'ReportController@taxSummary')->name('report.tax.summary')->middleware(['auth']);
    Route::get('report/profit-loss-summary', 'ReportController@profitLossSummary')->name('report.profit.loss.summary')->middleware(['auth']);
    Route::get('report/invoice-summary', 'ReportController@invoiceSummary')->name('report.invoice.summary')->middleware(['auth']);
    Route::get('report/bill-summary', 'ReportController@billSummary')->name('report.bill.summary')->middleware(['auth']);
    Route::get('report/product-stock-report', 'ReportController@productStock')->name('report.product.stock.report')->middleware(['auth']);
    });
    Route::get('/bill/pay/{bill}', ['as' => 'pay.billpay','uses' => 'BillController@paybill']);
    Route::get('bill/pdf/{id}', 'BillController@bill')->name('bill.pdf');
    Route::get('bill/{id}/send', 'BillController@venderBillSend')->name('vendor.bill.send');
    Route::post('bill/{id}/send/mail', 'BillController@venderBillSendMail')->name('vendor.bill.send.mail');












