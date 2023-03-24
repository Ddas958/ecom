<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //print_r($data);die;
            $category = new Category;
            $category->name = $data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();
        }
        return view('admin.categories.add_category');
    }

    public function viewCategories(Request $request){
        return view('admin.categories.view_categories');
    }
}
