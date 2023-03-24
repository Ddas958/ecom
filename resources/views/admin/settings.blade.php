@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Admin Settings</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="card">
        <div class="card-body wizard-content">
            <h4 class="card-title">Update Password</h4>
            <!-- <h6 class="card-subtitle">Update Password</h6> -->
            @include('flash-message')
            <form name="password_validate" id="password_validate"  method="post" action="{{url('admin/updatePwd')}}" class="mt-4">
                {{ csrf_field()}}
                <div>
                    <section>
                    <label for="userName">Current Password</label>
                    <input id="current_pwd" name="current_pwd" type="text" class="required form-control"/>
                    <span id="chkPwd"></span>
                    <label for="password">New Password *</label>
                    <input id="new_pwd" name="new_pwd" type="text" class="required form-control"/>
                    <label for="confirm">Confirm Password *</label>
                    <input id="confirm_pwd" name="confirm_pwd" type="text" class="required form-control" />
                    </br>
                    <input type="submit" class="btn btn-primary" value="Update Password">
                    </section>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<!-- End Page wrapper  -->

@endsection
