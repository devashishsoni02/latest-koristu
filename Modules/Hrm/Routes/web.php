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
Route::group(['middleware' => 'PlanModuleCheck:Hrm'], function ()
 {
    Route::prefix('hrm')->group(function() {
        Route::get('/', 'HrmController@index')->middleware(['auth']);
    });
    Route::get('dashboard/hrm',['as' => 'hrm.dashboard','uses' =>'HrmController@index'])->middleware(['auth']);
    Route::resource('document', 'DocumentController')->middleware(
        [
            'auth'
        ]
    );
    Route::resource('document-type', 'DocumentTypeController')->middleware(
        [
            'auth'
        ]
    );
    // Attendance
    Route::resource('attendance', 'AttendanceController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('bulkattendance', 'AttendanceController@BulkAttendance')->name('attendance.bulkattendance')->middleware(
        [
            'auth',
        ]
    );
    Route::post('bulkattendance', 'AttendanceController@BulkAttendanceData')->name('attendance.bulkattendance')->middleware(
        [
            'auth',
        ]
    );
    Route::post('attendance/attendance', 'AttendanceController@attendance')->name('attendance.attendance')->middleware(
        [
            'auth',
        ]
    );

    // Attendance import

    Route::get('attendance/import/export', 'AttendanceController@fileImportExport')->name('attendance.file.import');
    Route::post('attendance/import', 'AttendanceController@fileImport')->name('attendance.import');
    Route::get('attendance/import/modal', 'AttendanceController@fileImportModal')->name('attendance.import.modal');
    Route::post('attendance/data/import/', 'AttendanceController@AttendanceImportdata')->name('attendance.import.data');


    // branch
    Route::resource('branch', 'BranchController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('branchnameedit', 'BranchController@BranchNameEdit')->middleware(
        [
            'auth',
        ]
    )->name('branchname.edit');
    Route::post('branch-settings', 'BranchController@saveBranchName')->middleware(
        [
            'auth',
        ]
    )->name('branchname.update');
    // department
    Route::resource('department', 'DepartmentController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('departmentnameedit', 'DepartmentController@DepartmentNameEdit')->middleware(
        [
            'auth',
        ]
    )->name('departmentname.edit');
    Route::post('department-settings', 'DepartmentController@saveDepartmentName')->middleware(
        [
            'auth',
        ]
    )->name('departmentname.update');
    // designation
    Route::resource('designation', 'DesignationController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('designationnameedit', 'DesignationController@DesignationNameEdit')->middleware(
        [
            'auth',
        ]
    )->name('designationname.edit');
    Route::post('designation-settings', 'DesignationController@saveDesignationName')->middleware(
        [
            'auth',
        ]
    )->name('designationname.update');
    // employee
    Route::resource('employee', 'EmployeeController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('employee-grid', 'EmployeeController@grid')->name('employee.grid')->middleware(
        [
            'auth'
        ]
    );

    Route::post('employee/getdepartment', 'EmployeeController@getDepartment')->name('employee.getdepartment')->middleware(
        [
            'auth',
        ]
    );
    Route::post('employee/getdesignation', 'EmployeeController@getdDesignation')->name('employee.getdesignation')->middleware(
        [
            'auth',
        ]
    );

    //employee import
    Route::get('employee/import/export', 'EmployeeController@fileImportExport')->name('employee.file.import')->middleware(['auth']);
    Route::post('employee/import', 'EmployeeController@fileImport')->name('employee.import')->middleware(['auth']);
    Route::get('employee/import/modal', 'EmployeeController@fileImportModal')->name('employee.import.modal')->middleware(['auth']);
    Route::post('employee/data/import/', 'EmployeeController@employeeImportdata')->name('employee.import.data')->middleware(['auth']);

    // settig in hrm
    Route::post('hrm/setting/store', 'HrmController@setting')->name('hrm.setting.store')->middleware(['auth']);
    Route::resource('company-policy', 'CompanyPolicyController')->middleware(
        [
            'auth',
        ]
    );

    Route::resource('iprestrict', 'IpRestrictController')->middleware(
        [
            'auth',
        ]
    );

    // Leave and Leave type
    Route::resource('leavetype', 'LeaveTypeController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('leave/{id}/action', 'LeaveController@action')->name('leave.action')->middleware(
        [
            'auth',
        ]
    );
    Route::post('leave/changeaction', 'LeaveController@changeaction')->name('leave.changeaction')->middleware(
        [
            'auth',
        ]
    );
    Route::post('leave/jsoncount', 'LeaveController@jsoncount')->name('leave.jsoncount')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('leave', 'LeaveController')->middleware(
        [
            'auth',
        ]
    );

    // award
    Route::resource('awardtype', 'AwardTypeController')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('award', 'AwardController')->middleware(
        [
            'auth',
        ]
    );
    // transfer
    Route::resource('transfer', 'TransferController')->middleware(
        [
            'auth',
        ]
    );

    // Resignation
    Route::resource('resignation', 'ResignationController')->middleware(
        [
            'auth',
        ]
    );

    // Travel || Trip
    Route::resource('trip', 'TravelController')->middleware(
        [
            'auth',
        ]
    );

    // Promotion
    Route::resource('promotion', 'PromotionController')->middleware(
        [
            'auth',
        ]
    );
    //complaint
    Route::resource('complaint', 'ComplaintController')->middleware(
        [
            'auth',
        ]
    );
    //warning
    Route::resource('warning', 'WarningController')->middleware(
        [
            'auth',
        ]
    );
    // Termination and Terminationtype

    Route::resource('terminationtype', 'TerminationTypeController')->middleware(
        [
            'auth',
        ]
    );

    Route::get('termination/{id}/description', 'TerminationController@description')->name('termination.description');

    Route::resource('termination', 'TerminationController')->middleware(
        [
            'auth',
        ]
    );

    // Announcement
    Route::post('announcement/getemployee', 'AnnouncementController@getemployee')->name('announcement.getemployee')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('announcement', 'AnnouncementController')->middleware(
        [
            'auth',
        ]
    );
    // Holiday
    Route::get('holiday/calender', 'HolidayController@calender')->name('holiday.calender')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('holiday', 'HolidayController')->middleware(
        [
            'auth',
        ]
    );

    // Holiday import
     Route::get('holiday/import/export', 'HolidayController@fileImportExport')->name('holiday.file.import')->middleware(['auth']);
     Route::post('holiday/import', 'HolidayController@fileImport')->name('holiday.import')->middleware(['auth']);
     Route::get('holiday/import/modal', 'HolidayController@fileImportModal')->name('holiday.import.modal')->middleware(['auth']);
     Route::post('holiday/data/import/', 'HolidayController@holidayImportdata')->name('holiday.import.data')->middleware(['auth']);

    // Report
    Route::get('report/monthly/attendance', 'ReportController@monthlyAttendance')->name('report.monthly.attendance')->middleware(
        [
            'auth',
        ]
    );
    Route::post('report/getdepartment', 'ReportController@getdepartment')->name('report.getdepartment')->middleware(
        [
            'auth',
        ]
    );
    Route::post('report/getemployee', 'ReportController@getemployee')->name('report.getemployee')->middleware(
        [
            'auth',
        ]
    );
    Route::get('report/leave', 'ReportController@leave')->name('report.leave')->middleware(
        [
            'auth',
        ]
    );
    Route::get('employee/{id}/leave/{status}/{type}/{month}/{year}', 'ReportController@employeeLeave')->name('report.employee.leave')->middleware(
        [
            'auth',
        ]
    );
    Route::get('report/payroll', 'ReportController@Payroll')->name('report.payroll')->middleware(
        [
            'auth',
        ]
    );
    //payslip type
    Route::resource('paysliptype', 'PayslipTypeController')->middleware(
        [
            'auth',
        ]
    );
    //allowance option
    Route::resource('allowanceoption', 'AllowanceOptionController')->middleware(
        [
            'auth',
        ]
    );
    // loan option
    Route::resource('loanoption', 'LoanOptionController')->middleware(
        [
            'auth',
        ]
    );
    //deduction option
    Route::resource('deductionoption', 'DeductionOptionController')->middleware(
        [
            'auth',
        ]
    );
    // Payroll
    Route::resource('setsalary', 'SetSalaryController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('employee/salary/{eid}', 'SetSalaryController@employeeBasicSalary')->name('employee.basic.salary')->middleware(
        [
            'auth',
        ]
    );
    Route::post('employee/update/sallary/{id}', 'SetSalaryController@employeeUpdateSalary')->name('employee.salary.update')->middleware(
        [
            'auth',
        ]
    );
    // Allowance
    Route::resource('allowance', 'AllowanceController')->middleware(
        [
            'auth',
        ]
    );
    Route::get('allowances/create/{eid}', 'AllowanceController@allowanceCreate')->name('allowances.create')->middleware(
        [
            'auth',
        ]
    );
    // commissions
    Route::get('commissions/create/{eid}', 'CommissionController@commissionCreate')->name('commissions.create')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('commission', 'CommissionController')->middleware(
        [
            'auth',
        ]
    );
    // loan
    Route::get('loans/create/{eid}', 'LoanController@loanCreate')->name('loans.create')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('loan', 'LoanController')->middleware(
        [
            'auth',
        ]
    );
    // saturationdeduction
    Route::get('saturationdeductions/create/{eid}', 'SaturationDeductionController@saturationdeductionCreate')->name('saturationdeductions.create')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('saturationdeduction', 'SaturationDeductionController')->middleware(
        [
            'auth',
        ]
    );
    // otherpayment
    Route::get('otherpayments/create/{eid}', 'OtherPaymentController@otherpaymentCreate')->name('otherpayments.create')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('otherpayment', 'OtherPaymentController')->middleware(
        [
            'auth',
        ]
    );
    // overtime
    Route::get('overtimes/create/{eid}', 'OvertimeController@overtimeCreate')->name('overtimes.create')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('overtime', 'OvertimeController')->middleware(
        [
            'auth',
        ]
    );
    // Payslip
    Route::resource('payslip', 'PaySlipController')->middleware(
        [
            'auth',
        ]
    );
    Route::post('payslip/search_json', 'PaySlipController@search_json')->name('payslip.search_json')->middleware(
        [
            'auth',
        ]
    );
    Route::get('payslip/delete/{id}', 'PaySlipController@destroy')->name('payslip.delete')->middleware(
        [
            'auth',
        ]
    );
    Route::get('payslip/pdf/{id}/{m}', 'PaySlipController@pdf')->name('payslip.pdf')->middleware(
        [
            'auth',
        ]
    );
    Route::get('payslip/payslipPdf/{id}', 'PaySlipController@payslipPdf')->name('payslip.payslipPdf')->middleware(
        [
            'auth',
        ]
    );
    Route::get('payslip/paysalary/{id}/{date}', 'PaySlipController@paysalary')->name('payslip.paysalary')->middleware(
        [
            'auth',
        ]
    );
    Route::get('payslip/send/{id}/{m}', 'PaySlipController@send')->name('payslip.send')->middleware(
        [
            'auth',
        ]
    );
    Route::get('payslip/editemployee/{id}', 'PaySlipController@editemployee')->name('payslip.editemployee')->middleware(
        [
            'auth',
        ]
    );

    Route::post('payslip/editemployee/{id}', 'PaySlipController@updateEmployee')->name('payslip.updateemployee')->middleware(
        [
            'auth',
        ]
    );

    //Event
    Route::get('event/data/{id}', 'EventController@showData')->name('eventsshow');
    Route::post('event/getdepartment', 'EventController@getdepartment')->name('event.getdepartment')->middleware(
        [
            'auth',
        ]
    );
    Route::post('event/getemployee', 'EventController@getemployee')->name('event.getemployee')->middleware(
        [
            'auth',
        ]
    );
    Route::resource('event', 'EventController')->middleware(
        [
            'auth',
        ]
    );
    // //joining Letter
    Route::post('setting/joiningletter/{lang?}', 'HrmController@joiningletterupdate')->name('joiningletter.update');
    Route::get('employee/pdf/{id}', 'EmployeeController@joiningletterPdf')->name('joiningletter.download.pdf');
    Route::get('employee/doc/{id}', 'EmployeeController@joiningletterDoc')->name('joininglatter.download.doc');

    // //Experience Certificate
    Route::post('setting/exp/{lang?}', 'HrmController@experienceCertificateupdate')->name('experiencecertificate.update');
    Route::get('employee/exppdf/{id}', 'EmployeeController@ExpCertificatePdf')->name('exp.download.pdf');
    Route::get('employee/expdoc/{id}', 'EmployeeController@ExpCertificateDoc')->name('exp.download.doc');

    // //NOC
    Route::post('setting/noc/{lang?}', 'HrmController@NOCupdate')->name('noc.update');
    Route::get('employee/nocpdf/{id}', 'EmployeeController@NocPdf')->name('noc.download.pdf');
    Route::get('employee/nocdoc/{id}', 'EmployeeController@NocDoc')->name('noc.download.doc');

});

