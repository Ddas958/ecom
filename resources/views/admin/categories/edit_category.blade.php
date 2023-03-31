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
                        <li class="breadcrumb-item "><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/admin/view-categories')}}">Categories</a></li>
                        
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
            <h4 class="card-title">Edit Category</h4>
            <form name="edit_category" id="edit_category"  method="post" action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}" class="mt-4">
                {{ csrf_field()}}
                <div>
                    <section>
                    <label for="userName">Category Name</label>
                    <input type="text" name="category_name" id="category_name" class="required form-control" value="{{ $categoryDetails->name }}">
                    <label for="Category Level">Category Level</label>
                    <select name="parent_id" class="select2 form-select required form-control">
                        <option value="0">Main Category</option>
                        @if(isset($levels))
                        @foreach($levels as $val)
                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                        @endif
                    </select>
                   
                    <label for="Description">Description</label>
                    <textarea name="description" id="description" class="required form-control">{{ $categoryDetails->description }}</textarea>
                    <label for="URL">URL</label>
                    <input type="text" name="url" id="url" class="required form-control" value="{{ $categoryDetails->url }}">
                    </br>
                    <input type="submit" class="btn btn-primary" value="Update Category">
                    </section>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>


@endsection