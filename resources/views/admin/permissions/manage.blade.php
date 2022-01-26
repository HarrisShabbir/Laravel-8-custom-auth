@extends('admin.layouts.app')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')

@section('content')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
@endpush

<!-- Responsive Datatable -->
<section id="responsive-datatable">
    <div class="row mt-1">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Permissions Details</h4>
                    {{-- {{route('user.create')}} --}}
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createpermission">
                     Add Permission
                    </button>
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
                                <th>Guard Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <th>{{$permission->name}}</th>
                                    <th>{{$permission->guard_name}}</th>
                                    {{-- @can() --}}
                                    <th>
                                        @can('permission_edit')
                                        <a href="javascript:;" onclick="editPermission({{$permission->id}})" class="btn btn-primary">Edit<a>                                            
                                        @endcan

                                        @can('permission_delete')
                                        <a href="{{route('permission.destroy', $permission->id)}}" class="btn btn-danger">Delete</a>
                                        @endcan
                                    </th>
                                    {{-- @endcan --}}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Guard Name</th>
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
@extends('admin.permissions.modal')
@push('scripts')
<script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
<script src="{{ asset('admin/js/scripts/tables/table-datatables-advanced.js')}}"></script>
<script>
    function editPermission(id){
        $.ajax({
            type:"GET",
            url: "{{ url('admin/permission/edit') }}/"+id,
            success:function(response){
                $("#PermissionID").val(response['id']);
                $("#PermissionName").val(response['name']);
                $("#GuardName").val(response['guard_name']);
                $("#updatepermission").modal('show');
            },
        });
    }
</script>
@endpush
@endsection