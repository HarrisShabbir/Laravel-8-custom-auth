<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\FactController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::prefix('admin')->group(function(){
    
//Authentication Process
//Registration
Route::get('/registration', [AuthController::class, 'registration'])->name('register');
Route::post('/postregistration', [AuthController::class, 'postregistration'])->name('postregistration');

//Login
Route::get('/', [AuthController::class, 'index']);
// Route::get('admin/login', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');

//Email Verificatuin
Route::get('/account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');

//Forget Password
Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

//Password Reset
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Language Routes
Route::get('lang/home', [LangController::class,'index']);
Route::get('lang/change', [LangController::class,'change'])->name('changeLang');

    //Admin Login Dashboard
    Route::middleware(['auth','is_verify_email'])->group(function(){

        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        //  Users Routes Starts
        // ->middleware('can:User_View') ->middleware('can:user_add')
        Route::get('/users', [AdminController::class, 'index'])->name('users');
        Route::get('/user/create', [AdminController::class, 'create'])->name('user.create')->middleware('can:user_add');
        Route::post('/user/store', [AdminController::class, 'store'])->name('user.store')->middleware('can:user_add');
        Route::get('/user/edit/{id}', [AdminController::class, 'edit'])->name('user.edit')->middleware('can:user_edit');
        Route::post('/user/update', [AdminController::class, 'update'])->name('user.update')->middleware('can:user_edit');
        Route::get('/user/destroy/{id}', [AdminController::class, 'destroy'])->name('user.destroy')->middleware('can:user_delete');
        // User HasPermissions Starts Routes
        Route::get('/user/permission/{id}', [AdminController::class, 'haspermission'])->name('user.permissions')->middleware('can:user_has_permission');
        Route::post('/user/haspermissionupdate', [AdminController::class, 'haspermissionupdate'])->name('user.haspermissionupdate')->middleware('can:user_has_permission');
        // User HasPermissions ends Routes

        // User Profile Routes
         Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
         Route::post('/profile/update', [AdminController::class, 'profileupdate'])->name('profile.update');
        // User Profile Routes

        // Profile Password Update Routes
        Route::post('/profile/updatepassword', [AdminController::class, 'updatepassword'])->name('profile.updatepassword');
        //Profile Password Routes ends

        //Roles Routes Starts
        Route::get('/roles', [RoleController::class, 'index'])->name('roles')->middleware('can:role_view');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create')->middleware('can:role_add');
        Route::post('/role/store', [RoleController::class, 'store'])->name('role.store')->middleware('can:role_add');;
        Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('can:role_edit');
        Route::post('/role/update', [RoleController::class, 'update'])->name('role.update')->middleware('can:role_edit');
        Route::get('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('can:role_delete');
        Route::get('/role/permission/{id}', [RoleController::class, 'haspermission'])->name('role.permissions')->middleware('can:role_has_permission');
        Route::post('/role/haspermissionupdate', [RoleController::class, 'haspermissionupdate'])->name('role.haspermissionupdate')->middleware('can:role_has_permission');
        //    Roles Routes ends

        //    Permissions Routes Starts
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions')->middleware('can:permission_edit');
        Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create')->middleware('can:permission_add');
        Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store')->middleware('can:permission_add');
        Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('can:permission_edit');
        Route::post('/permission/update', [PermissionController::class, 'update'])->name('permission.update')->middleware('can:permission_edit');
        Route::get('/permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy')->middleware('can:permission_delete');
        //    Permissions Routes ends

// Facts Routes Starts
         Route::get('/facts', [FactController::class, 'index'])->name('facts')->middleware('can:fact_view');
        //  Route::get('/fact/create', [FactController::class, 'create'])->name('fact.create')->middleware('can:fact_add');
         Route::post('/fact/store', [FactController::class, 'store'])->name('fact.store')->middleware('can:fact_add');
        Route::get('/fact/edit/{id}', [FactController::class, 'edit'])->name('fact.edit')->middleware('can:fact_edit');
         Route::post('/fact/update', [FactController::class, 'update'])->name('fact.update')->middleware('can:fact_edit');
         Route::get('/fact/destroy/{id}', [FactController::class, 'destroy'])->name('fact.destroy')->middleware('can:fact_delete');
// Facts Routes Ends

//Magazine Routes Starts
Route::get('/magazines', [MagazineController::class, 'index'])->name('magazines');
//Magazine Routes end

//Post Routes Starts
Route::get('/posts', [PostController::class, 'index'])->name('posts');
//Post Routes end

//Group Routes Starts
Route::get('/groups', [GroupController::class, 'index'])->name('groups');
//Post Routes end

//Group Routes Starts
Route::get('/web_users', [UserController::class, 'index'])->name('web_users');
//Post Routes end


    });
}); 
