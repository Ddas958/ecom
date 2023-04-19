<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="admin dashboard"/>
    <meta name="description" content="Matrix Admin"/>
    <meta name="robots" content="noindex,nofollow" />
    <title>Laravel Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}"/>
    <link href="{{ asset('/assets/css/backend_css/flot/css/float-chart.css') }}" rel="stylesheet" />
    <link href="{{ asset('/dist/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/backend_css/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{ asset('/assets/extra-libs/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/backend_css/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  </head>

  <body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('layouts.adminLayout.admin_header')
        @include('layouts.adminLayout.admin_sidebar')
        @yield('content')
        @include('layouts.adminLayout.admin_footer')
    </div>
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- All Jquery -->
    <script src="{{ asset('/assets/js/backend_js/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/js/backend_js/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('/assets/js/backend_js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('/assets/js/backend_js/jquery/dist/form-validation.js')}}"></script>
    <script src="{{ asset('/assets/js/backend_js/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/js/backend_js/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset('/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/js/backend_js/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $("#zero_config").DataTable();
    </script>
    <!--Menu sidebar -->
    <script src="{{ asset('/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('/dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript --> 
  </body>
</html>
