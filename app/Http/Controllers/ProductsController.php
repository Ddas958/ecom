<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;

class ProductsController extends Controller
{
    //
    public function  addProduct(Request $request){
        
        if($request->isMethod('post')){
    		$data = $request->all();
    		if(empty($data['category_id'])){
    			return redirect()->back()->with('error','Under Category is missing!');	
    		}
    		$product = new Product;
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->product_code = $data['product_code'];
    		$product->product_color = $data['product_color'];
    		if(!empty($data['description'])){
    			$product->description = $data['description'];
    		}else{
				$product->description = '';    			
    		}
    		$product->price = $data['price'];

    		// Upload Image
    		if($request->hasFile('image')){
    			$image_tmp = $request->file('image');
    			if($image_tmp->isValid()){
    				$extension = $image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;       
    				$large_image_path ='images/backend_images/products/large/'.$filename;
    				$small_image_path = 'images/backend_images/products/small/'.$filename;
    				// Resize Images
    				Image::make($image_tmp)->save($large_image_path);
    				Image::make($image_tmp)->resize(100,100)->save($small_image_path);

    				// Store image name in products table
    				$product->image = $filename;
    			}
    		}

    		$product->save();
    		/*return redirect()->back()->with('flash_message_success','Product has been added successfully!');*/
            return redirect('/admin/view-products')->with('success','Product has been added successfully!');
    	}

    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option value='' selected disabled>Select</option>";
    	foreach($categories as $cat){
    		$categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach ($sub_categories as $sub_cat) {
    			$categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}
    	return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }
    public function viewProducts(){
        $products = Product::get();
        $products = json_decode(json_encode($products));
        foreach($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products')->with(compact('products'));
    }

	public function editProduct(Request $request, $id = null){
		if($request->isMethod('post')){
    		$data = $request->all();	
		 // Upload Image
			if($request->hasFile('image')){
				$image_tmp = $request->file('image');
				if($image_tmp->isValid()){
					$extension = $image_tmp->getClientOriginalExtension();
					$filename = rand(111,99999).'.'.$extension;
					$large_image_path ='assets/images/backend_images/products/large/'.$filename;
					$small_image_path = 'assets/images/backend_images/products/small/'.$filename;
					// Resize Images
					Image::make($image_tmp)->save($large_image_path);
					Image::make($image_tmp)->resize(100,100)->save($small_image_path);
				}
			}else if(!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else{
                $filename = '';
            }

            if(empty($data['description'])){
                $data['description'] = '';
            }
		 Product::where(['id'=>$id])->update(
			[
			'category_id' => $data['category_id'],
    		'product_name' => $data['product_name'],
    		'product_code'=> $data['product_code'],
    		'product_color' => $data['product_color'],
    		'description' => $data['description'],
    		'price' => $data['price'],
			'image' => $filename,
			]
			);
			return redirect('/admin/view-products')->with('success','Product has been updated successfully!');
		}
		// product details
		$productsDetail = Product::where(['id'=> $id])->first();

		// category dropdown start
		$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option value='' disabled>Select</option>";
    	foreach($categories as $cat){
			if($cat->id == $productsDetail->category_id){
				$selected = 'selected';
			}
			else{
				$selected = '';
			}
    		$categories_dropdown .= "<option value='".$cat->id."' '".$selected."'>".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach ($sub_categories as $sub_cat) {
				if($sub_cat->id == $productsDetail->category_id){
					$selected = 'selected';
				}
				else{
					$selected = '';
				}
    			$categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected." >&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}
		// category dropdown end
		return view('admin.products.edit_product')->with(compact('productsDetail','categories_dropdown'));
	}

	public function deleteProduct($id = null){
		Product::where(['id'=>$id])->delete();
		return redirect()->back()->with('success','Product deleted successfully!');
	}
	public function deleteProductImage($id = null){
		// Get Product Image
		$productImage = Product::where('id',$id)->first();

		// Get Product Image Paths
		$large_image_path = 'assets/images/backend_images/product/large/';
		$small_image_path = 'assets/images/backend_images/product/small/';

		// Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

		 // Delete Image from Products table
		Product::where(['id'=>$id])->update(['image'=>'']);
		return redirect()->back()->with('success','Product image deleted successfully!');
	}

	public function addAttributes(Request $request, $id=null){
		if($request->isMethod('post')){
			//echo "<pre>"; print_r($data); die;
			$data = $request->all();
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    $attrCountSKU = ProductsAttribute::where(['sku'=>$val])->count();
                    if($attrCountSKU>0){
                        return redirect('admin/add-attributes/'.$id)->with('error', 'SKU already exists. Please add another SKU.');    
                    }
                    $attrCountSizes = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0){
                        return redirect('admin/add-attributes/'.$id)->with('error', 'Attribute already exists. Please add another Attribute.');    
                    }
                    $attr = new ProductsAttribute;
                    $attr->product_id = $id;
                    $attr->sku = $val;
                    $attr->size = $data['size'][$key];
                    $attr->price = $data['price'][$key];
                    $attr->stock = $data['stock'][$key];
                    $attr->save();
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('success', 'Product Attributes has been added successfully');
		}
		$productDetails = Product::where(['id'=>$id])->first();
		return view('admin.products.add_attributes')->with(compact('productDetails'));
	}
}
