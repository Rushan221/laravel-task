<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyDepartmentResource;
use App\Http\Resources\CompanyEmployeeResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\EmployeeDetailResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiController extends Controller
{
    // API to list companies.
    public function index(): AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::paginate(10));
    }

    // API to list deplartments of company.
    public function getCompanyDepartments($id): AnonymousResourceCollection
    {
        $company = Company::whereId($id)->with('depts')->paginate(10);
        return CompanyDepartmentResource::collection($company);
    }

    // API to list employees in a company.
    public function getCompanyEmployees($id): AnonymousResourceCollection
    {
        $employees = Employee::whereCompanyId($id)->with('company')->paginate(10);
        return CompanyEmployeeResource::collection($employees);
    }

    // API to list employees in a specific department of a company
    public function getCompanyDepartmentEmployees(Request $request, $id): AnonymousResourceCollection
    {
        $departmentId = $request->input('department_id');
        //find employee working in that department
        $employeeInDept = EmployeeDepartment::whereDepartmentId($departmentId)->pluck('employee_id')->toArray();
        //employees of company
        $employees = Employee::whereCompanyId($id)->whereIn('id', $employeeInDept)->paginate(10);

        return EmployeeResource::collection($employees);
    }

    // API to view employee details with respective company and departments
    public function getEmployeeDetails($id): AnonymousResourceCollection
    {
        $employeeDetail = Employee::whereId($id)->with('company')->with('depts')->paginate(10);
        return EmployeeDetailResource::collection($employeeDetail);
    }
}
