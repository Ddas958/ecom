@extends('layouts.adminLayout.admin_design')
@section('content')
<style>
    .field_wrapper .form-control{
        display:inline;
    }
</style>
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
            <div class="card-body wizard-content col-md-9">
                <h4 class="card-title">Add Product Attributes</h4>
                @include('flash-message')
                <form enctype="multipart/form-data" class="mt-4" method="post" action="{{ url('/admin/add-attributes/'.$productDetails->id) }}" name="add_product" id="add_product" novalidate="novalidate"> 
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
                      <label for="fname" class="col-sm-3 text-end control-label col-form-label">Product Color</label>
                      <div class="col-sm-9">
                      <input type="text" class="required form-control" id="product_color" value="{{$productDetails->product_color}}" disabled>
                      </div>
                    </div>
                 
                    <div class="field_wrapper form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Product Attributes</label>
                        <div class="col-sm-9">
                            <input class="form-control" required title="Required" type="text" name="sku[]" id="sku" placeholder="SKU" style="width:100px;">
                            <input class="form-control" required title="Required" type="text" name="size[]" id="size" placeholder="Size" style="width:100px;">
                            <input class="form-control" required title="Required" type="text" name="price[]" id="price" placeholder="Price" style="width:100px;"> 
                            <input class="form-control" required title="Required" type="text" name="stock[]" id="stock" placeholder="Stock" style="width:100px;">
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary add_button" title="Add field">Add</a>
                        </div>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-md btn-primary  required " value="Add Attribute">
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Attributes</h5>
                <div class="table">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{url('/admin/edit-attributes/'.$productDetails->id)}}" method="post">
                            {{ csrf_field() }}
                            <table id="zero_config" class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr role="row">
                                        <th>Attribute ID</th>
                                        <th>SKU</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($productDetails['attributes'] as $attribute)                                   
                                    <tr role="row" class="odd">
                                        <td><input type="hidden" name="idAttr[]" value="{{ $attribute->id }}">{{ $attribute->id }}</td>
                                        <td>{{ $attribute->sku }}</td>
                                        <td>{{ $attribute->size }}</td>
                                        <td><input type="text" name="price[]" value="{{ $attribute->price }}"></td>
                                        <td><input type="text" name="stock[]" value="{{ $attribute->stock }}"></td>
                                        <td class="center">
                                           <input type="submit" value="update" class="btn btn-primary btn-mini">
                                            <a href="javascript:void(0)" rel="{{$attribute->id}}" rel1="delete-attribute" class="delRecord btn btn-danger btn-mini">Delete</a>
                                        </td>
                                    </tr>
                                   
                                    @endforeach
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection