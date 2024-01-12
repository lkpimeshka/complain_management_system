<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aptinex IOT') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">

    <link rel="stylesheet" type="text/css" href="{{asset('select2/dist/css/select2.min.css')}}">

    <!-- custome css  -->
    <link href="/css/myStyles.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link href="{{ asset('plugins/adminlte/css/adminlte.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/ijaboCropTool.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">

    <!-- DataTables styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('select2/dist/js/select2.min.js')}}" type="text/javascript"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('layouts/navbar')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

                @include('layouts/sidebar-logo')

            <!-- Sidebar -->
            <div class="sidebar">

                @include('layouts/sidebar-header')
                @include('layouts/sidebar-menu')

            </div>
            <!-- /.sidebar -->
        </aside>

        @include('layouts/content')
        @include('layouts/footer')
    </div>
    <!-- REQUIRED SCRIPTS -->
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/adminlte/js/adminlte.js') }}"></script>

    <!-- DataTables scripts -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            new DataTable('#datatable', {
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                }
            });
        });
    </script>

    <!-- Other scripts -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.printPage.js') }}" defer></script>
    <script src="{{ asset('js/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "3000",
            "timeOut": "3000",
            "extendedTimeOut": "3000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    @yield('script')
</body>
</html>
