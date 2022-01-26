@extends('admin.layouts.app')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add User</h4>
                                </div>
                                <div class="card-body">
                                <form class="form" action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Name</label>
                                                    <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="name" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-column">Email</label>
                                                    <input type="email" id="email-id-column" class="form-control" name="email" placeholder="Email" />
                                                </div>
                                            </div>
                                            <div class="mb-1 col-md-6 col-12">
                                                <label class="form-label" for="basicSelect">Select Role</label>
                                                <select class="form-select" id="basicSelect" name="role">
                                                    @foreach ($roles as $role)
                                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                                    @endforeach    
                                                </select>
                                            </div>
                                            @can('user_add')
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            </div>    
                                            @endcan
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->
@endsection