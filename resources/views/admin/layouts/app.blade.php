<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Admin | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->

    @include('admin.partials.stylesheets')
	
    @stack('styles')
    <style>
        .alert-message {
            display: none;
        }
    </style>
    <style>
        .modal.left .modal-dialog,
        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 320px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content,
        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.left .modal-body,
        .modal.right .modal-body {
            padding: 15px 15px 80px;
        }

        /*Left*/
        .modal.left.fade .modal-dialog {
            left: -320px;
            -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
            -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        .modal.left.fade.in .modal-dialog {
            left: 0;
        }

        /*Right*/
        .modal.right.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }

        .modal-header {
            border-bottom-color: #EEEEEE;
            background-color: #FAFAFA;
        }
        .alert-success.alert-dismissible {
            position: fixed;
            top: 10px;
            right: 0;
            transition: all 2000ms;
            z-index: 9999; 
            overflow: hidden;
        }
        .alert-danger.alert-dismissible {
            position: fixed;
            top: 10px;
            right: 0;
            transition: all 2000ms;
            z-index: 9999; 
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    @include('admin.partials.topbar')
    <div class="containers">
        <div id="page-wrapper">

            @yield('content')
        </div>
    </div>
    @include('admin.partials.footer')
</div>
@include('admin.partials.scripts')
@stack('scripts')
<script>
    $(document).ready(function(){
        $(".alert-success").delay(5000).slideUp(300);
    });
    $(document).ready(function(){
        $(".alert-danger").delay(5000).slideUp(300);
    });
</script>
@yield('script')
</body>
</html>