@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3>{{$cardHeader}}</h3>
                            <a href="{{route('department.create')}}" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$department->name}}</td>
                                    <td>{{$department->comapny->name}}</td>
                                    <td class="d-flex align-content-center">
                                        <a href="{{ route('company.edit',$department->id) }}"
                                           class="btn btn-primary btn-sm"
                                           title="Edit"><i class="fa fa-pen-to-square"></i></a>&nbsp;
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-btn"
                                           rel="{{$department->id}}"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
