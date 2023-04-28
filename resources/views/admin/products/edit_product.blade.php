@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="page-wrapper">
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit Product</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/admin/view-products')}}">Products</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Product</a></li>
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
            <h4 class="card-title">Edit Product</h4>
            <form enctype="multipart/form-data" class="mt-4" method="post" action="{{ url('/admin/edit-product/'.$productsDetail->id) }}" name="edit_product" id="edit_product" novalidate="novalidate"> 
                {{ csrf_field() }}
                <label class="control-label">Under Category</label>
                <select name="category_id" class="select2 form-select form-control" id="category_id">  
                <?php echo $categories_dropdown; ?>
                </select>
                <label class="control-label">Product Name</label>
                <input type="text" class="required form-control" name="product_name" id="product_name" value="{{$productsDetail->product_name}}">
                <label class="control-label">Product Code</label>
                <input type="text" class="required form-control" name="product_code" id="product_code" value="{{$productsDetail->product_code}}">
                <label class="control-label">Product Color</label>
                <input type="text" class="required form-control" name="product_color" id="product_color" value="{{$productsDetail->product_color}}">
                <label class="control-label">Description</label>
                <textarea name="description" class="form-control" id="description">{{$productsDetail->description}}</textarea>
                <label class="control-label">Care</label>
                <textarea name="care" class="form-control" id="care">{{$productsDetail->care}}</textarea>
                <label class="control-label">Price</label>
                <input type="text" class="required form-control" name="price" id="price" value="{{$productsDetail->price}}">
                <label class="control-label">Image</label><br>
                @if(!empty($productsDetail->image))
                <img src="{{asset('assets/images/backend_images/products/small/'.$productsDetail->image)}}" alt="" width="50" class="img-responsive">
               | <a href="{{url('/admin/delete-product-image/'.$productsDetail->id)}}">delete</a>
                <input type="hidden" name="current_image" value="{{$productsDetail->image}}">
                @endif
                <input type="file" class="form-control mt-3" name="image" id="image"></br>
                <input type="submit" class="btn btn-md btn-primary  required " value="Update Product">
            </form>
        </div>
        </div>
    </div>
</div>
@endsection