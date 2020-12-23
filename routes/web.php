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
use Illuminate\Http\Request;

Route::get('/index', 'WebController@index');
Route::get('/registers', ['as' => 'registers', 'uses' => 'DtbLoginController@register']);

Route::get('graduate_club', 'ErpPatientMakePaymentController@index')->name('graduate_club');

Route::group(['middleware' => 'revalidate'], function(){
	Route::get('/', 'ErpTestController@index');
	Route::get('/home', 'ErpTestController@index');
	Route::get('/dashboard', 'HomeController@index');
});

Auth::routes();

Route::resource('test', 'ErpTestController');
Route::get('import_test', ['as' => 'import_test', 'uses' => 'ErpTestController@create']);
Route::post('store_excel', ['as' => 'store_excel', 'uses' => 'ErpTestController@import']);
Route::post('search_test', ['as' => 'search_test', 'uses' => 'ErpTestController@searchTest']);

Route::get('add-to-cart', 'ErpTestController@addToCart')->name('add-to-cart');
Route::get('remove_cart_test', 'ErpTestController@removeCartTest')->name('remove_cart_test');

Route::get('checkout', 'ErpTestController@checkout')->name('checkout');
Route::post('checkout_patient', 'ErpTestController@checkout_patient')->name('checkout_patient');
Route::get('/send/email', 'ErpTestController@mail');
Route::get('remove_all_tests', 'ErpTestController@removeAllTests')->name('remove_all_tests');
Route::get('clear_test_cart', 'ErpTestController@clearTestCart')->name('clear_test_cart');
Route::get('all_requested_tests', 'ErpSecretaryDashboardController@requestedTests')->name('all_requested_tests');
Route::get('send_to_patient/{prescribe_id}', 'ErpSecretaryDashboardController@sendToPatient')->name('send_to_patient');
Route::get('edit_phase_two_details/{prescribe_id}', 'ErpSecretaryDashboardController@editPhasetwoDeatails')->name('edit_phase_two_details');
Route::post('update_phase_two_details', 'ErpSecretaryDashboardController@updatePhasetwoDetails')->name('update_phase_two_details');

Route::post('store_patient_data', 'ErpSecretaryDashboardController@storePatientData')->name('store_patient_data');
Route::get('view_presb_patient/{prescribe_id}', 'ErpSecretaryDashboardController@viewPresbToPatient');

Route::get('payment_request_confirmation_view/{prescribe_id}/{enter_status}', 'ErpSecretaryDashboardController@confirmationView')->name('payment_request_confirmation_view');
Route::get('payment_request_confirmation_re_view/{prescribe_id}/{enter_status}', 'ErpSecretaryDashboardController@reConfirmationView')->name('payment_request_confirmation_re_view');
Route::post('payment_request_email/{prescribe_id}', 'ErpSecretaryDashboardController@paymentRequestEmail')->name('payment_request_email');

Route::post('payment_request_re_email/{prescribe_id}', 'ErpSecretaryDashboardController@paymentRequestReEmail')->name('payment_request_re_email');

Route::get('make-payment/{prescribe_id}', 'ErpPatientMakePaymentController@index')->name('make-payment');
Route::post('stripe', 'ErpPatientMakePaymentController@stripePost')->name('stripe.post');
Route::get('payment-success', 'ErpPatientMakePaymentController@paymentSuccess')->name('payment-success');
Route::get('view_pdf_request_form/{prescribe_id}', 'ErpSecretaryDashboardController@viewPdfRequestForm')->name('view_pdf_request_form');
Route::get('send_pdf_to_nurse_view/{prescribe_id}/{payment_status}', 'ErpSecretaryDashboardController@sendPdfToNurseView')->name('send_pdf_to_nurse_view');

Route::get('resend_pdf_to_nurse_view/{prescribe_id}/{payment_status}', 'ErpSecretaryDashboardController@reSendPdfToNurseView')->name('resend_pdf_to_nurse_view');

Route::get('send_thanks_to_patient_view/{prescribe_id}/{payment_status}', 'ErpSecretaryDashboardController@sendThanksToPatientView')->name('send_thanks_to_patient_view');

Route::post('send_thanks_to_patient', 'ErpSecretaryDashboardController@sendThanksToPatient')->name('send_thanks_to_patient');

Route::post('send_pdf_to_nurse', 'ErpSecretaryDashboardController@sendPdfToNurse')->name('send_pdf_to_nurse');
Route::get('delete_prescribtion/{prescribe_id}', 'ErpSecretaryDashboardController@deletePrescribtion')->name('delete_prescribtion');
Route::post('disable_prescribe/{prescribe_id}', 'ErpSecretaryDashboardController@disablePrescribtion')->name('disable_prescribe');
Route::get('disabledpres', 'ErpSecretaryDashboardController@allDeletedPrescribes')->name('allDeletedPrescribes');
Route::get('payment_receive_manually/{prescribe_id}', 'ErpPatientMakePaymentController@paymentReceivedManView')->name('payment_receive_manually');

Route::post('store_payment_data_man', 'ErpPatientMakePaymentController@storePaymentDataMan')->name('store_payment_data_man');

Route::get('download_pdf_request_form/{prescribe_id}', 'ErpSecretaryDashboardController@downloadPdfRequesForm');

Route::get('reminder_email', 'ErpSecretaryDashboardController@reminderEmail');


// project
Route::resource('project', 'ErpProjectController');
Route::get('deleteProjectView/{id}', 'ErpProjectController@deleteProjectView');
Route::get('deleteProject/{id}', 'ErpProjectController@deleteProject');


//Client route 
Route::resource('client', 'ErpClientController');
Route::get('deleteClientView/{id}', 'ErpClientController@deleteClientView');
Route::get('deleteClient/{id}', 'ErpClientController@deleteClient');

// Role route
Route::resource('role', 'ErpRoleController');
Route::get('deleteRoleView/{id}', 'ErpRoleController@deleteRoleView');
Route::get('deleteRole/{id}', 'ErpRoleController@deleteRole');
Route::get('assign-permission/{role_id}', 'ErpRoleController@assignPermission');
Route::post('role_permission_store', 'ErpRoleController@rolePermissionStore');

// User route
Route::resource('user', 'ErpUserController');
Route::get('deleteUserView/{id}', 'ErpUserController@deleteUserView');
Route::get('deleteUser/{id}', 'ErpUserController@deleteUser');

// Base group routes
Route::resource('base_group', 'ErpBaseGroupController');
Route::get('deleteBaseGroupView/{id}', 'ErpBaseGroupController@deleteBaseGroupView');
Route::get('deleteBaseGroup/{id}', 'ErpBaseGroupController@deleteBaseGroup');

// Base setup routes
Route::resource('base_setup', 'ErpBaseSetupController');
Route::get('deleteBaseSetupView/{id}', 'ErpBaseSetupController@deleteBaseSetupView');
Route::get('deleteBaseSetup/{id}', 'ErpBaseSetupController@deleteBaseSetup');

// Designation routes
Route::resource('designation', 'ErpDesignationController');
Route::get('deleteDesignationView/{id}', 'ErpDesignationController@deleteDesignationView');
Route::get('deleteDesignation/{id}', 'ErpDesignationController@deleteDesignation');

// Department routes
Route::resource('department', 'ErpDepartmentController');
Route::get('deleteDepartmentView/{id}', 'ErpDepartmentController@deleteDepartmentView');
Route::get('deleteDepartment/{id}', 'ErpDepartmentController@deleteDepartment');

// Employee routes
Route::resource('patient', 'ErpPatientController');
Route::get('deletePateientView/{id}', 'ErpPatientController@deletePateientView');
Route::get('deletePateient/{id}', 'ErpPatientController@deletePateient');

// Route::get('deleteEmployeeView/{id}', 'ErpEmployeeController@deleteEmployeeView');
// Route::get('deleteEmployee/{id}', 'ErpEmployeeController@deleteEmployee');

Route::get('create', ['as' => 'create', 'uses' => 'ErpPatientController@create']);
Route::post('edit', ['as' => 'edit', 'uses' => 'ErpPatientController@edit']);
//expenses
Route::resource('expenses', 'ErpExpenseController');


// Module links routes
Route::resource('module_link', 'ErpModuleLinksController');
Route::get('deleteModuleLinkView/{id}', 'ErpModuleLinksController@deleteModuleLinkView');
Route::get('deleteModuleLink/{id}', 'ErpModuleLinksController@deleteModuleLink');


//web

//Route::get('home', 'ErpWebController@home');
//Route::get('behabiour', 'ErpWebController@behabiour');

Route::get('support_plan', ['as' => 'support_plan', 'uses' => 'ErpWebController@support_plan']);
Route::get('behabiour', ['as' => 'behabiour', 'uses' => 'ErpWebController@behabiour']);

//Route::get('generatePDF', 'ErpPatientController@generatePDF');
//Route::get('generatePDF/{id}', ['as' => 'generatePDF', 'uses' => 'ErpPatientController@generatePDF']);
Route::get('generatePDF/{id}', 'ErpPatientController@generatePDF');
Route::get('patient_demog/{id}', 'ErpPatientController@patient_demog');
Route::get('support_plan/{id}', 'ErpPatientController@support_plan');
Route::get('full_patients_details/{id}', 'ErpPatientController@full_patients_details');


Route::get('/clear', function() {
   Artisan::call('cache:clear');
   Artisan::call('view:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
  
   
});

Route::get('/cron', function () {
            Artisan::call('work:reminderemail');
        });