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
                                    <h4 class="card-title">Update User</h4>
                                </div>
                                <div class="card-body">
                                <form class="form" action="{{ route('user.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Name</label>
                                                    <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="name" value="{{$user->name}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-column">Email</label>
                                                    <input type="email" id="email-id-column" class="form-control" name="email" placeholder="Email" value="{{$user->email}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email-id-column">Role </label>
                                                    <select name="role" id="" class="form-select">
                                                        @foreach ($roles as $role)
                                                            @php $selected = ""; @endphp
                                                            @if($userRoleName == $role->name)
                                                                @php $selected = "Selected"; @endphp
                                                            @endif
                                                            <option value="{{$role->name}}" {{$selected}}>{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @can('user_edit')
                                                
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Update</button>
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