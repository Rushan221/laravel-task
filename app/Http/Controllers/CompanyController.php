<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyDepartment;
use App\Models\Department;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $cardHeader = 'Companies';
        return view('company.index', compact('companies', 'cardHeader'));
    }

    public function create()
    {
        $cardHeader = 'Create a company';
        $departments = Department::all();
        return view('company.create', compact('cardHeader', 'departments'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'contact' => 'required'
        ]);

        $input = $request->all();
        //begin db transaction
        DB::beginTransaction();
        try {
            $company = Company::create([
                'name' => $input['name'],
                'location' => $input['location'],
                'contact' => $input['contact']
            ]);

            foreach ($input['departments'] as $department) {
                CompanyDepartment::create([
                    'company_id' => $company->id,
                    'department_id' => $department
                ]);
            }

            DB::commit();

            Alert::toast('Bank Created!', 'success');
            return redirect()->route('company.index');
        } catch (\Exception $th) {
            DB::rollback();
            echo $th;
            Alert::toast('Something Went Wrong!!', 'error');
            return redirect()->route('company.index');
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $company = Company::find($id);
        foreach ($company->departments as $department) {
            $departmentIds[] = $department->department_id;
        }
        $departments = Department::all();
        if ($company) {
            $cardHeader = 'Edit Company: ' . $company->name;
            return view('company.edit', compact('company', 'departments', 'cardHeader', 'departmentIds'));
        } else {
            Alert::toast('Company not found.', 'error');
            return redirect()->route('company.index');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'contact' => 'required'
        ]);

        $input = $request->all();
        $company = Company::find($id);

        if ($company) {
            DB::beginTransaction();
            try {
                $updatedCompany = $company->update([
                    'name' => $input['name'],
                    'location' => $input['location'],
                    'contact' => $input['contact']
                ]);

                //remove all departments
                CompanyDepartment::whereCompanyId($id)->delete();
                //make new rows for comapny and departments
                foreach ($input['departments'] as $department) {
                    CompanyDepartment::create([
                        'company_id' => $id,
                        'department_id' => $department
                    ]);
                }
                DB::commit();
                Alert::toast('Company edited successfully.', 'success');
            }catch (\Exception $th) {
                DB::rollback();
                echo $th;
                Alert::toast('Something Went Wrong!!', 'error');
            }
        } else {
            Alert::toast('Company not found.', 'error');
        }
        return redirect()->route('company.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $input = $request->all();
        $companyId = $input['companyId'];
        $company = Company::find($companyId);
        if ($company) {
            $company->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Company deleted successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Sorry, there was an error'
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addDepartment(Request $request): JsonResponse
    {
        $input = $request->all();
        parse_str($input['formData'], $formInput);
        $validate = Validator::make($formInput, [
            'name' => 'required',
        ], [
            'name.required' => 'Department  name is required',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return response()->json([
                'status' => 'failed',
                'errors' => $errors
            ]);
        } else {
            $department = Department::create([
                'name' => $formInput['name'],
            ]);
            return response()->json([
                'status' => 'success',
                'department' => $department
            ]);
        }
    }
}
