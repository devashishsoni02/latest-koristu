<?php

use Illuminate\Support\Facades\Route;


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
Route::group(['middleware' => 'PlanModuleCheck:ProductService'], function ()
{
    Route::resource('product-service', 'ProductServiceController')->middleware(['auth']);
    Route::resource('units','UnitController')->middleware(['auth']);
    Route::resource('category', 'CategoryController')->middleware(['auth']);
    Route::resource('tax', 'TaxController')->middleware(['auth']);
    Route::get('product-service-grid', 'ProductServiceController@grid')->name('product-service.grid');
    Route::resource('product-service', 'ProductServiceController')->middleware(['auth']);
    // Product Stock
    Route::resource('productstock', 'ProductStockController')->middleware(['auth']);

    //Product & Service import
    Route::get('product-service/import/export', 'ProductServiceController@fileImportExport')->name('product-service.file.import')->middleware(['auth']);
    Route::post('product-service/import', 'ProductServiceController@fileImport')->name('product-service.import')->middleware(['auth']);
    Route::get('product-service/import/modal', 'ProductServiceController@fileImportModal')->name('product-service.import.modal')->middleware(['auth']);
    Route::post('product-service/data/import/', 'ProductServiceController@productserviceImportdata')->name('product-service.import.data')->middleware(['auth']);
    Route::post('get-taxes', 'ProductServiceController@getTaxes')->name('get.taxes');
    Route::any('product-service/get-item', 'ProductServiceController@GetItem')->name('get.item')->middleware(['auth']);

});


