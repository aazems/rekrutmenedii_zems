<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('password/initialize/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.initialize');
// Route::get('/', [LoginController::class, 'login'])->name('login');
// Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');


use App\Http\Controllers\AuthController;
use App\Http\Controllers\rekrutcontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\rekrutnewcontroller;
use App\Http\Controllers\ApplymentController;
use App\Http\Controllers\ApplymentnewController;
use App\Http\Controllers\ReportController;
  
// Route::get('/', function () {
//     return view('welcome');
// });
  
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [dashboardController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('home', [dashboardController::class, 'dashboard'])->name('home');

Route::get('rekrutmen', [AuthController::class, 'rekrutmen'])->name('rekrutmen');
Route::get('editrekrutmen', [rekrutController::class, 'edit'])->name('editrekrutmen');
Route::Post('rekrut/simpan', [rekrutcontroller::class, 'simpanrekrut'])->name('simpanrekrut');
Route::get('rekrut/edit/{id}', [rekrutController::class, 'edit'])->name('edit.rekrutmen');
Route::put('rekrutmen/update', [rekrutController::class, 'update'])->name('update.rekrutmen');
Route::delete('rekrut/delete/{id}', [rekrutController::class, 'destroy'])->name('delete.rekrutmen');

Route::get('createrekrutmen', [rekrutController::class, 'rekrutmencreate'])->name('create.rekrutmen');
Route::get('hasilrekrutmen', [rekrutnewController::class, 'hasilrekrutmen'])->name('hasilrekrutmen');

Route::get('profile', [AuthController::class, 'profile'])->name('profile');
Route::post('updateprofile', [AuthController::class, 'updateprofile'])->name('user.updateProfile');
Route::post('updatedataprofile', [AuthController::class, 'updatedataprofile'])->name('user.updatedataProfile');

Route::get('password', [AuthController::class, 'password'])->name('password');
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('user.showChangePasswordForm');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('user.changePassword');

Route::get('applyment', [ApplymentController::class, 'index'])->name('applyment');
Route::get('create/applyment', [ApplymentController::class, 'create'])->name('applyments.create');
Route::Post('store/applyment', [ApplymentnewController::class, 'store'])->name('applyments.store');
Route::get('newapplyment', [ApplymentnewController::class, 'index'])->name('newapplyment');
Route::get('applyments/{id}', [ApplymentController::class, 'show'])->name('applyments.show');
Route::post('/applyment/{id}/proses', [ApplymentController::class, 'proses'])->name('applyment.proses');
Route::post('/applyment/{id}/reject', [ApplymentController::class, 'reject'])->name('applyment.reject');
Route::get('/applyments/{id}', [ApplymentController::class, 'show'])->name('applyments.show');

Route::get('/report_recruitment', [ReportController::class, 'ReportRekrutmen'])->name('report_recruitment');
Route::get('/report_applyment', [ReportController::class, 'Reportapply'])->name('report_applyment');
Route::get('/report_recruitment_filter', [ReportController::class, 'filterRecruitment'])->name('report.recruitment.filter');
Route::get('/report_applyments_filter', [ReportController::class, 'showFilterForm'])->name('applyments.filterForm');
Route::post('/report_applyments_filter', [ReportController::class, 'filterApplyments'])->name('applyments.filter');




