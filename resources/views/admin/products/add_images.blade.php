@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Product Images</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/admin/view-products')}}">Products</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product images</a></li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body wizard-content col-md-9">
                <h4 class="card-title">Add Product Images</h4>
                @include('flash-message')
                <form enctype="multipart/form-data" class="mt-4" method="post" action="{{ url('/admin/add-images/'.$productDetails->id) }}" name="add_product" id="add_product" novalidate="novalidate"> 
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Product Name</label>
                      <div class="col-sm-9">
                      <input type="text" class="required form-control" id="product_name" value="{{$productDetails->product_name}}" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Product Code</label>
                      <div class="col-sm-9">
                      <input type="text" class="required form-control" id="product_code" value="{{$productDetails->product_code}}" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Images" class="col-sm-3 text-end control-label col-form-label">Product Images</label>
                      <div class="col-sm-9">
                      <input type="file" class="required form-control" id="image" name="image[]" multiple="multiple">
                      </div>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-md btn-primary  required " value="Add Images">
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Images</h5>
                <div class="table">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="zero_config" class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr role="row">
                                        <th>ID</th>
                                        <th>Product ID</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($productImages as $image)                                   
                                    <tr role="row" class="odd">
                                        <td>{{ $image->id }}</td>
                                        <td>{{ $image->product_id }}</td>
                                        <td><img src="{{ asset('assets/images/backend_images/products/small/'.$image->image) }}" style="width:100px;"></td>
                                        <td class="center"><a href="javascript:void(0)" rel="{{$image->id}}" rel1="delete-product-images" class="delRecord btn btn-danger btn-mini">Delete</a></td>
                                    </tr>
                                   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection