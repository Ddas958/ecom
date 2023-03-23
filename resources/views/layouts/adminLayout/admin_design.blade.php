<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard"/>
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template"/>
    <meta name="robots" content="noindex,nofollow" />
    <title>Matrix Admin Lite Free Versions Template by WrapPixel</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}"/>
    <link href="{{ asset('/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet" />
    <link href="{{ asset('/dist/css/style.min.css') }}" rel="stylesheet" />
    <link href=".{{ asset('/assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
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
        <!-- Page wrapper  -->
        <div class="page-wrapper">
          <!-- Bread crumb and right sidebar toggle -->
          <div class="page-breadcrumb">
            <div class="row">
              <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ms-auto text-end">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
          <!-- End Bread crumb and right sidebar toggle -->
          @include('flash-message')
          @yield('content')
          @include('layouts.adminLayout.admin_footer')
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- All Jquery -->
    <script src="{{ asset('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('/assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
   
    <script>
      // Basic Example with form
      var form = $("#example-form");
      form.validate({
        errorPlacement: function errorPlacement(error, element) {
          element.before(error);
        },
        rules: {
          confirm_password: {
            equalTo: "#new_password",
          },
        },
      });
    </script>
    <script src="{{ asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <!-- <script src="{{ asset('/dist/js/waves.js') }}"></script> -->
    <!--Menu sidebar -->
    <script src="{{ asset('/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('/dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <!-- <script src="{{ asset('/assets/libs/flot/excanvas.js') }}"></script> -->
    <!-- <script src="{{ asset('/assets/libs/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/assets/libs/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('/assets/libs/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('/assets/libs/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('/assets/libs/flot/jquery.flot.crosshair.js') }}"></script> -->
    <!-- <script src="{{ asset('/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script> -->
    <!-- <script src="{{ asset('/dist/js/pages/chart/chart-page-init.js') }}"></script> -->
    
  </body>
</html>
