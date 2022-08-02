<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $cardHeader = 'Departments';
        return view('department.index', compact('departments', 'cardHeader'));
    }

    public function create()
    {
        $cardHeader = 'Create a Department';
        return view('department.create', compact('cardHeader'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);
        $input = $request->all();

        $department = Department::create([
            'name' => $input['name'],
        ]);

        if ($department) {
            Alert::toast('Department Created!', 'success');
        } else {
            Alert::toast('Something Went Wrong!!', 'error');
        }
        return redirect()->route('department.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $department = Department::find($id);
        if ($department) {
            $cardHeader = 'Edit Department: ' . $department->name;
            return view('department.edit', compact('department', 'cardHeader'));
        } else {
            Alert::toast('Department not found.', 'error');
            return redirect()->route('department.index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();
        $department = Department::find($id);
        if ($department) {
            $updatedDepartment = $department->update([
                'name' => $input['name'],
            ]);

            if ($updatedDepartment) {
                Alert::toast('Department edited successfully.', 'success');
            } else {
                Alert::toast('Something Went Wrong!!', 'error');
            }
        } else {
            Alert::toast('Department not found.', 'error');
        }
        return redirect()->route('department.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $input = $request->all();
        $departmentId = $input['departmentId'];
        $department = Department::find($departmentId);
        if ($department) {
            $department->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Department deleted successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Sorry, there was an error'
            ]);
        }
    }
}
