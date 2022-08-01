<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin_dashboard');
    }
}
