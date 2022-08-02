<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $companyCount = Company::all()->count();
        $employeeCount = Employee::all()->count();
        $departmentCount = Department::all()->count();
        return view('admin_dashboard', compact('companyCount', 'employeeCount', 'departmentCount'));
    }
}
