@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('department.update',$department->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('department.form')
                </form>
            </div>
        </div>
    </div>
@endsection
