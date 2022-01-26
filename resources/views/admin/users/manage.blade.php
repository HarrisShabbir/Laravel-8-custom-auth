@extends('admin.layouts.app')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')

@section('content')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
@endpush


<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bolder mb-75">21,459</h3>
                    <span>Total Users</span>
                </div>
                <div class="avatar bg-light-primary p-50">
                    <span class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-4"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bolder mb-75">4,567</h3>
                    <span>Paid Users</span>
                </div>
                <div class="avatar bg-light-danger p-50">
                    <span class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus font-medium-4"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bolder mb-75">19,860</h3>
                    <span>Active Users</span>
                </div>
                <div class="avatar bg-light-success p-50">
                    <span class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check font-medium-4"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bolder mb-75">237</h3>
                    <span>Pending Users</span>
                </div>
                <div class="avatar bg-light-warning p-50">
                    <span class="avatar-content">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-x font-medium-4"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="18" y1="8" x2="23" y2="13"></line><line x1="23" y1="8" x2="18" y2="13"></line></svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Responsive Datatable -->
<section id="responsive-datatable">
    <div class="row mt-1">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Users Details</h4>
                    @can('user_add')
                    <a href="{{route('user.create')}}" class="btn btn-info" style="float: right">Add User</a>
                    @endcan
                    {{-- <button class="btn btn-info" style="float: right">Add User</button> --}}
                </div>

                @if (Session::has('message'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif


                <div class="card-datatable">
                    <table class="dt-responsive table">
                        <thead>
                            <tr>  
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th>{{$user->name}}</th>
                                    <th>{{$user->email}}</th>
                                    <th>
                                        @can('user_edit')
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary">Edit</a>                                            
                                        @endcan
                                        @can('user_delete')
                                        <a href="{{route('user.destroy', $user->id)}}" class="btn btn-danger">Delete</a>
                                        @endcan
                                        @can('permission_view')
                                        <a href="{{route('user.permissions', $user->id)}}" class="btn btn-info">Permissions</a>                                            
                                        @endcan

                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Responsive Datatable -->

@push('scripts')
<script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
<script src="{{ asset('admin/js/scripts/tables/table-datatables-advanced.js')}}"></script>
@endpush
@endsection