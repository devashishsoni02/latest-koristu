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


Route::group(['middleware' => 'PlanModuleCheck:Taskly'], function ()
{
    Route::get('dashboard/taskly',['as' => 'taskly.dashboard','uses' =>'DashboardController@index'])->middleware(['auth']);

    Route::get('/project/copy/{id}',['as' => 'project.copy','uses' =>'ProjectController@copyproject'])->middleware(['auth']);
    Route::post('/project/copy/store/{id}',['as' => 'project.copy.store','uses' =>'ProjectController@copyprojectstore'])->middleware(['auth']);

    Route::resource('projects', 'ProjectController')->middleware(['auth']);
    Route::resource('stages', 'StageController')->middleware(['auth']);
    Route::get('projects-list', 'ProjectController@List')->name('projects.list')->middleware(['auth']);
    //project import
    Route::get('project/import/export', 'ProjectController@fileImportExport')->name('project.file.import')->middleware(['auth']);
    Route::post('project/import', 'ProjectController@fileImport')->name('project.import')->middleware(['auth']);
    Route::get('project/import/modal', 'ProjectController@fileImportModal')->name('project.import.modal')->middleware(['auth']);
    Route::post('project/data/import/', 'ProjectController@projectImportdata')->name('project.import.data')->middleware(['auth']);
    //project Setting
    Route::get('project/setting/{id}', 'ProjectController@CopylinkSetting')->name('project.setting')->middleware(['auth']);
    Route::post('project/setting/save{id}', 'ProjectController@CopylinkSettingSave')->name('project.setting.save')->middleware(['auth']);

    Route::post('send-mail', 'ProjectController@sendMail')->name('send.mail')->middleware(['auth']);
    // Task Board
    Route::get('projects/{id}/task-board',['as' => 'projects.task.board','uses' =>'ProjectController@taskBoard'])->middleware(['auth']);
    Route::get('projects/{id}/task-board/create',['as' => 'tasks.create','uses' =>'ProjectController@taskCreate'])->middleware(['auth']);
    Route::post('projects/{id}/task-board',['as' => 'tasks.store','uses' =>'ProjectController@taskStore'])->middleware(['auth']);
    Route::post('projects/{id}/task-board/order-update',['as' => 'tasks.update.order','uses' =>'ProjectController@taskOrderUpdate'])->middleware(['auth']);
    Route::get('projects/{id}/task-board/edit/{tid}',['as' => 'tasks.edit','uses' =>'ProjectController@taskEdit'])->middleware(['auth']);
    Route::post('projects/{id}/task-board/{tid}/update',['as' => 'tasks.update','uses' =>'ProjectController@taskUpdate'])->middleware(['auth']);
    Route::delete('projects/{id}/task-board/{tid}',['as' => 'tasks.destroy','uses' =>'ProjectController@taskDestroy'])->middleware(['auth']);
    Route::get('projects/{id}/task-board/{tid}/{cid?}',['as' => 'tasks.show','uses' =>'ProjectController@taskShow'])->middleware(['auth']);
    Route::get('projects/{id}/task-board-list', 'ProjectController@TaskList')->name('projecttask.list')->middleware(['auth']);

    // Gantt Chart
    Route::get('projects/{id}/gantt/{duration?}',['as' => 'projects.gantt','uses' =>'ProjectController@gantt'])->middleware(['auth']);
    Route::post('projects/{id}/gantt',['as' => 'projects.gantt.post','uses' =>'ProjectController@ganttPost'])->middleware(['auth']);


    // bug report
    Route::get('projects/{id}/bug_report',['as' => 'projects.bug.report','uses' =>'ProjectController@bugReport'])->middleware(['auth']);
    Route::get('projects/{id}/bug_report/create',['as' => 'projects.bug.report.create','uses' =>'ProjectController@bugReportCreate'])->middleware(['auth']);
    Route::post('projects/{id}/bug_report',['as' => 'projects.bug.report.store','uses' =>'ProjectController@bugReportStore'])->middleware(['auth']);
    Route::post('projects/{id}/bug_report/order-update',['as' => 'projects.bug.report.update.order','uses' =>'ProjectController@bugReportOrderUpdate'])->middleware(['auth']);
    Route::get('projects/{id}/bug_report/{bid}/show',['as' => 'projects.bug.report.show','uses' =>'ProjectController@bugReportShow'])->middleware(['auth']);
    Route::get('projects/{id}/bug_report/{bid}/edit',['as' => 'projects.bug.report.edit','uses' =>'ProjectController@bugReportEdit'])->middleware(['auth']);
    Route::post('projects/{id}/bug_report/{bid}/update',['as' => 'projects.bug.report.update','uses' =>'ProjectController@bugReportUpdate'])->middleware(['auth']);
    Route::delete('projects/{id}/bug_report/{bid}',['as' => 'projects.bug.report.destroy','uses' =>'ProjectController@bugReportDestroy'])->middleware(['auth']);
    Route::get('projects/{id}/bug_report-list', 'ProjectController@BugList')->name('projectbug.list')->middleware(['auth']);


    Route::get('projects/invite/{id}',['as' => 'projects.invite.popup','uses' =>'ProjectController@popup'])->middleware(['auth']);
    Route::get('projects/share/{id}',['as' => 'projects.share.popup','uses' =>'ProjectController@sharePopup'])->middleware(['auth']);
    Route::get('projects/share/vender/{id}',['as' => 'projects.share.vender.popup','uses' =>'ProjectController@sharePopupVender'])->middleware(['auth']);
    Route::post('projects/share/vender/store/{id}',['as' => 'projects.share.vender','uses' =>'ProjectController@sharePopupVenderStore'])->middleware(['auth']);
    Route::get('projects/milestone/{id}',['as' => 'projects.milestone','uses' =>'ProjectController@milestone'])->middleware(['auth']);
    Route::post('projects/{id}/file',['as' => 'projects.file.upload','uses' =>'ProjectController@fileUpload'])->middleware(['auth']);
    Route::post('projects/share/{id}',['as' => 'projects.share','uses' =>'ProjectController@share'])->middleware(['auth']);


    // stages.index
    // project
    Route::get('projects/milestone/{id}',['as' => 'projects.milestone','uses' =>'ProjectController@milestone'])->middleware();
    Route::post('projects/milestone/{id}/store',['as' => 'projects.milestone.store','uses' =>'ProjectController@milestoneStore'])->middleware();
    Route::get('projects/milestone/{id}/show',['as' => 'projects.milestone.show','uses' =>'ProjectController@milestoneShow'])->middleware(['auth']);
    Route::get('projects/milestone/{id}/edit',['as' => 'projects.milestone.edit','uses' =>'ProjectController@milestoneEdit'])->middleware(['auth']);
    Route::post('projects/milestone/{id}/update',['as' => 'projects.milestone.update','uses' =>'ProjectController@milestoneUpdate'])->middleware(['auth']);
    Route::delete('projects/milestone/{id}',['as' => 'projects.milestone.destroy','uses' =>'ProjectController@milestoneDestroy'])->middleware(['auth']);
    Route::delete('projects/{id}/file/delete/{fid}',['as' => 'projects.file.delete','uses' =>'ProjectController@fileDelete'])->middleware(['auth']);


    Route::post('projects/invite/{id}/update',['as' => 'projects.invite.update','uses' =>'ProjectController@invite'])->middleware(['auth']);

    Route::resource('bugstages', 'BugStageController')->middleware(['auth']);

    Route::post('projects/{id}/comment/{tid}/file/{cid?}',['as' => 'comment.store.file','uses' =>'ProjectController@commentStoreFile']);
    Route::delete('projects/{id}/comment/{tid}/file/{fid}',['as' => 'comment.destroy.file','uses' =>'ProjectController@commentDestroyFile']);
    Route::post('projects/{id}/comment/{tid}/{cid?}',['as' => 'comment.store','uses' =>'ProjectController@commentStore']);
    Route::delete('projects/{id}/comment/{tid}/{cid}',['as' => 'comment.destroy','uses' =>'ProjectController@commentDestroy']);
    Route::post('projects/{id}/sub-task/update/{stid}',['as' => 'subtask.update','uses' =>'ProjectController@subTaskUpdate']);
    Route::post('projects/{id}/sub-task/{tid}/{cid?}',['as' => 'subtask.store','uses' =>'ProjectController@subTaskStore']);
    Route::delete('projects/{id}/sub-task/{stid}',['as' => 'subtask.destroy','uses' =>'ProjectController@subTaskDestroy']);

    Route::post('projects/{id}/bug_comment/{tid}/file/{cid?}',['as' => 'bug.comment.store.file','uses' =>'ProjectController@bugStoreFile']);
    Route::delete('projects/{id}/bug_comment/{tid}/file/{fid}',['as' => 'bug.comment.destroy.file','uses' =>'ProjectController@bugDestroyFile']);
    Route::post('projects/{id}/bug_comment/{tid}/{cid?}',['as' => 'bug.comment.store','uses' =>'ProjectController@bugCommentStore']);
    Route::delete('projects/{id}/bug_comment/{tid}/{cid}',['as' => 'bug.comment.destroy','uses' =>'ProjectController@bugCommentDestroy']);
    Route::delete('projects/{id}/client/{uid}',['as' => 'projects.client.delete','uses' =>'ProjectController@clientDelete'])->middleware(['auth']);
    Route::delete('projects/{id}/user/{uid}',['as' => 'projects.user.delete','uses' =>'ProjectController@userDelete'])->middleware(['auth']);
    Route::delete('projects/{id}/vendor/{uid}',['as' => 'projects.vendor.delete','uses' =>'ProjectController@vendorDelete'])->middleware(['auth']);

// Project Report
    Route::resource('project_report','ProjectReportController')->middleware(['auth']);
    Route::post('project_report_data','ProjectReportController@ajax_data')->name('projects.ajax')->middleware(['auth']);
    Route::post('project_report/tasks/{id}',['as' => 'tasks.report.ajaxdata','uses' =>'ProjectReportController@ajax_tasks_report'])->middleware(['auth']);
});
Route::get('projects/{id}/file/{fid}',['as' => 'projects.file.download','uses' =>'ProjectController@fileDownload']);

Route::post('project/password/check/{id}/{lang?}', 'ProjectController@PasswordCheck')->name('project.password.check');
Route::get('project/shared/link/{id}/{lang?}', 'ProjectController@ProjectSharedLink')->name('project.shared.link');
Route::get('projects/{id}/link/task/show/{tid}/',['as' => 'Project.link.task.show','uses' =>'ProjectController@ProjectLinkTaskShow']);
Route::get('projects/{id}/link/bug_report/{bid}/show',['as' => 'projects.link.bug.report.show','uses' =>'ProjectController@ProjectLinkbugReportShow']);
