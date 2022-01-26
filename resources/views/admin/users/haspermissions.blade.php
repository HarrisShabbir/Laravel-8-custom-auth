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
                    <h4 class="card-title">User [ {{ $user->name }} ] Has Permissions</h4>
                   <a href="javascript:;" class="btn btn-primary checkAll" onclick='check()'>Check All</a>
                </div>

                @if (Session::has('message'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('message')}}
                </div>
                @endif

                <form action="{{ route('user.haspermissionupdate') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
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
                                @php $checked = ""; @endphp    
                                @foreach($userPermissions as $userPermission)
                                    @if($permission->id == $userPermission->id)
                                        @php 
                                            $checked = "checked";
                                        @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <th>{{$permission->name}}</th>
                                    <th>{{$permission->guard_name}}</th>
                                    <th>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input permissionCheckBox" type="checkbox" name="UserPermissionIDs[]" value="{{ $permission->id }}"
                                            {{ $checked }}>
                                        </div>
                                    </th>
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
                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Save</button>                
                </form>
            </div>
        </div>
    </div>
</section>
<!--/ Responsive Datatable -->
@extends('admin.roles.modal')
@push('scripts')
<script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
<script src="{{ asset('admin/js/scripts/tables/table-datatables-advanced.js')}}"></script>
<script>
    function check(){  
       var ele=document.getElementsByName('UserPermissionIDs[]');  
       for(var i=0; i<ele.length; i++){  
           if(ele[i].type=='checkbox')  
               ele[i].checked=true;  
       }  
   }
</script>
@endpush
@endsection