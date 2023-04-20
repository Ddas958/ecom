<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Matrix admin lite dashboard bootstrap 5 dashboard template"/>
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Matrix Admin Lite Free Versions Template by WrapPixel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/favicon.png') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('/dist/css/style.min.css') }}" rel="stylesheet" />
    <style>
        .auth-wrapper {
        min-height: 100vh;
    }
    </style>
  </head>

  <body>
    <div class="main-wrapper">
      <!-- Preloader - style you can find in spinners.css -->
      <div class="preloader">
        <div class="lds-ripple">
          <div class="lds-pos"></div>
          <div class="lds-pos"></div>
        </div>
      </div>
      <!-- Preloader - style you can find in spinners.css -->
      <!-- Login box.scss -->
      <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
          <!-- @if(Session::has('flash_message_error'))
          <div class="alert alert-danger alert-block ">
          <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>   
                <strong>{!! session('flash_message_error') !!}</strong>
          </div>
          @endif -->
          @include('flash-message')
          <div id="loginform">
            <div class="text-center pt-3 pb-3">
              <span class="db"><img src="{{ asset('/assets/images/logo.png') }}" alt="logo" /></span>
            </div>
            <!-- Form -->
            <form class="form-horizontal mt-3" id="loginform" method="POST" action="{{ url('admin') }}">
            @csrf
              <div class="row pb-4">
                <div class="col-12">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1">
                            <i class="mdi mdi-account fs-4"></i></span>
                    </div>
                    <input type="email"  name="email" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"  required="" />
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-warning text-white h-100" id="basic-addon2">
                        <i class="mdi mdi-lock fs-4"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="" />
                  </div>
                </div>
              </div>
              <div class="row border-top border-secondary">
                <div class="col-12">
                  <div class="form-group">
                    <div class="pt-3">
                      <button class="btn btn-info" id="to-recover" type="button">
                        <i class="mdi mdi-lock fs-4 me-1"></i> Lost password?
                      </button>
                      <input type="submit" class="btn btn-success float-end text-white" value="Login">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div id="recoverform" style="display:none;">
            <div class="text-center">
              <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
            </div>
            <div class="row mt-3">
              <!-- Form -->
              <form class="col-12" action="index.html">
                <!-- email -->
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="mdi mdi-email fs-4"></i></span>
                  </div>
                  <input type="text" class="form-control form-control-lg" placeholder="Email Address"               aria-label="Username" aria-describedby="basic-addon1"/>
                </div>
                <!-- pwd -->
                <div class="row mt-3 pt-3 border-top border-secondary">
                  <div class="col-12">
                    <a class="btn btn-success text-white" href="#" id="to-login" name="action">Back To Login</a>
                    <button class="btn btn-info float-end" type="button" name="action">Recover</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('/assets/js/frontend_js/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/assets/js/frontend_js/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
      $(".preloader").fadeOut();
      // ==============================================================
      // Login and Recover Password
      // ==============================================================
      $("#to-recover").on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
      });
      $("#to-login").click(function () {
        $("#recoverform").hide();
        $("#loginform").fadeIn();
      });
    </script>
  </body>
</html>
