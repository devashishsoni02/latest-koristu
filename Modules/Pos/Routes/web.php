<?php

use Illuminate\Support\Facades\Route;
use Modules\Pos\Http\Controllers\PurchaseController;
use Modules\Pos\Http\Controllers\WarehouseTransferController;
use Modules\Pos\Http\Controllers\ReportController;

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

//dashboard


Route::group(['middleware' => 'PlanModuleCheck:Pos'], function ()
{
    Route::get('dashboard/pos',['as' => 'pos.dashboard','uses' =>'PosController@dashboard'])->middleware(['auth']);

    //warehouse
    Route::resource('warehouse', 'WarehouseController')->middleware(
        [
            'auth',
        ]
    );

     //warehouse import
     Route::get('warehouse/import/export', 'WarehouseController@fileImportExport')->name('warehouse.file.import')->middleware(['auth']);
     Route::post('warehouse/import', 'WarehouseController@fileImport')->name('warehouse.import')->middleware(['auth']);
     Route::get('warehouse/import/modal', 'WarehouseController@fileImportModal')->name('warehouse.import.modal')->middleware(['auth']);
     Route::post('warehouse/data/import/', 'WarehouseController@warehouseImportdata')->name('warehouse.import.data')->middleware(['auth']);

    Route::get('productservice/{id}/detail', 'WarehouseController@warehouseDetail')->name('productservice.detail');

    Route::post('pos/setting/store', 'PosController@setting')->name('pos.setting.store')->middleware(['auth']);

    //purchase
    Route::resource('purchase', 'PurchaseController');
    Route::post('purchase/items', 'PurchaseController@items')->name('purchase.items');
    Route::get('purchase/{id}/payment', 'PurchaseController@payment')->name('purchase.payment');
    Route::post('purchase/{id}/payment', 'PurchaseController@createPayment')->name('purchase.payment');
    Route::post('purchase/{id}/payment/{pid}/destroy', 'PurchaseController@paymentDestroy')->name('purchase.payment.destroy');

    Route::post('purchase/product/destroy', 'PurchaseController@productDestroy')->name('purchase.product.destroy');
    Route::post('purchase/vender', 'PurchaseController@vender')->name('purchase.vender');
    Route::post('purchase/product', 'PurchaseController@product')->name('purchase.product');
    Route::get('purchase/create/{cid}', 'PurchaseController@create')->name('purchase.create');
    Route::get('purchase/{id}/sent', 'PurchaseController@sent')->name('purchase.sent');
    Route::get('purchase/{id}/resent', 'PurchaseController@resent')->name('purchase.resent');
    Route::get(
        'purchase/preview/{template}/{color}', [
            'as' => 'purchase.preview',
            'uses' => 'PurchaseController@previewPurchase',
    ])->middleware(['auth']);

    Route::post(
        '/purchase/template/setting', [
            'as' => 'purchase.template.setting',
            'uses' => 'PurchaseController@savePurchaseTemplateSettings',
        ]
    );

    Route::get('purchase/{id}/debit-note', 'PurchaseDebitNoteController@create')->name('purchase.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::post('purchase/{id}/debit-note', 'PurchaseDebitNoteController@store')->name('purchase.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::get('purchase/{id}/debit-note/edit/{cn_id}', 'PurchaseDebitNoteController@edit')->name('purchase.edit.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::post('purchase/{id}/debit-note/edit/{cn_id}', 'PurchaseDebitNoteController@update')->name('purchase.edit.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::delete('purchase/{id}/debit-note/delete/{cn_id}', 'PurchaseDebitNoteController@destroy')->name('purchase.delete.debit.note')->middleware(
        [
            'auth',
        ]
    );
    Route::post('purchase/{id}/file',['as' => 'purchases.file.upload','uses' =>'PurchaseController@fileUpload'])->middleware(['auth']);
    Route::delete("purchase/{id}/destroy", 'PurchaseController@fileUploadDestroy')->name("purchase.attachment.destroy")->middleware(['auth']);

    Route::get('pos-print-setting', 'PurchaseController@posPrintIndex')->name('pos.print.setting')->middleware('auth');
    Route::post(
        '/purchase/template/setting', [
            'as' => 'purchase.template.setting',
            'uses' => 'PurchaseController@savePurchaseTemplateSettings',
        ]
    );
    Route::resource('pos', 'PosController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('pos-grid', 'PosController@grid')->name('pos.grid');
    Route::get('report/pos', 'PosController@report')->name('pos.report')->middleware(['auth']);
    Route::get('search-products', 'PosController@searchProducts')->name('search.products')->middleware(['auth']);
    Route::get('name-search-products', 'PosController@searchProductsByName')->name('name.search.products')->middleware(['auth']);
    Route::post('warehouse-empty-cart', 'PosController@warehouseemptyCart')->name('warehouse-empty-cart')->middleware(['auth']);
    Route::get('product-categories', 'PosController@getProductCategories')->name('product.categories')->middleware(['auth']);
    Route::post('empty-cart', 'PosController@emptyCart')->middleware(['auth']);
    Route::get('add-to-cart/{id}/{session}', 'PosController@addToCart')->middleware(['auth']);
    Route::delete('remove-from-cart', 'PosController@removeFromCart')->middleware(['auth']);
    Route::patch('update-cart', 'PosController@updateCart')->middleware(['auth']);

    Route::get('pos/data/store', 'PosController@store')->name('pos.data.store')->middleware(['auth',]);

    // thermal print

    Route::get('printview/pos', 'PosController@printView')->name('pos.printview')->middleware(['auth',]);

    Route::post('/cartdiscount', 'PosController@cartdiscount')->name('cartdiscount')->middleware(['auth']);

    Route::get('pos/pdf/{id}', 'PosController@pos')->name('pos.pdf')->middleware(['auth']);
    Route::post('/pos/template/setting', 'PosController@savePosTemplateSettings')->name('pos.template.setting');
    Route::get('pos/preview/{template}/{color}', 'PosController@previewPos')->name('pos.preview')->middleware(['auth']);

    Route::get('purchase-grid', 'PurchaseController@grid')->name('purchase.grid');


    //warehouse-transfer
    Route::resource('warehouse-transfer', 'WarehouseTransferController')->middleware(['auth']);
    Route::post('warehouse-transfer/getproduct', [WarehouseTransferController::class, 'getproduct'])->name('warehouse-transfer.getproduct')->middleware(['auth']);
    Route::post('warehouse-transfer/getquantity', [WarehouseTransferController::class, 'getquantity'])->name('warehouse-transfer.getquantity')->middleware(['auth']);


    //Reports
    Route::get('reports-warehouse', [ReportController::class, 'warehouseReport'])->name('report.warehouse')->middleware(['auth']);
    Route::get('reports-daily-purchase', [ReportController::class, 'purchaseDailyReport'])->name('report.daily.purchase')->middleware(['auth']);
    Route::get('reports-monthly-purchase', [ReportController::class, 'purchaseMonthlyReport'])->name('report.monthly.purchase')->middleware(['auth']);
    Route::get('reports-daily-pos', [ReportController::class, 'posDailyReport'])->name('report.daily.pos')->middleware(['auth']);
    Route::get('reports-monthly-pos', [ReportController::class, 'posMonthlyReport'])->name('report.monthly.pos')->middleware(['auth']);
    Route::get('reports-pos-vs-purchase', [ReportController::class, 'posVsPurchaseReport'])->name('report.pos.vs.purchase')->middleware(['auth']);




});
Route::get('/vendor/purchase/{id}/', 'PurchaseController@purchaseLink')->name('purchase.link.copy');
Route::get('/vend0r/bill/{id}/', [PurchaseController::class, 'invoiceLink'])->name('bill.link.copy')->middleware(['auth']);
Route::get('purchase/pdf/{id}', 'PurchaseController@purchase')->name('purchase.pdf');

