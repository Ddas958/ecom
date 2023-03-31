<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        $levels = Category::get();
        if($request->isMethod('post')){
            $data = $request->all();
            //print_r($data);die;
            $category = new Category;
            $category->parent_id = $data['parent_id'];
            $category->name = $data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();
            return redirect('/admin/view-categories')->with('success','Category Added Successfully.');
        }
        return view('admin.categories.add_category')->with(compact('levels'));

    }
    public function editCategory( Request $request, $id=null ){
        if($request->isMethod('post')){
            $data = $request->all();
            Category::where('id',$id)->update([
                    'name' => $data['category_name'],
                    'description'=> $data['description'],
                    'url' => $data['url'],
            ]);
            return redirect('admin/view-categories')->with('success','Category Updated Succesfully.');
        }
            $levels = Category::get();
            $categoryDetails = Category::where('id',$id)->first();
            return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));

    }

    public function viewCategories(Request $request){
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }
}
