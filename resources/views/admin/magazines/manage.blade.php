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
                    {{-- {{ __('admin\facts.Facts') }} --}}
                    <h4 class="card-title">Magazines Details</h4>
                    {{-- @can('fact_add')
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createfact">
                        Add Fact
                       </button>
                    @endcan --}}

                    {{-- <a href="" class="btn btn-info" style="float: right">Add Role</a> --}}
                    {{-- <button class="btn btn-info" style="float: right">Add User</button> --}}
                </div>

                {{-- @if (Session::has('message'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('message')}}
                </div>
                @endif --}}

                <div class="card-datatable">
                    <table class="dt-responsive table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Phrase</th>
                                <th>Posts</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>File</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($magazines as $magazine)
                                <tr>
                                    <td>{{$magazine->title}}</td>
                                    <td>{{$magazine->phrase}}</td>       
                                    <td>{{$magazine->posts}}</td>
                                    <td>{{ date("l M, Y H:i A",strtotime($magazine->created_at)) }}</td>
                                    <td>
                                        @if($magazine->status == 1)
                                            <span class="badge badge-glow bg-success">Active</span>
                                        @else    
                                        <span class="badge badge-glow bg-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{$magazine->file}}" download>
                                            <i data-feather="download"></i>
                                        </a>
                                    </td>
                                    
                                    {{-- <th>
                                        @can('fact_edit')
                                        <a href="javascript:;" onclick="editFact({{$fact->id}})" class="btn btn-primary">Edit</a>
                                        @endcan
                                           
                                        @can('fact_delete')
                                        <a href="{{route('fact.destroy', $fact->id)}}" class="btn btn-danger delete">Delete</a>
                                        @endcan
                                    </th> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Phrase</th>
                                <th>Posts</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>File</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Responsive Datatable -->
{{-- @extends('admin.facts.modal') --}}
{{-- @extends('admin.roles.editRoleModal') --}}
@push('scripts')
<script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
<script src="{{ asset('admin/js/scripts/tables/table-datatables-advanced.js')}}"></script>

{{-- <script>

    (".delete").on('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Your record has been deleted.',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                });
            }
        });
    });

    function editFact(id){
        $.ajax({
            type:"GET",
            url: "{{ url('admin/fact/edit') }}/"+id,
            success:function(response){
                $("#FactID").val(response['id']);
                $("#FactTitle").val(response['title']);
                $("#FactContent").val(response['content']);
                $("#UpdateFact").modal('show');
            },
        });
    }
</script> --}}
@endpush
@endsection
