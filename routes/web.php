<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('logout/', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth:admin'])->group(function () {
    //resurce routes
    Route::resource('company', 'CompanyController')->except('destroy');
    Route::resource('department', 'DepartmentController')->except('destroy');
    Route::resource('employee', 'EmployeeController')->except('destroy');

    //delete routes
    Route::post('company/destroy', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::post('department/destroy', [DepartmentController::class, 'destroy'])->name('department.destroy');
    Route::post('employee/destroy', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::post('add-department', [CompanyController::class, 'addDepartment'])->name('add.department');
    Route::get('get-company-departments', [EmployeeController::class, 'getCompanyDepartments'])->name('get.company.departments');
});
