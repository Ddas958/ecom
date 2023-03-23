@extends('layouts.adminLayout.admin_design')
@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="card">
    <div class="card-body wizard-content">
        <h4 class="card-title">Account</h4>
        <h6 class="card-subtitle"></h6>
        <form id="example-form" method="post" action="#" class="mt-5">
            <div>
                <section>
                <label for="userName">Current Password</label>
                <input id="password" name="password" type="text" class="required form-control"/>
                <label for="password">New Password *</label>
                <input id="new_password" name="new_password" type="text" class="required form-control"/>
                <label for="confirm">Confirm Password *</label>
                <input id="confirm_password" name="confirm_password" type="text" class="required form-control" />
                </br>
                <input type="submit" class="btn btn-primary" value="Update Password">
                </section>
            </div>
        </form>
    </div>
    </div>
</div>

@endsection
