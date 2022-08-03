<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/companies', [ApiController::class, 'index']);
    Route::get('/get-company-departments/{id}', [ApiController::class, 'getCompanyDepartments']);
    Route::get('/get-company-employees/{id}', [ApiController::class, 'getCompanyemployees']);
    Route::get('/get-company-department-employees/{id}', [ApiController::class, 'getCompanyDepartmentEmployees']);
    Route::get('/get-employee-details/{id}', [ApiController::class, 'getEmployeeDetails']);
});
