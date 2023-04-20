<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class IndexController extends Controller
{
    public function index(){
        // $productsAll = Product::get();
        // $productsAll = Product::orderBy('id','desc')->get();
        $productsAll = Product::inRandomOrder()->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        // $categrories = json_decode(json_encode($categrories));
        // echo "<pre>";print_r($categories);die;
        // foreach($categories as $cat){
        //     echo $cat->name;
        //     $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
        //     foreach($sub_categories as $subcat){
        //         echo $subcat->name;
        //     }
        // }
        return view('index')->with(compact('productsAll','categories'));
    }
}
