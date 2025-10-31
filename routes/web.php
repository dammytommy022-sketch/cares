<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'admin'])->group(function () {
    // Your admin routes here
    
});

Route::middleware('admin')->group(function () {
    // Your admin-specific routes here
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin_hca', [App\Http\Controllers\AdminController::class, 'createhca'])->name('admin.createhca');
    Route::get('/admin/hcaworkers', [App\Http\Controllers\AdminController::class, 'hcaworkers'])->name('admin.hcaworkers');
    Route::post('/admin/hca_post', [App\Http\Controllers\AdminController::class, 'postcreatehca'])->name('admin.postcreatehca');
    Route::get('/admin/edit/hca/{id}', [App\Http\Controllers\AdminController::class, 'edithca'])->name('admin.edithca');
    Route::get('/admin/view/hca/{id}', [App\Http\Controllers\AdminController::class, 'viewhca'])->name('admin.viewhca');
    Route::put('/admin/update/hca/{hcas}', [App\Http\Controllers\AdminController::class, 'updatehca'])->name('admin.updatehca');
    Route::get('/admin/nurses', [App\Http\Controllers\AdminController::class, 'nurses'])->name('admin.nurses');
    Route::get('/admin/nurse', [App\Http\Controllers\AdminController::class, 'createnurse'])->name('admin.createnurse');
    Route::get('/admin/edit/nurse/{id}', [App\Http\Controllers\AdminController::class, 'editnurse'])->name('admin.editnurse');
    Route::get('/admin/view/nurse/{id}', [App\Http\Controllers\AdminController::class, 'viewnurse'])->name('admin.viewnurse');
    Route::put('/admin/update/nurse/{nurse}', [App\Http\Controllers\AdminController::class, 'updatenurse'])->name('admin.updatenurse');

    Route::post('/admin/nurse_post', [App\Http\Controllers\AdminController::class, 'postcreatenurse'])->name('admin.postcreatenurse');
   
    Route::get('/admin_records', [App\Http\Controllers\AdminController::class, 'records'])->name('admin.records');
    Route::get('/admin_resident', [App\Http\Controllers\AdminController::class, 'createresident'])->name('admin.createresident');
    Route::post('/admin_resident_post', [App\Http\Controllers\AdminController::class, 'postcreateresident'])->name('admin.postcreateresident');
    Route::get('/admin/residents', [App\Http\Controllers\AdminController::class, 'residents'])->name('admin.residents');
    Route::get('/admin/edit/residents/{id}', [App\Http\Controllers\AdminController::class, 'editresidents'])->name('admin.editresidents');
    Route::get('/admin/view/residents/{id}', [App\Http\Controllers\AdminController::class, 'viewresidents'])->name('admin.viewresidents');
    Route::put('/admin/update/residents/{residents}', [App\Http\Controllers\AdminController::class, 'updateresidents'])->name('admin.updateresidents');

    
    Route::get('/setting', [App\Http\Controllers\AdminController::class, 'setting'])->name('admin.setting');
    Route::post('/change-password', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('change.password');
    Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name('update-profile');

    Route::post('/admin_logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/admin_login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login');
    Route::get('/shifts', [App\Http\Controllers\AdminController::class, 'shifts'])->name('admin.shifts');
    Route::get('/shifts/edit/{id}', [App\Http\Controllers\AdminController::class, 'editshift'])->name('admin.editshift');
    Route::post('/shifts/update/{id}', [App\Http\Controllers\AdminController::class, 'updateshift'])->name('admin.updateshift');
    Route::get('/shifts/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteshift'])->name('admin.deleteshift');

    Route::get('/addShifts', [AdminController::class, 'addshifts'])->name('admin.addShifts');
    Route::post('/addShifts', [AdminController::class, 'postcreateShift'])->name('admin.postcreateShift');

});
Route::middleware('hca')->group(function () {
    // Your admin-specific routes here
    Route::get('/hca', [App\Http\Controllers\HcaController::class, 'dashboard'])->name('hca.index');
    Route::get('/residents{id}', [App\Http\Controllers\HcaController::class, 'resident'])->name('hca.residents');
    Route::get('/resident{id}', [App\Http\Controllers\HcaController::class, 'resident'])->name('hca.resident');
    Route::get('/resident1{id}', [App\Http\Controllers\HcaController::class, 'resident'])->name('hca.resident1');


    Route::get('/note{id}', [App\Http\Controllers\HcaController::class, 'note'])->name('hca.note');
    Route::post('/hca_note_post', [App\Http\Controllers\HcaController::class, 'postnote'])->name('hca.postnote');
    Route::post('/hca_logout', [App\Http\Controllers\HcaController::class, 'logout'])->name('hca.logout');
    Route::get('/forms{id}', [App\Http\Controllers\HcaController::class, 'forms'])->name('hca.forms');
    Route::get('/form{id}', [App\Http\Controllers\HcaController::class, 'form_fcl'])->name('hca.form');

    Route::get('/fcl{id}', [App\Http\Controllers\HcaController::class, 'form_fcl'])->name('hca.fcl');
    Route::post('/postfcl', [App\Http\Controllers\HcaController::class, 'post_fcl'])->name('hca.postfcl');

    Route::get('/pcc{id}', [App\Http\Controllers\HcaController::class, 'form_pcc'])->name('hca.pcc');
    Route::post('/postpcc', [App\Http\Controllers\HcaController::class, 'post_pcc'])->name('hca.postpcc');

    Route::get('/mec{id}', [App\Http\Controllers\HcaController::class, 'form_mec'])->name('hca.mec');
    Route::post('/postmec', [App\Http\Controllers\HcaController::class, 'post_mec'])->name('hca.postmec');

    Route::get('/mbec{id}', [App\Http\Controllers\HcaController::class, 'form_mbec'])->name('hca.mbec');
    Route::post('/postmbec', [App\Http\Controllers\HcaController::class, 'post_mbec'])->name('hca.postmbec');

    Route::get('/siwc{id}', [App\Http\Controllers\HcaController::class, 'form_siwc'])->name('hca.siwc');
    Route::post('/postsiwc', [App\Http\Controllers\HcaController::class, 'post_siwc'])->name('hca.postsiwc');

    Route::get('/mbc{id}', [App\Http\Controllers\HcaController::class, 'form_mbc'])->name('hca.mbc');
    Route::post('/postmbc', [App\Http\Controllers\HcaController::class, 'post_mbc'])->name('hca.postmbc');

    Route::get('/fc{id}', [App\Http\Controllers\HcaController::class, 'form_fc'])->name('hca.fc');
    Route::post('/postfc', [App\Http\Controllers\HcaController::class, 'post_fc'])->name('hca.postfc');

    Route::get('/bc{id}', [App\Http\Controllers\HcaController::class, 'form_bc'])->name('hca.bc');
    Route::post('/postbc', [App\Http\Controllers\HcaController::class, 'post_bc'])->name('hca.postbc');

    Route::get('/fic{id}', [App\Http\Controllers\HcaController::class, 'form_fic'])->name('hca.fic');
    Route::post('/postfic', [App\Http\Controllers\HcaController::class, 'post_fic'])->name('hca.postfic');

    Route::get('/test', [App\Http\Controllers\HcaControllerA::class, 'test'])->name('hca.test');

    Route::get('/settings', [App\Http\Controllers\HcaController::class, 'setting'])->name('hca.settings');
    Route::post('/password', [App\Http\Controllers\HcaController::class, 'changePassword'])->name('hca.password');
    Route::post('/profile', [App\Http\Controllers\HcaController::class, 'updateProfile'])->name('hca.profile');

    
    //Route::get('/form_fcl{id}', [App\Http\Controllers\HcaController::class, 'form_fcl'])->name('hca.form_fcl');

    //Route::get('/formfcl{id}', [App\Http\Controllers\HcaController::class, 'resident'])->name('hca.formfcl');
    Route::get('/formbowel{id}', [App\Http\Controllers\HcaController::class, 'form_bowel'])->name('hca.formbowel');
    Route::post('/formbowel_post', [App\Http\Controllers\HcaController::class, 'postform_bowel'])->name('hca.postform_bowel');
    Route::get('/formfluid{id}', [App\Http\Controllers\HcaController::class, 'form_fluid'])->name('hca.formfluid');
    Route::post('/formfluid_post', [App\Http\Controllers\HcaController::class, 'postform_fluid'])->name('hca.postform_fluid');
});

Route::middleware('nurse')->group(function () {
    // Your admin-specific routes here
    Route::get('/nurse', [App\Http\Controllers\NurseController::class, 'dashboard'])->name('nurse.index');
    Route::post('/nurseLogout', [App\Http\Controllers\NurseController::class, 'logout'])->name('nurse.logout');
});

Route::get('/emailtest', [App\Http\Controllers\HcaController::class, 'emailTest'])->name('emailTest');
Route::get('/reset', [App\Http\Controllers\HcaController::class, 'emailTest'])->name('password.reset'); 

Route::get('/forgot-password', [App\Http\Controllers\HcaController::class, 'forgotpassword'])->name('hca.forgot-password');
Route::post('/post-forgot-password', [App\Http\Controllers\HcaController::class, 'submitForgetPasswordForm'])->name('hca.postforgetpassword');
Route::get('hcareset-password/{token}', [App\Http\Controllers\HcaController::class, 'showResetPasswordForm'])->name('hcareset.password.get');
Route::post('hcareset-password/', [App\Http\Controllers\HcaController::class, 'submitResetPasswordForm'])->name('hca.postresetpassword');
   
Route::post('/admin_login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login');
Route::get('/admin_signin', [App\Http\Controllers\AdminController::class, 'signin'])->name('admin.signin');

Route::post('/nurse_login', [App\Http\Controllers\NurseController::class, 'login'])->name('nurse.login');
Route::get('/nurse/signin', [App\Http\Controllers\NurseController::class, 'signin'])->name('nurse.signin');


Route::post('/hca_login', [App\Http\Controllers\HcaController::class, 'login'])->name('hca.login');
Route::get('/', [App\Http\Controllers\HcaController::class, 'index'])->name('home');
Route::get('reset-password/{token}', [App\Http\Controllers\HcaController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password/', [App\Http\Controllers\HcaController::class, 'submitResetPasswordForm'])->name('reset.password.post');
   