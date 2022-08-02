<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $cardHeader = 'Departments';
        return view('department.index', compact('departments','cardHeader'));
    }
}
