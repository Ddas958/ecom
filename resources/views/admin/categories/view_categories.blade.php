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
                  <h5 class="card-title">Product Categories</h5>
                  @include('flash-message')
                    <div class="table">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="zero_config" class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th>Category ID</th>
                                            <th>Category Name</th>
                                            <th>Parent Category</th>
                                            <th>Category URL</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                   
                                        @foreach($categories as $category)                                   
                                        <tr role="row" class="odd">
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->getParentsNames()}}</td>
                                            <td>{{$category->url}}</td>
                                            <td><a href="{{url('admin/edit-category/'.$category->id)}}" class="btn btn-cyan btn-sm text-white">Edit</a> <a id="delCat" rel="{{$category->id}}" rel1="delete-category" href="javascript:" class="delCat btn btn-danger btn-sm text-white">Delete</a></td>
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