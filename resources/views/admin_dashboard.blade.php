@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3>Welcome, <strong>{{ Auth::user()->name }}</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h3>Companies</h3></div>
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h1>{{$companyCount}}</h1>
                            <a href="{{route('company.index')}}" class="dashboard-link">More Details <i
                                    class="fa fa-circle-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h3>Departments</h3></div>
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h1>{{$departmentCount}}</h1>
                            <a href="{{route('department.index')}}" class="dashboard-link">More Details <i
                                    class="fa fa-circle-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h3>Employees</h3></div>
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h1>{{$employeeCount}}</h1>
                            <a href="{{route('employee.index')}}" class="dashboard-link">More Details <i
                                    class="fa fa-circle-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
