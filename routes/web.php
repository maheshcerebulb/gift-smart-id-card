<?php


use App\Http\Controllers\DepartmentController;

use App\Http\Controllers\LiqourController;

use App\Http\Controllers\SpecialCategoryEntityController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\RoleController;

use App\Http\Controllers\PermissionController;

use App\Http\Controllers\CompanyController;

use App\Http\Controllers\CommonController;

use App\Http\Controllers\EntityController;

use App\Http\Controllers\Auth\LoginController;



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
Route::get('/123', [CommonController::class, 'common']);

Route::get('/', [LoginController::class, 'showLoginForm']);

Route::post('/login', [LoginController::class, 'login'])->name('login');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::controller(RoleController::class)->prefix('role')->group(function () {

        Route::get('/', 'index')->name('role.index');//->middleware('permission:view.role');

        Route::get('create', 'create')->name('role.create');//->middleware('permission:create.role');

        Route::post('store', 'store')->name('role.store');//->middleware('permission:create.role');

        Route::get('{role}/edit', 'edit')->name('role.edit');//->middleware('permission:edit.role');

        Route::post('{role}', 'update')->name('role.update');//->middleware('permission:edit.role');

        Route::delete('{role}', 'destroy')->name('role.destroy');//->middleware('permission:delete.role');

        Route::get('permission', 'assignPermissionList')->name('role.permission.index');

    });



    Route::controller(PermissionController::class)->prefix('permission')->group(function () {

        Route::get('/', 'index')->name('permission.index');//->middleware('permission:view.permission');

        Route::get('create', 'create')->name('permission.create');//->middleware('permission:create.permission');

        Route::post('store', 'store')->name('permission.store');//->middleware('permission:create.permission');

        Route::get('{permission}/edit', 'edit')->name('permission.edit');//->middleware('permission:edit.permission');

        Route::post('update', 'update')->name('permission.update');//->middleware('permission:edit.permission');

        Route::delete('{permission}', 'destroy')->name('permission.destroy');//->middleware('permission:delete.permission');

        Route::post('permission/delete', 'deleteSinglePermission')->name('permission.delete');//->middleware('permission:delete.permission');

        Route::post('module/store', 'moduleStore')->name('permission.module');

    });



    Route::controller(CompanyController::class)->prefix('company')->group(function () {

        Route::get('/', 'index')->name('company.index');//->middleware('company:view.company');

        Route::get('create', 'create')->name('company.create');//->middleware('company:create.company');

        Route::post('store', 'store')->name('company.store');//->middleware('company:create.company');

        Route::get('{company}/edit', 'edit')->name('company.edit');//->middleware('company:edit.company');

        Route::post('{company}', 'update')->name('company.update');//->middleware('permission:edit.company');

        Route::delete('{company}', 'destroy')->name('company.destroy');//->middleware('company:delete.company');

        Route::post('company/delete', 'deleteSinglecompany')->name('company.delete');//->middleware('company:delete.company');

    });
    //entity dashboard

    Route::get('welcome', [UserController::class, 'welcome'])->name('welcome');//->middleware('user:welcome.user');

    Route::any('users/updateEntityProfile', [UserController::class, 'updateEntityProfile'])->name('users.update-entity-profile');//->middleware('user:update-profile.user');

    Route::any('users/changePassword', [UserController::class, 'changePassword'])->name('users.change-password');//->middleware('users:change-password.users');

    Route::any('users/profile', [UserController::class, 'profile'])->name('users.profile');//->middleware('users:profile.users');



    /** Entity Account Related Routes */

    Route::any('entity/createNewApplication', [EntityController::class, 'createNewApplication'])->name('entity.create-new-application');//->middleware('entity:create-profile.user');



    Route::post('entity/saveEntityApplicationDetail', [EntityController::class, 'saveEntityApplicationDetail'])->name('entity.save-entity-application-detail');//->middleware('entity:create-profile.user');

    Route::post('entity/saveEntityApplicationVerifyAndSubmitDetail', [EntityController::class, 'saveEntityApplicationVerifyAndSubmitDetail'])->name('entity.save-entity-application-verify-and-submit-detail');//->middleware('entity:save-entity-application-verify-and-submit-detail.entity');

    Route::any('entity/entityApplication/success', [EntityController::class, 'entityApplicationSucess']);//->middleware('entity:entityApplicationSucess.entity');



    Route::post('checkEntityApplicationEmailUnique', [EntityController::class, 'checkEntityApplicationEmailUnique']);//->middleware('entity:checkEntityApplicationEmailUnique.entity');

    



    // Route::get('dashboardHtml', [UserController::class, 'dashboardHtml']);



    Route::get('entity/recentApplications', [EntityController::class, 'recentApplicationsView'])->name('entity.recent-applications-view');//->middleware('entity:recent-applications-view.entity');

    Route::post('entity/approveapp', [EntityController::class, 'approveapp'])->name('entity.approveapp');//->middleware('entity:approveapp.entity');

    Route::post('entity/verifiedapp', [EntityController::class, 'verifiedapp'])->name('entity.verifiedapp');//->middleware('entity:approveapp.entity');
	
	Route::post('entity/blockorunblockapp', [EntityController::class, 'blockorunblockapp'])->name('entity.blockorunblockapp');//->middleware('entity:approveapp.entity');


    Route::get('admin/applications', [EntityController::class, 'adminApplicationsView'])->name('admin.applications-view');//->middleware('entity:applications-view.entity');

    Route::get('admin/entity', [EntityController::class, 'adminEntityView'])->name('admin.entity-view');//->middleware('entity:entity-view.entity');



    Route::post('entity/recentApplicationsDataFetch', [EntityController::class, 'recentApplicationsDataFetch'])->name('entity.recent-applications-data-fetch');//->middleware('entity:recent-applications-data-fetch.entity');

    Route::post('entity/rejectApplication', [EntityController::class, 'rejectApplication'])->name('entity.rejectApplication');//->middleware('entity:rejectApplication.entity');

    Route::get('entity/getApplication/{id}', [EntityController::class, 'getApplication'])->name('entity.getApplication');//->middleware('entity:getApplication.entity');

    Route::get('entity/getEntity/{id}', [EntityController::class, 'getEntity'])->name('entity.getEntity');//->middleware('entity:getEntity.entity');

    Route::get('entity/change_application_status/{id}/{status}', [EntityController::class, 'change_application_status'])->name('entity.change_application_status');//->middleware('entity:change_application_status.entity');

    Route::get('entity/proceedToPrint/{id}', [EntityController::class, 'proceedToPrint'])->name('entity.proceedToPrint');//->middleware('entity:proceedToPrint.entity');

    Route::post('entity/upload-file',function(){

        return true;

    });//->middleware('entity:upload-file.entity');
                               




    Route::post('entity/generate-pdf', [EntityController::class, 'generatePdf'])->name('entity.generate-pdf');//->middleware('entity:generate-pdf.entity');

    

    Route::any('entity/qrcodeGenerate', [EntityController::class, 'qrcodeGenerate'])->name('entity.qrcodeGenerate');//->middleware('entity:qrcodeGenerate.entity');



    Route::get('search/applicationSearchView', [EntityController::class, 'applicationSearchView'])->name('entity.application-search-view');//->middleware('entity:application-search-view.entity');

    Route::get('search/renewApplication/{renewApplicationId}', [EntityController::class, 'getRenewEntityApplicationDetail'])->name('entity.get-renew-entity-application-detail');//->middleware('entity:get-renew-entity-application-detail.entity');

    Route::any('entity/createNewApplication', [EntityController::class, 'createNewApplication'])->name('entity.create-new-application');

    Route::post('search/renewApplication/upload-file',function(){

        return true;

    });//->middleware('entity:renewApplication-upload-file.entity');

   

    Route::post('search/searchEntityApplication', [EntityController::class, 'searchEntityApplication'])->name('search.entity-application-search');//->middleware('entity:entity-application-search.entity');



    Route::post('search/getSearchApplicationList', [EntityController::class, 'getSearchApplicationList'])->name('search.fetch-search-application-list');//->middleware('entity:fetch-search-application-list.entity');

    Route::get('/download-pdf/{filePath}',  [EntityController::class, 'downloadPdf'])->name('download-pdf');//->middleware('entity:downloadPdf.entity');



    Route::get('search/surrenderApplication/{surrenderApplicationId}', [EntityController::class, 'getSurrenderEntityApplicationDetail'])->name('entity.get-surrender-entity-application-detail');//->middleware('entity:getSurrenderEntityApplicationDetail.entity');



    Route::post('entity/saveEntitySurrenderDetail', [EntityController::class, 'saveEntitySurrenderDetail'])->name('search.save-surrender-entity-application-detail');//->middleware('entity:saveEntitySurrenderDetail.entity');

    Route::post('search/surrenderApplication/upload-file',function(){

        return true;

    });



    Route::get('entity/draftApplication/{draftApplicationId}', [EntityController::class, 'getDraftEntityApplicationDetail'])->name('entity.get-draft-entity-application-detail');//->middleware('entity:getDraftEntityApplicationDetail.entity');



    Route::post('entity/draftApplication/upload-file',function(){

        return true;

    });//->middleware('entity:draftApplication-upload-file');

    Route::post('entity/sendbackApplication', [EntityController::class, 'sendbackApplication'])->name('entity.sendbackApplication');//->middleware('entity:rejectApplication.entity');

    Route::post('entity/surrenderverifiedapp', [EntityController::class, 'surrenderverifiedapp'])->name('entity.surrenderverifiedapp');//->middleware('entity:approveapp.entity');
    Route::post('entity/terminateverifiedapp', [EntityController::class, 'terminateverifiedapp'])->name('entity.terminateverifiedapp');//->middleware('entity:approveapp.entity');
	
	
	Route::get('specialCategoryApplication',[SpecialCategoryEntityController::class,'specialCategoryEntityFormHtml'])->name('entity.special-category-form');
    Route::post('saveSpecialEntityApplicationDetail', [SpecialCategoryEntityController::class, 'saveSpecialEntityApplicationDetail'])->name('save-special-entity-application-detail');//->middleware('entity:create-profile.user');
    Route::post('saveSpecialEntityApplicationVerifyAndSubmitDetail', [SpecialCategoryEntityController::class, 'saveSpecialEntityApplicationVerifyAndSubmitDetail'])->name('entity.save-special-entity-application-verify-and-submit-detail');
    Route::post('upload-file',function(){
        return true;
    });

    Route::get('admin/specialapplications', [SpecialCategoryEntityController::class, 'adminSpecialApplicationsView'])->name('admin.special-applications-view');//->middleware('entity:applications-view.entity');
    Route::get('admin/special-entity', [SpecialCategoryEntityController::class, 'adminSpecialEntityView'])->name('admin.special-entity-view');//->middleware('entity:entity-view.entity');

    Route::post('common/add_department', [CommonController::class, 'addDepartment'])->name('common.add_department');//->middleware('company:getCompany.comapny');


	
	Route::controller(DepartmentController::class)->prefix('department')->group(function () {

        Route::get('/', 'index')->name('department.index');//->middleware('company:view.company');

        Route::get('create', 'create')->name('department.create');//->middleware('company:create.company');

        Route::post('store', 'store')->name('department.store');//->middleware('company:create.company');

        Route::get('{department}/edit', 'edit')->name('department.edit');//->middleware('company:edit.company');

        Route::post('{department}', 'update')->name('department.update');//->middleware('permission:edit.company');

        Route::delete('{department}', 'destroy')->name('department.destroy');//->middleware('company:delete.company');

        Route::post('department/delete', 'deleteSingledepartment')->name('department.delete');//->middleware('company:delete.company');

    });

});



Route::post('checkCompanyId', [EntityController::class, 'checkCompanyId']);

Route::get('register', [UserController::class, 'register'])->name('users.register');

Route::any('register/success', [UserController::class, 'registerSuccess']);

Route::post('checkEntityEmailUnique', [UserController::class, 'checkEntityEmailUnique']);



Route::post('users/saveBasicEntityDetail', [UserController::class, 'saveBasicEntityDetail'])->name('users.save-basic-entity-detail');

Route::post('users/uploadEntityAuthorizedPersonSupportDocument', [UserController::class, 'uploadEntityAuthorizedPersonSupportDocument']);

Route::post('users/removeEntityAuthorizedPersonSupportDocument', [UserController::class, 'removeEntityAuthorizedPersonSupportDocument']);

Route::post('users/uploadEntityAuthorizedPersonSignature', [UserController::class, 'uploadEntityAuthorizedPersonSignature']);

Route::post('users/removeEntityAuthorizedPersonSignature', [UserController::class, 'removeEntityAuthorizedPersonSignature']);

Route::post('users/saveEntityAuthorizedPersonDetail', [UserController::class, 'saveEntityAuthorizedPersonDetail'])->name('users.save-entity-authorized-person-detail');

Route::post('users/getEntityDetailForFinalStepOnRegister', [UserController::class, 'getEntityDetailForFinalStepOnRegister']);

Route::post('users/saveEntityVerifyAndSubmitDetail', [UserController::class, 'saveEntityVerifyAndSubmitDetail'])->name('users.save-entity-verify-and-submit-detail');

Route::post('common/getStateOptionFromSelectedCountry', [CommonController::class, 'getStateOptionFromSelectedCountry']);

Route::post('common/getCityOptionFromSelectedState', [CommonController::class, 'getCityOptionFromSelectedState']);



Route::post('common/getCompany', [CommonController::class, 'getCompany'])->name('getCompany');//->middleware('company:getCompany.comapny');

Route::post('common/add_address', [CommonController::class, 'addAddress'])->name('common.add_address');//->middleware('company:getCompany.comapny');



Route::post('entity/entity-profile-image-change', [EntityController::class, 'entityProfileImageChange'])->name('entity.entity-profile-image-change');



Route::get('id-card-application/{entityApplicationId}', [EntityController::class, 'entityQrEntityApplicationScanDataView'])->name('entity.entity-qr-scan-data-view');



Route::get('id-card-liquor-application/{entityApplicationId}', [EntityController::class, 'entityQrLiqourScanDataView'])->name('entity.entity-qr-scan-data-view');



Route::post('check-address', [CommonController::class, 'checkAddress']);

Route::post('check-department', [CommonController::class, 'checkDepartment']);


Route::get('liqour-card-view',function(){

    return view('pdfview.liquor-card-view');

});





Route::prefix('liqour')->group(function () {


    Route::get('index',  [LiqourController::class, 'index'])->name('liqour.liqour-index');//->middleware('liqour:view.liqour');

    Route::get('createNewLiqourApplication', [LiqourController::class, 'createNewLiqourApplication'])->name('liqour.create-new-liqour-application');//->middleware('liqour:create-new-liqour-application.liqour');

    Route::post('saveLiqourApplicationDetail', [LiqourController::class, 'saveLiqourApplicationDetail'])->name('liqour.save-liqour-application-detail');//->middleware('liqour:save-liqour-application-detail.liqour');

    Route::post('saveLiqourApplicationVerifyAndSubmitDetail', [LiqourController::class, 'saveLiqourApplicationVerifyAndSubmitDetail'])->name('liqour.save-liqour-application-verify-and-submit-detail');//->middleware('liqour:saveLiqourApplicationVerifyAndSubmitDetail.liqour');

    Route::any('liqourApplication/success', [LiqourController::class, 'liqourApplicationSucess']);//->middleware('liqour:liqourApplicationSucess.liqour');

    Route::post('checkApplicationEmailUnique', [LiqourController::class, 'checkApplicationEmailUnique']);//->middleware('liqour:checkApplicationEmailUnique.liqour');

    Route::post('upload-file', function() { return true; });//->middleware('liqour:upload-file.liqour'); // Consider using a controller method instead of closure

    Route::get('liqourApplications', [LiqourController::class, 'liqourApplicationsView'])->name('entity.recent-liqour-applications-view');//->middleware('liqour:recent-liqour-applications-view.liqour');

    Route::post('deleteLiqourApplication', [LiqourController::class, 'deleteLiqourApplication'])->name('liqour.delete-liqour-application');//->middleware('liqour:deleteLiqourApplication.liqour');

    Route::get('editLiqourApplication/{id}', [LiqourController::class, 'saveLiqourApplicationDetail'])->name('liqour.edit-liqour-application');//->middleware('liqour:saveLiqourApplicationDetail.liqour');

    Route::get('getApplication/{id}', [LiqourController::class, 'getApplication'])->name('liqour.getApplication');//->middleware('liqour:getApplication.liqour');

    Route::get('liqourApplication/{id}', [LiqourController::class, 'getLiqourApplicationDetail'])->name('entity.get-liqour-application-detail');//->middleware('liqour:getLiqourApplicationDetail.liqour');

    Route::post('liqourApplication/upload-file',function(){

        return true;

    });//->middleware('liqour:liqourApplication-upload-file.liqour');

    Route::post('liqourApplicationGenerateCardToPdf', [LiqourController::class, 'liqourApplicationGenerateCardToPdf'])->name('liqour.liqour-application-generate-card-to-pdf');//->middleware('liqour:liqourApplicationGenerateCardToPrint.liqour');

    Route::any('liqourApplicationGenerateCardToPrint/{id}', [LiqourController::class, 'liqourApplicationGenerateCardToPrint'])->name('liqour.liqour-application-generate-card-to-print');//->middleware('liqour:liqourApplicationGenerateCardToPrint.liqour');

    Route::get('liqour-id-card-application/{liqourApplicationId}', [LiqourController::class, 'liqourQrEntityApplicationScanDataView'])->name('liqour.liqour-qr-scan-data-view');//->middleware('liqour:liqourQrEntityApplicationScanDataView.liqour');

    Route::get('liqourExportData', [LiqourController::class, 'liqourExportData'])->name('liqour.liqourExportData');

    Route::post('liqourApplicationStatusChange', [LiqourController::class, 'liqourApplicationStatusChange'])->name('liqour.liqour-application-status-change');

    Route::post('liqourApplicationDataFilterForm', [LiqourController::class, 'liqourApplicationDataFilterForm'])->name('liqour.fetch-liqour-application-data-filter-form');

    Route::post('liqour-generate-pdf', [LiqourController::class, 'liqourGeneratePdf'])->name('liqour.liqour-generate-pdf');//->middleware('entity:generate-pdf.entity');


});
Route::get('liquor/', [LiqourController::class, 'showLiqourLoginForm']);

Route::get('buildingUnitListing/{unitAddress}', [UserController::class, 'buildingUnitListing']);
Route::get('buildingEmployeeListing/{unitAddress}', [UserController::class, 'buildingEmployeeListing']);
Route::get('buildingActiveCardListing/{unitAddress}', [UserController::class, 'buildingActiveCardListing']);
Route::get('buildingInActiveCardListing/{unitAddress}', [UserController::class, 'buildingInActiveCardListing']);


Route::post('unitlist-view',[UserController::class, 'fetchUnitList'])->name('admin.unitlist-view');
Route::post('employeeslist-view',[UserController::class, 'fetchEmployeesList'])->name('admin.employeeslist-view');
Route::post('activelist-view',[UserController::class, 'fetchActiveList'])->name('admin.activelist-view');
Route::post('inactivelist-view',[UserController::class, 'fetchInActiveList'])->name('admin.inactivelist-view');
Route::post('buidlingCompaniesApplicationsDataExport',[UserController::class, 'buildingCompaniesApplicationsDataExport'])->name('user.buidling-companies-applications-data-filter-export');

//cron job
Route::get('expiredApplicationNotifyEmailGenerate',[CommonController::class,'expiredApplicationNotifyEmailGenerate']);
// Route::get('expiredApplicationTwoDaysEarlyNotifyEmailGenerate',[CommonController::class,'expiredApplicationTwoDaysEarlyNotifyEmailGenerate']);
Route::get('expiredApplicationEarlyNotifyEmail',[CommonController::class,'expiredApplicationBeforeTenDaysEarlyNotifyEmail']);
// cron job

// Route::get('demo-dashboard-all',function(){

// return view('users.demo-dashboard-all');

// });

// Route::post('search/searchApplication', [EntityController::class, 'entityApplicationSearch'])->name('search.entity-application-search');

// Route::get('dd',function(){

//     return view('dd');

// });

// // Route::get('logout', [UserController::class, 'logout']);

// Route::group(['middleware' => ['isLogin']], function() {

//     // Route::get('/', function () {

//     //     return view('users/login');

//     // });

//     // Route::get('login', [UserController::class, 'login'])->name('login');

//     // Route::post('forgotPassword',[UserController::class, 'forgotPassword'])->name('forgotPassword');

//     // Route::post('validateLogin', [UserController::class, 'validateLogin'])->name('validateLogin');

// });



// Route::group(['middleware' => ['auth']], function() {

//     Route::post('search','SearchController@index');



//     //Route::get('users','UserController@index');

//     Route::get('welcome', [UserController::class, 'welcome'])->name('welcome');



// });

// Route::get('approve-id-card-html',function(){

//     return view('approve-id-card');

// });

// Route::get('gift-login-html',function(){

//     return view('gift-login-html');

// });

// Route::get('liqour/index',  [LiqourController::class, 'index'])->name('liqour.liqour-index');

// Route::get('liqour/createNewLiqourApplication', [LiqourController::class, 'createNewLiqourApplication'])->name('liqour.create-new-liqour-application');



// Route::get('liqour/createNewLiqourApplication', [LiqourController::class, 'createNewLiqourApplication'])->name('liqour.create-new-liqour-application');



// Route::post('liqour/saveLiqourApplicationDetail', [LiqourController::class, 'saveLiqourApplicationDetail'])->name('liqour.save-liqour-application-detail');



// Route::post('liqour/saveLiqourApplicationVerifyAndSubmitDetail', [LiqourController::class, 'saveLiqourApplicationVerifyAndSubmitDetail'])->name('liqour.save-liqour-application-verify-and-submit-detail');

// Route::any('liqour/liqourApplication/success', [LiqourController::class, 'liqourApplicationSucess']);



// Route::post('checkApplicationEmailUnique', [LiqourController::class, 'checkApplicationEmailUnique']);

// Route::post('liqour/upload-file',function(){

//     return true;

// });



// Route::any('liqour/liqourApplication/success', [LiqourController::class, 'liqourApplicationSucess']);

// Route::get('liqour/liqourApplications', [LiqourController::class, 'liqourApplicationsView'])->name('entity.recent-liqour-applications-view');



// Route::post('liqour/deleteLiqourApplication',[LiqourController::class,'deleteLiqourApplication'])->name('liqour.delete-liqour-application');



Route::get('letshipnowpdf',[EntityController::class,'letshipnowpdf']);
Route::get('uploadidcardsezexceldata',[CommonController::class,'uploadidcardsezexceldata']);
Route::post('uploadidcardsezexceldatapost',[CommonController::class,'uploadidcardsezexceldatapost']);
Route::get('ddset',[CommonController::class,'ddset']);

Route::get('resendmail/{id}',[UserController::class,'resendUserIdPasswordEmail']);
Route::get('pendingApplicationCountNotify',[CommonController::class,'pendingApplicationsCountNotifyEmailGenerate']);
Route::get('check-cron-log',[CommonController::class,'checkcronlog']);
// Route::get('bccExpireDataEmailSend', [CommonController::class, 'bccExpiredApplicationNotifyEmailGenerate']);

Route::get('/get-base-company-list', [UserController::class, 'getBaseCompanyList']);
