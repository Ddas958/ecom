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
                        <li class="breadcrumb-item active"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/admin/dashboard')}}">Categories</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/admin/dashboard')}}">Add Category</a></li>
                        
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
            <h4 class="card-title">Add Category</h4>
            <!-- <h6 class="card-subtitle">Update Password</h6> -->
            @include('flash-message')
            <form name="add_category" id="add_category"  method="post" action="{{ url('/admin/add-category') }}" class="mt-4">
                {{ csrf_field()}}
                <div>
                    <section>
                    <label for="userName">Category Name</label>
                    <input type="text" name="category_name" id="category_name" class="required form-control">
                    <label for="Category Level">Category Level</label>
                    <select name="parent_id" class="required form-control">
                        <option value="0">Main Category</option>
                        @if(isset($levels))
                        @foreach($levels as $val)
                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                        @endif
                    </select>
                   
                    <label for="Description">Description</label>
                    <textarea name="description" id="description" class="required form-control"></textarea>
                    <label for="URL">URL</label>
                    <input type="text" name="url" id="url" class="required form-control">
                    </br>
                    <input type="submit" class="btn btn-primary" value="Add Category">
                    </section>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>


@endsection