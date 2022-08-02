@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('employee.update',$employee->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('employee.form')
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('employee.js')
@endsection
