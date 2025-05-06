<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Livewire\Chat\Chat;
use App\Http\Livewire\Chat\Index;
use App\Http\Livewire\Users;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    Route::get('/chat',Index::class)->name('chat.index');
    Route::get('/chat/{query}',Chat::class)->name('chat');
    Route::get('/users',Users::class)->name('users');
    Route::get('/message/{userId}', [Users::class, 'message'])->name('message');
});

//Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register & login
Route::get('/', [Controller::class, 'viewlogin'])->name('login')->middleware('guest');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth')->middleware('guest');
Route::get('/register', [Controller::class, 'viewregister'])->name('register')->middleware('guest');
Route::post('/validate', [RegisterController::class, 'register'])->name('validate');

//forgot password
Route::get('/forgotpass', [ForgotPassController::class, 'view'])->name('forgotpass')->middleware('guest');
Route::get('/codepass', [ForgotPassController::class, 'viewcode'])->name('codepass')->middleware('guest');
Route::get('/resetpass', [ForgotPassController::class, 'viewreset'])->name('viewreset')->middleware('guest');
Route::get('/done', [ForgotPassController::class, 'done'])->name('all-done')->middleware('guest');
Route::post('/send-code', [ForgotPassController::class,'sendcode'])->name('forgot.send');
Route::post('/verify-code', [ForgotPassController::class, 'verifyCode'])->name('password.verify.code');
Route::post('/reset-password', [ForgotPassController::class, 'resetPassword'])->name('password.reset');
Route::get('/kirim-email', [ForgotPassController::class, 'kirimEmail']);
Route::get('/lihat-email', [ForgotPassController::class, 'email']);

// Admin
Route::get('/dashboard',[DashboardController::class, 'showAdminDashboard'])->name('dashboard-admin')->middleware(['auth', 'admin']);
Route::get('/admin/clients', [AdminController::class, 'Clients'])->name('admin-clients')->middleware(['auth', 'admin']);
Route::get('/admin/clients/search', [AdminController::class, 'clientSearch'])->name('admin.client.search')->middleware(['auth', 'admin']);
Route::get('/admin/user/add', [AdminController::class, 'addUser'])->name('admin.add.user')->middleware(['auth', 'admin']);
Route::get('/admin/user/edite/{user_id}', [AdminController::class, 'editeUser'])->name('admin.edite.user')->middleware(['auth', 'admin']);
Route::put('/admin/user/store/{user_id}', [AdminController::class, 'editStore'])->name('admin.user.update.store')->middleware(['auth', 'admin']);
Route::delete('/admin/user/delete/{user_id}', [AdminController::class, 'userDelete'])->name('admin.user.delete')->middleware(['auth', 'admin']);
Route::get('/user/profile/{user_id}', [AdminController::class, 'Profile'])->name('user.profile')->middleware('auth');

// admin invoice
Route::get('/admin/invoice', [InvoiceController::class, 'viewInvoice'])->name('admin.invoice')->middleware(['admin', 'auth']);
Route::get('/admin/invoice/search', [InvoiceController::class, 'invoiceSearch'])->name('admin.search.invoice')->middleware(['auth', 'admin']);
Route::get('/invoice/search', [InvoiceController::class, 'invoiceSearch'])->name('invoice.search')->middleware(['auth', 'user']);
Route::get('/invoice', [InvoiceController::class, 'viewInvoice'])->name('user.invoice')->middleware(['user', 'auth']);
Route::get('/admin/create/invoice', [InvoiceController::class, 'create'])->name('admin.create.invoice')->middleware(['auth', 'admin']);
Route::get('/get/client/invoice/{user_id}', [InvoiceController::class, 'getClient']);
Route::get('/get/project/invoice/{project_id}', [InvoiceController::class, 'getProject']);
Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('admin.invoice.store')->middleware(['auth', 'admin']);
Route::delete('/invoice/delete/{invoice_number}', [InvoiceController::class, 'invoiceDelete'])->name('invoice.delete')->middleware(['admin', 'auth']);
Route::get('/invoice/paid/{invoice_number}', [InvoiceController::class, 'viewPaid'])->name('mark.invoice')->middleware(['auth', 'admin']);
Route::put('/invoice/mark/{invoice_number}', [InvoiceController::class, 'mark'])->name('invoice.mark')->middleware(['auth', 'admin']);

// Admin Project
Route::get('admin/project', [ProjectController::class, 'adminProject'])->name('admin.project')->middleware(['auth', 'admin']);
Route::get('/users/{user_id}', [ProjectController::class, 'getClient'])->name('client_get');
Route::get('/Project/Addform', [ProjectController::class, 'projeckFromView'])->name('projeckForm.view')->middleware(['auth', 'admin']);
Route::post('/UploadDataForm/store', [ProjectController::class, 'store'])->name('UploadDataStore');
Route::get('/data-project/update_form/{project_id}', [ProjectController::class, 'updateDataView'])->name('update.data.view')->middleware(['auth', 'admin']);
Route::get('project/updateForm/{project_id}', [ProjectController::class, 'projectUpdate'])->name('project.form.update')->middleware(['auth', 'admin']);
Route::put('project/update/{project_id}', [ProjectController::class, 'projectUpdateStore'])->name('project.update.store');
Route::get('/admin/data-project', [ProjectController::class, 'adminDataProject'])->name('admin.data.project')->middleware(['auth', 'admin']);
Route::get('/admin/project/search', [ProjectController::class, 'adminProjectSearch'])->name('admin.project.search')->middleware(['auth', 'admin']);
Route::get('/admin/data-project/search', [ProjectController::class, 'adminProjectDataSearch'])->name('admin.dataProject.search')->middleware(['auth', 'admin']);
Route::post('/Project/items/store/{project_id}', [ProjectController::class, 'items_store'])->name('items.store')->middleware(['admin', 'auth']);
Route::delete('/Project/items/delete/{items_id}', [ProjectController::class, 'items_delete'])->name('items.delete')->middleware(['admin', 'auth']);
Route::get('items/update/{items_id}', [ProjectController::class, 'items_update'])->name('items.update')->middleware(['admin', 'auth']);
Route::put('items/update/store/{items_id}', [ProjectController::class, 'items_update_store'])->name('items.update.store')->middleware(['admin', 'auth']);
Route::get('/get-items/{items_id}', [ProjectController::class, 'getItems']);

// Notifications
Route::get('/notifications', [Controller::class, 'viewNotif'])->name('notifications')->middleware(['auth']);
Route::delete('/notification/delete/{id}', [Controller::class, 'delete'])->name('notification.delete')->middleware(['auth']);

// user
Route::get('/dashboards', [DashboardController::class, 'showUserDashboard'])->name('user-dashboard')->middleware(['auth', 'user']);
// user project
Route::get('/project', [ProjectController::class, 'view'])->name('user.project')->middleware(['auth','user']);
Route::get('/data-project', [ProjectController::class, 'view2'])->name('user.data-project')->middleware(['auth', 'user']);
Route::get('/data-project/search', [ProjectController::class, 'projectDataSearch'])->name('projectDataSearch')->middleware('auth');
Route::get('/project/search', [ProjectController::class, 'projectSearch'])->name('project.search')->middleware('auth');

// 3d viewer
Route::get('/3dviews/{project_id}', [ProjectController::class, 'views'])->name('au');
Route::get('/3dviews/items/{items_id}', [ProjectController::class, 'views2'])->name('ai');

// project page admin user
Route::post('/Project/Form_store', [ProjectController::class, 'projectFormStore'])->name('projeckForm.store');
Route::get('/get/project/{project_id}', [ProjectController::class, 'getProject'])->name('projectGet');
Route::get('Project/details/{project_id}', [ProjectController::class, 'projectDetail'])->name('view.project.detail');
Route::delete('/Project/delete/{project_id}', [ProjectController::class, 'projectDelete'])->name('project.delete');
Route::post('/project/{project_id}/report', [ProjectController::class, 'report'])->name('project.report');
Route::get('/Project-data/download/{data_id}', [ProjectController::class, 'download'])->name('project.data.download');
Route::get('/invoice/{invoice_number}', [InvoiceController::class, 'invoiceDetail'])->name('invoice.detail')->middleware('auth');
Route::post('/report/invoice', [InvoiceController::class, 'reports'])->name('report.invoice');
Route::get('/data-project/view_download/{project_id}', [ProjectController::class, 'download_list'])->name('view.download')->middleware('auth');
Route::delete('/Data/items/{data_id}', [ProjectController::class, 'dataDelete'])->name('data.delete');


// settings
Route::get('/settings/myaccount', [Controller::class, 'viewsettings'])->name('setting')->middleware(['auth']);
Route::get('/settings/notifications', [Controller::class, 'viewsetnot'])->name('setnot')->middleware(['auth']);
Route::get('/settings/security', [Controller::class, 'viewsecur'])->name('security')->middleware(['auth']);
Route::get('/settings/invoice', [Controller::class, 'viewinvo'])->name('invoice')->middleware(['auth']);
Route::post('/change-pass', [ProfileController::class, 'updatepass'])->name('updatepass'); //membuat password baru di settings
Route::put ('/profile/update', [ProfileController::class, 'update'])->name('update-photo')->middleware('auth');
Route::delete('/profile/delete-avatar', [ProfileController::class, 'deleteavatar'])->name('delete-avatar')->middleware('auth');
Route::put('/profile/updates', [ProfileController::class, 'updates'])->name('profile.update')->middleware('auth');

Route::get('/test',[Controller::class, 'test'])->name('test');