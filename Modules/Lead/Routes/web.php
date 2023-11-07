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
Route::group(['middleware' => 'PlanModuleCheck:Lead'], function ()
{

    Route::resource('leads', 'LeadController')->middleware(['auth']);
    Route::get('dashboard/crm',['as' => 'lead.dashboard','uses' =>'LeadController@dashboard'])->middleware(['auth']);
    Route::resource('pipelines', 'PipelineController')->middleware(['auth']);
    Route::post('/deals/change-pipeline',['as' => 'deals.change.pipeline','uses' =>'DealController@changePipeline'])->middleware(['auth']);
    Route::get('/leads-list', ['as' => 'leads.list','uses' => 'LeadController@lead_list',])->middleware(['auth']);
    Route::resource('lead-stages', 'LeadStageController')->middleware(['auth']);
    Route::post('/lead_stages/order', ['as' => 'lead_stages.order','uses' => 'LeadStageController@order',]);
    Route::resource('deal-stages', 'DealStageController');
    Route::post('/deal_stages/order',['as' => 'deal-stages.order','uses' =>'DealStageController@order']);

    Route::resource('labels', 'LabelController');
    Route::resource('sources', 'SourceController');
    Route::get('/leads-deals/dashboard', ['as' => 'leads.dashboard','uses' => 'LeadController@dashboard',])->middleware(['auth']);
    Route::post('/leads/order', ['as' => 'leads.order','uses' => 'LeadController@order',])->middleware(['auth']);
    Route::post('/leads/json', ['as' => 'leads.json','uses' => 'LeadController@json',])->middleware(['auth']);;
    Route::post('/leads/{id}/file', ['as' => 'leads.file.upload','uses' => 'LeadController@fileUpload',])->middleware(['auth']);
    Route::get('/leads/{id}/file/{fid}', ['as' => 'leads.file.download','uses' => 'LeadController@fileDownload',])->middleware(['auth']);
    Route::delete('/leads/{id}/file/delete/{fid}', ['as' => 'leads.file.delete','uses' => 'LeadController@fileDelete',])->middleware(['auth']);
    Route::post('/leads/{id}/note', ['as' => 'leads.note.store','uses' => 'LeadController@noteStore',])->middleware(['auth']);
    Route::get('/leads/{id}/labels', ['as' => 'leads.labels','uses' => 'LeadController@labels',])->middleware(['auth']);
    Route::post('/leads/{id}/labels', ['as' => 'leads.labels.store','uses' => 'LeadController@labelStore',])->middleware(['auth']);
    Route::get('/leads/{id}/users', ['as' => 'leads.users.edit','uses' => 'LeadController@userEdit',])->middleware(['auth']);
    Route::put('/leads/{id}/users', ['as' => 'leads.users.update','uses' => 'LeadController@userUpdate',])->middleware(['auth']);
    Route::delete('/leads/{id}/users/{uid}', ['as' => 'leads.users.destroy','uses' => 'LeadController@userDestroy',])->middleware(['auth']);
    Route::get('/leads/{id}/products', ['as' => 'leads.products.edit','uses' => 'LeadController@productEdit',])->middleware(['auth']);
    Route::put('/leads/{id}/products', ['as' => 'leads.products.update','uses' => 'LeadController@productUpdate',])->middleware(['auth']);
    Route::delete('/leads/{id}/products/{uid}', ['as' => 'leads.products.destroy','uses' => 'LeadController@productDestroy',])->middleware(['auth']);
    Route::get('/leads/{id}/sources', ['as' => 'leads.sources.edit','uses' => 'LeadController@sourceEdit',])->middleware(['auth']);
    Route::put('/leads/{id}/sources', ['as' => 'leads.sources.update','uses' => 'LeadController@sourceUpdate',])->middleware(['auth']);
    Route::delete('/leads/{id}/sources/{uid}', ['as' => 'leads.sources.destroy','uses' => 'LeadController@sourceDestroy',])->middleware(['auth']);
    Route::get('/leads/{id}/discussions', ['as' => 'leads.discussions.create','uses' => 'LeadController@discussionCreate',])->middleware(['auth']);
    Route::post('/leads/{id}/discussions', ['as' => 'leads.discussion.store','uses' => 'LeadController@discussionStore',])->middleware(['auth']);
    Route::get('/leads/{id}/show_convert', ['as' => 'leads.convert.deal','uses' => 'LeadController@showConvertToDeal',])->middleware(['auth']);
    Route::post('/leads/{id}/convert', ['as' => 'leads.convert.to.deal','uses' => 'LeadController@convertToDeal',])->middleware(['auth']);


    Route::get('/leads/{id}/call', ['as' => 'leads.calls.create','uses' => 'LeadController@callCreate',])->middleware(['auth']);
    Route::post('/leads/{id}/call', ['as' => 'leads.calls.store','uses' => 'LeadController@callStore',])->middleware(['auth']);
    Route::get('/leads/{id}/call/{cid}/edit', ['as' => 'leads.calls.edit','uses' => 'LeadController@callEdit',])->middleware(['auth']);
    Route::put('/leads/{id}/call/{cid}', ['as' => 'leads.calls.update','uses' => 'LeadController@callUpdate',])->middleware(['auth']);
    Route::delete('/leads/{id}/call/{cid}', ['as' => 'leads.calls.destroy','uses' => 'LeadController@callDestroy',])->middleware(['auth']);


    // Lead Email
    Route::get('/leads/{id}/email', ['as' => 'leads.emails.create','uses' => 'LeadController@emailCreate',])->middleware(['auth']);
    Route::post('/leads/{id}/email', ['as' => 'leads.emails.store','uses' => 'LeadController@emailStore',])->middleware(['auth']);


    //Lead import
    Route::get('lead/import/export', 'LeadController@fileImportExport')->name('lead.file.import')->middleware(['auth']);
    Route::post('lead/import', 'LeadController@fileImport')->name('lead.import')->middleware(['auth']);
    Route::get('lead/import/modal', 'LeadController@fileImportModal')->name('lead.import.modal')->middleware(['auth']);
    Route::post('lead/data/import/', 'LeadController@leadImportdata')->name('lead.import.data')->middleware(['auth']);

    // Lead Task
    Route::get('/leads/{id}/task',['as' => 'leads.tasks.create','uses' =>'LeadController@taskCreate'])->middleware(['auth']);
    Route::post('/leads/{id}/task',['as' => 'leads.tasks.store','uses' =>'LeadController@taskStore'])->middleware(['auth']);
    Route::get('/leads/{id}/task/{tid}/edit',['as' => 'leads.tasks.edit','uses' =>'LeadController@taskEdit'])->middleware(['auth']);
    Route::put('/leads/{id}/task/{tid}',['as' => 'leads.tasks.update','uses' =>'LeadController@taskUpdate'])->middleware(['auth']);
    Route::put('/leads/{id}/task_status/{tid}',['as' => 'leads.tasks.update.status','uses' =>'LeadController@taskUpdateStatus'])->middleware(['auth']);
    Route::delete('/leads/{id}/task/{tid}',['as' => 'leads.tasks.destroy','uses' =>'LeadController@taskDestroy'])->middleware(['auth']);

    // Deal Module
    Route::post('/deals/user',['as' => 'deal.user.json','uses' =>'DealController@jsonUser']);
    Route::post('/deals/order',['as' => 'deals.order','uses' =>'DealController@order'])->middleware(['auth']);
    Route::post('/deals/change-pipeline',['as' => 'deals.change.pipeline','uses' =>'DealController@changePipeline'])->middleware(['auth']);
    Route::post('/deals/change-deal-status/{id}', ['as' => 'deals.change.status','uses' => 'DealController@changeStatus',])->middleware(['auth']);
    Route::get('/deals/{id}/labels',['as' => 'deals.labels','uses' =>'DealController@labels'])->middleware(['auth']);
    Route::post('/deals/{id}/labels',['as' => 'deals.labels.store','uses' =>'DealController@labelStore'])->middleware(['auth']);
    Route::get('/deals/{id}/users',['as' => 'deals.users.edit','uses' =>'DealController@userEdit'])->middleware(['auth']);
    Route::put('/deals/{id}/users',['as' => 'deals.users.update','uses' =>'DealController@userUpdate'])->middleware(['auth']);
    Route::delete('/deals/{id}/users/{uid}',['as' => 'deals.users.destroy','uses' =>'DealController@userDestroy'])->middleware(['auth']);
    Route::get('/deals/{id}/clients',['as' => 'deals.clients.edit','uses' =>'DealController@clientEdit'])->middleware(['auth']);
    Route::put('/deals/{id}/clients',['as' => 'deals.clients.update','uses' =>'DealController@clientUpdate'])->middleware(['auth']);
    Route::delete('/deals/{id}/clients/{uid}',['as' => 'deals.clients.destroy','uses' =>'DealController@clientDestroy'])->middleware(['auth']);
    Route::get('/deals/{id}/products',['as' => 'deals.products.edit','uses' =>'DealController@productEdit'])->middleware(['auth']);
    Route::put('/deals/{id}/products',['as' => 'deals.products.update','uses' =>'DealController@productUpdate'])->middleware(['auth']);
    Route::delete('/deals/{id}/products/{uid}',['as' => 'deals.products.destroy','uses' =>'DealController@productDestroy'])->middleware(['auth']);
    Route::get('/deals/{id}/sources',['as' => 'deals.sources.edit','uses' =>'DealController@sourceEdit'])->middleware(['auth']);
    Route::put('/deals/{id}/sources',['as' => 'deals.sources.update','uses' =>'DealController@sourceUpdate'])->middleware(['auth']);
    Route::delete('/deals/{id}/sources/{uid}',['as' => 'deals.sources.destroy','uses' =>'DealController@sourceDestroy'])->middleware(['auth']);
    Route::post('/deals/{id}/file',['as' => 'deals.file.upload','uses' =>'DealController@fileUpload'])->middleware(['auth']);
    Route::get('/deals/{id}/file/{fid}',['as' => 'deals.file.download','uses' =>'DealController@fileDownload'])->middleware(['auth']);
    Route::delete('/deals/{id}/file/delete/{fid}',['as' => 'deals.file.delete','uses' =>'DealController@fileDelete'])->middleware(['auth']);
    Route::post('/deals/{id}/note',['as' => 'deals.note.store','uses' =>'DealController@noteStore'])->middleware(['auth']);
    Route::get('/deals/{id}/task',['as' => 'deals.tasks.create','uses' =>'DealController@taskCreate'])->middleware(['auth']);
    Route::post('/deals/{id}/task',['as' => 'deals.tasks.store','uses' =>'DealController@taskStore'])->middleware(['auth']);
    Route::get('/deals/{id}/task/{tid}/show',['as' => 'deals.tasks.show','uses' =>'DealController@taskShow'])->middleware(['auth']);
    Route::get('/deals/{id}/task/{tid}/edit',['as' => 'deals.tasks.edit','uses' =>'DealController@taskEdit'])->middleware(['auth']);
    Route::put('/deals/{id}/task/{tid}',['as' => 'deals.tasks.update','uses' =>'DealController@taskUpdate'])->middleware(['auth']);
    Route::put('/deals/{id}/task_status/{tid}',['as' => 'deals.tasks.update_status','uses' =>'DealController@taskUpdateStatus'])->middleware(['auth']);
    Route::delete('/deals/{id}/task/{tid}',['as' => 'deals.tasks.destroy','uses' =>'DealController@taskDestroy'])->middleware(['auth']);
    Route::get('/deals/{id}/discussions',['as' => 'deals.discussions.create','uses' =>'DealController@discussionCreate'])->middleware(['auth']);
    Route::post('/deals/{id}/discussions',['as' => 'deals.discussion.store','uses' =>'DealController@discussionStore'])->middleware(['auth']);
    Route::get('/deals/{id}/permission/{cid}',['as' => 'deals.client.permission','uses' =>'DealController@permission'])->middleware(['auth']);
    Route::put('/deals/{id}/permission/{cid}',['as' => 'deals.client.permissions.store','uses' =>'DealController@permissionStore'])->middleware(['auth']);
    Route::get('/deals/list', ['as' => 'deals.list','uses' => 'DealController@deal_list',])->middleware(['auth']);

    // Deal Calls
    Route::get('/deals/{id}/call', ['as' => 'deals.calls.create','uses' => 'DealController@callCreate',])->middleware(['auth']);
    Route::post('/deals/{id}/call', ['as' => 'deals.calls.store','uses' => 'DealController@callStore',])->middleware(['auth']);
    Route::get('/deals/{id}/call/{cid}/edit', ['as' => 'deals.calls.edit','uses' => 'DealController@callEdit',])->middleware(['auth']);
    Route::put('/deals/{id}/call/{cid}', ['as' => 'deals.calls.update','uses' => 'DealController@callUpdate',])->middleware(['auth']);
    Route::delete('/deals/{id}/call/{cid}', ['as' => 'deals.calls.destroy','uses' => 'DealController@callDestroy',])->middleware(['auth']);

    // Deal Email
    Route::get('/deals/{id}/email', ['as' => 'deals.emails.create','uses' => 'DealController@emailCreate',])->middleware(['auth']);
    Route::post('/deals/{id}/email', ['as' => 'deals.emails.store','uses' => 'DealController@emailStore',])->middleware(['auth']);
    Route::resource('deals', 'DealController')->middleware(['auth']);
    // end Deal Module

    Route::post('/stages/json',['as' => 'stages.json','uses' =>'DealStageController@json']);

    //Deal import
    Route::get('deal/import/export', 'DealController@fileImportExport')->name('deal.file.import')->middleware(['auth']);
    Route::post('deal/import', 'DealController@fileImport')->name('deal.import')->middleware(['auth']);
    Route::get('deal/import/modal', 'DealController@fileImportModal')->name('deal.import.modal')->middleware(['auth']);
    Route::post('deal/data/import/', 'DealController@dealImportdata')->name('deal.import.data')->middleware(['auth']);

    // Reports

    Route::get('lead-report', 'ReportController@leadReport')->name('report.lead')->middleware(['auth']);
    Route::get('deal-report', 'ReportController@dealReport')->name('report.deal')->middleware(['auth']);

});
