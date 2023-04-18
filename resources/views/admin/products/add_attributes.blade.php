@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Product Attributes</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/admin/view-products')}}">Products</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product attributes</a></li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <div class="container-fluid">
        <div class="card">
        <div class="card-body wizard-content">
            <h4 class="card-title">Add Product Attributes</h4>
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{!! session('error') !!}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif   
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{!! session('success') !!}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form enctype="multipart/form-data" class="mt-4" method="post" action="{{ url('/admin/add-attributes/'.$productDetails->id) }}" name="add_product" id="add_product" novalidate="novalidate"> 
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                <label class="control-label">Product Name</label>
                <input type="text" class="required form-control" name="product_name" id="product_name" value="{{$productDetails->product_name}}">
                <label class="control-label">Product Code</label>
                <input type="text" class="required form-control" name="product_code" id="product_code" value="{{$productDetails->product_code}}">
                <label class="control-label">Product Color</label>
                <input type="text" class="required form-control" name="product_color" id="product_color" value="{{$productDetails->product_color}}">
                <br>
                <div class="field_wrapper form-group row">
                    <input class="form-control" required title="Required" type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;">
                    <input class="form-control" required title="Required" type="text" name="size[]" id="size" placeholder="Size" style="width:120px;">
                    <input class="form-control" required title="Required" type="text" name="price[]" id="price" placeholder="Price" style="width:120px;"> 
                    <input class="form-control" required title="Required" type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px;">
                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                </div>
                <br>
                <input type="submit" class="btn btn-md btn-primary  required " value="Add Attribute">
            </form>
        </div>
        </div>
    </div>
</div>
@endsection