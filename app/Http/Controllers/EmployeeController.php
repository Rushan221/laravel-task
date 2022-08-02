<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyDepartment;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $cardHeader = 'Employees';

        return view('employee.index', compact('employees', 'cardHeader'));
    }

    public function create()
    {
        $cardHeader = 'Create an Employee';
        $companies = Company::all();
        return view('employee.create', compact('cardHeader', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'bail|required|email|max:255|unique:employees,email',
            'contact' => 'required',
            'designation' => 'required',
            'company' => 'required',
        ]);
        $input = $request->all();

        //generate employee number
        $empNumber = mt_rand(10000000, 99999999);

        //begin db transaction
        DB::beginTransaction();
        try {
            $employee = Employee::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'contact' => $input['contact'],
                'designation' => $input['designation'],
                'company_id' => $input['company'],
                'employee_number' => $empNumber
            ]);
            if (array_key_exists('departments', $input)) {
                foreach ($input['departments'] as $department) {
                    EmployeeDepartment::create([
                        'employee_id' => $employee->id,
                        'department_id' => $department
                    ]);
                }
            }
            DB::commit();
            Alert::toast('Employee Created!', 'success');
            return redirect()->route('employee.index');
        } catch (\Exception $th) {
            DB::rollback();
            echo $th;
            Alert::toast('Something Went Wrong!!', 'error');
            return redirect()->route('employee.index');
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCompanyDepartments(Request $request): JsonResponse
    {
        $input = $request->all();
        $companyId = $input['companyId'];

        $companyDepartments = CompanyDepartment::whereCompanyId($companyId)->get()->pluck('department_id')->toArray();
        $departments = Department::whereIn('id', $companyDepartments)->get();

        if ($departments->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'departments' => $departments
            ]);
        } else {
            return response()->json([
                'status' => 'no_department',
            ]);
        }
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $cardHeader = 'Edit employee: ' . $employee->name;
            $companies = Company::all();
            $companyDepartments = CompanyDepartment::whereCompanyId($employee->company_id)->get()->pluck('department_id')->toArray();
            $departments = Department::whereIn('id', $companyDepartments)->get();

            $departmentIds = [];
            foreach ($employee->departments as $department) {
                $departmentIds[] = $department->department_id;
            }
            return view('employee.edit', compact('cardHeader', 'employee', 'companies', 'departments', 'departmentIds'));
        } else {
            Alert::toast('Employee not found.', 'error');
            return redirect()->route('employee.index');
        }
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'max:255', Rule::unique('employees')->ignore($employee)],
            'contact' => 'required',
            'designation' => 'required',
            'company' => 'required',
        ]);

        $input = $request->all();

        //begin db transaction
        DB::beginTransaction();
        try {
            $employee->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'contact' => $input['contact'],
                'designation' => $input['designation'],
                'company_id' => $input['company'],
            ]);

            //remove all departments
            EmployeeDepartment::whereEmployeeId($id)->delete();
            if (array_key_exists('departments', $input)) {
                //make new rows for comapny and departments
                foreach ($input['departments'] as $department) {
                    EmployeeDepartment::create([
                        'employee_id' => $id,
                        'department_id' => $department
                    ]);
                }
            }
            DB::commit();
            Alert::toast('Employee updated!', 'success');
            return redirect()->route('employee.index');
        } catch (\Exception $th) {
            DB::rollback();
            echo $th;
            Alert::toast('Something Went Wrong!!', 'error');
            return redirect()->route('employee.index');
        }
    }

    public function destroy(Request $request): JsonResponse
    {
        $input = $request->all();
        $employeeId = $input['employeeId'];
        $employee = Employee::find($employeeId);
        if ($employee) {
            $employee->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Sorry, there was an error'
            ]);
        }
    }
}
