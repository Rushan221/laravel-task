@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3>{{$cardHeader}}</h3>
                            <a href="{{route('company.create')}}" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->location}}</td>
                                    <td>{{$company->contact}}</td>
                                    <td class="d-flex align-content-center">
                                        <a href="{{ route('company.edit',$company->id) }}"
                                           class="btn btn-primary btn-sm"
                                           title="Edit"><i class="fa fa-pen-to-square"></i></a>&nbsp;
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-btn"
                                           rel="{{$company->id}}"><i
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

@section('js')
    <script>
        $(document).ready(function () {
            $('.delete-btn').click(function () {
                let deleteBtn = $(this);
                let companyId = deleteBtn.attr('rel');
                Swal.fire({
                    title: 'Do you want to delete the Company?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('company.destroy') }}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                companyId
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    deleteBtn.closest('tr').fadeOut(1000);
                                    Swal.fire(response.message, '', 'success')
                                } else {
                                    Swal.fire(response.message, '', 'warning')
                                }
                            },
                            error: function (err) {
                                Swal.fire('Internal server error', '', 'error')
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
