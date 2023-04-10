@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Categories</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/admin/view-categories')}}">View Categories</a></li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <div class="container-fluid">
        <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Products</h5>
                  @include('flash-message')
                    <div class="table">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="zero_config" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th>Product ID</th>
                                            <!-- <th>Category ID</th> -->
                                            <th>Product Name</th>
                                            <th>Category Name</th>
                                            <!-- <th>Product Code</th> -->
                                            <th>Product Color</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($products as $product)                                   
                                        <tr role="row" class="odd">
                                            <td>{{ $product->id }}</td>
                                            <!-- <td>{{ $product->category_id }}</td> -->
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <!-- <td>{{ $product->product_code }}</td> -->
                                            <td>{{ $product->product_color }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                @if(!empty($product->image))
                                                <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" style="width:50px;">
                                                @endif
                                            </td>
                                            <td class="center"><a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini">Edit</a> <a id="delCat" href="{{ url('/admin/delete-product/'.$product->id) }}" class="btn btn-danger btn-mini">Delete</a></td>
                                        </tr>
                                        <div id="myModal{{ $product->id }}" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>{{ $product->product_name }} Full Details</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>Product ID: {{ $product->id }}</p>
                                                <p>Category ID: {{ $product->category_id }}</p>
                                                <p>Product Code: {{ $product->product_code }}</p>
                                                <p>Product Color: {{ $product->product_color }}</p>
                                                <p>Price: {{ $product->price }}</p>
                                                <p>Fabric: </p>
                                                <p>Material: </p>
                                                <p>Description: {{ $product->description }}</p>
                                            </div>
                                        </div>
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