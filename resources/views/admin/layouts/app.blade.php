<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard</title>
    <link rel="apple-touch-icon" href="{{ asset('admin/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/extensions/sweetalert2.min.css')}}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/semi-dark-layout.css')}}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/extensions/ext-component-toastr.css')}}">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
    @stack('style')
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
{{--    @extends('admin.layouts.header')--}}
    @include('admin.layouts.header')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
{{--    @extends('admin.layouts.sidebar')--}}
    @include('admin.layouts.sidebar')
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        User
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @extends('admin.layouts.footer')
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{ asset('admin/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('admin/vendors/js/extensions/polyfill.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <!-- END: Page JS-->

    @stack('scripts')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        $(".SystemLang").on("click",function(){
            var lang = $(this).data("language");
            window.location.href = "{{ route('changeLang') }}" + "?lang="+lang;
        });

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            "closeMethod": "slideUp",
            "escapeHtml": true
        };

    </script>
    @if(Session::has('success'))
        @php
            $SessionType = "success";
            $SessionMessage = Session::get('success');
            $SessionTitle = Session::get('title');
        @endphp
    @elseif(Session::has('error'))
        @php
            $SessionType = "error";
            $SessionMessage = Session::get('error');
        @endphp
    @elseif(Session::has('info'))
        @php
            $SessionType = "info";
            $SessionMessage = Session::get('info');
        @endphp
    @elseif(Session::has('warning'))
        @php
            $SessionType = "warning";
            $SessionMessage = Session::get('warning');
        @endphp
    @endif

    @if(isset($SessionType) && isset($SessionMessage))
        @if(isset($SessionTitle))
            <script type="text/javascript">
                $(document).ready( function () {
                    toastr["{{ $SessionType }}"]("{{ $SessionMessage }}","{{ $SessionTitle }}");
                });
            </script>
        @else
            <script type="text/javascript">
                $(document).ready( function () {
                    toastr["{{ $SessionType }}"]("{{ $SessionMessage }}");
                });
            </script>
        @endif
    @endif
</body>
<!-- END: Body-->

</html>
