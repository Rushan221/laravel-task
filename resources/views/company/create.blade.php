@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('company.store')}}" method="POST">
                    @csrf
                    @include('company.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('company.common')
@endsection

@section('js')
    @include('company.js')
@endsection
