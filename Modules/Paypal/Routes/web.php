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
use Modules\Paypal\Http\Controllers\PaypalController;

Route::group(['middleware' => 'PlanModuleCheck:Paypal'], function ()
 {
    Route::prefix('paypal')->group(function() {
        Route::post('/setting/store', 'PaypalController@setting')->name('paypal.company.setting');

    });
});
Route::post('plan-pay-with-paypal', 'PaypalController@planPayWithPaypal')->name('plan.pay.with.paypal');
Route::get('plan-get-paypal-status/{plan_id}', 'PaypalController@planGetPaypalStatus')->name('plan.get.paypal.status');
Route::post('/invoice-pay-with-paypal','PaypalController@invoicePayWithPaypal')->name('invoice.pay.with.paypal');
Route::get('/invoice/paypal/{invoice_id}/{amount}/{type}', 'PaypalController@getInvoicePaymentStatus')->name('invoice.paypal');

Route::post('pay-with-paypal/{slug?}', [PaypalController::class, 'coursePayWithPaypal'])->name('course.pay.with.paypal');
Route::get('{id}/get-payment-status{slug?}', [PaypalController::class,'GetCoursePaymentStatus'])->name('course.paypal');

Route::prefix('hotel/{slug}')->group(function() {
    Route::post('pay-with-paypal', 'PaypalController@BookingPayWithPaypal')->name('pay.with.paypal');
    Route::get('{amount}/get-payment-status/{couponid}', 'PaypalController@GetBookingPaymentStatus')->name('booking.get.payment.status');
});

