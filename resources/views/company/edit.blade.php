@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('company.update',$company->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('company.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('company.js')
@endsection
