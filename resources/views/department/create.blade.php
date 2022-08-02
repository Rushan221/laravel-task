@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('department.store')}}" method="POST">
                    @csrf
                    @include('department.form')
                </form>
            </div>
        </div>
    </div>
@endsection
