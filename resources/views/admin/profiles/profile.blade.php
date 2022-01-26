@extends('admin.layouts.app')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')

@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills mb-2">
                <!-- account -->
                <li class="nav-item">
                    <a class="nav-link" href="jaavascripts:;" id="accountbtn">
                        <i data-feather="user" class="font-medium-3 me-50"></i>
                        <span class="fw-bold">Account</span>
                    </a>
                </li>
                <!-- security -->
                <li class="nav-item">
                    <a class="nav-link " href="jaavascripts:;" id="securitybtn">
                        <i data-feather="lock" class="font-medium-3 me-50"></i>
                        <span class="fw-bold">Security</span>
                    </a>
                </li>
              
            </ul>


                        <!-- profile -->
                        <div class="card" id="account">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Profile Details</h4>
                            </div>
                            <div class="card-body py-2 my-25">
                                <!-- header section -->
                                @if (Session::has('message'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('message')}}
                                </div>
                                @endif
                                <!-- form -->
                                <form class="validate-form mt-2 pt-50" method="POST" action="{{route('profile.update')}}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountFirstName">First Name</label>
                                            <input type="text" class="form-control" id="accountFirstName" name="name" placeholder="John" value="{{$user->name}}" data-msg="Please enter first name" />
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountEmail">Email</label>
                                            <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="{{$user->email}}" />
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                        </div>
						<!-- profile end here  -->



                         <!-- security -->
            <div class="card" style="display: none" id="security">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body pt-1">
                    <!-- form -->
                    <form class="validate-form" method="POST" action="{{route('profile.updatepassword')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="account-old-password">Current password</label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input type="password" class="form-control" id="account-old-password" name="password" placeholder="Enter current password" data-msg="Please current password" />
                                    <div class="input-group-text cursor-pointer">
                                        <i data-feather="eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="account-new-password">New Password</label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input type="password" id="account-new-password" name="new_password" class="form-control" placeholder="Enter new password" />
                                    <div class="input-group-text cursor-pointer">
                                        <i data-feather="eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-1">
                                <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                                <div class="input-group form-password-toggle input-group-merge">
                                    <input type="password" class="form-control" id="account-retype-new-password" name="confirm_new_password" placeholder="Confirm your new password" />
                                    <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="fw-bolder">Password requirements:</p>
                                <ul class="ps-1 ms-25">
                                    <li class="mb-50">Minimum 8 characters long - the more, the better</li>
                                    <li class="mb-50">At least one lowercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                            </div>
                        </div>
                    </form>
                    <!--/ form -->
                </div>
            </div>
</div>
</div>
</section>

@push('scripts')
<script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
<script src="{{ asset('admin/js/scripts/tables/table-datatables-advanced.js')}}"></script>

<script>

$('#securitybtn').click(function(){
             $('#securitybtn').addClass('.active');
             $('#accountbtn').removeClass('.active');
        //    $(".event1").css("background-color", "black"); 
        //    $(".event2").css("background-color", "rgb(74, 74, 145)"); 
           $('#security').show();
           $('#account').hide();
        });
        $('#accountbtn').click(function(){
            //$(this).addClass('.active');
            //$('button.event1').removeClass('.active');
            // $(".event2").css("background-color", "black");
            // $(".event1").css("background-color", "rgb(74, 74, 145)"); 
            $('#account').show();
            $('#security').hide();
        });
        // $(".active").css("background-color", "black");


</script>


@endpush
@endsection