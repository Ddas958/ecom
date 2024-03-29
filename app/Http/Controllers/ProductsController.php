<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;

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
			if(!empty($data['care'])){
    			$product->care = $data['care'];
    		}else{
				$product->care = '';    			
    		}
    		$product->price = $data['price'];

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
			if(empty($data['care'])){
				$data['care'] = '';  			
    		}
		 Product::where(['id'=>$id])->update(
			[
			'category_id' => $data['category_id'],
    		'product_name' => $data['product_name'],
    		'product_code'=> $data['product_code'],
    		'product_color' => $data['product_color'],
    		'description' => $data['description'],
    		'care' => $data['care'],
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
		// Get Product Image
		$productImage = Product::where('id',$id)->first();

		// Get Product Image Paths
		$large_image_path = 'assets/images/backend_images/products/large/';
		$small_image_path = 'assets/images/backend_images/products/small/';

		// Delete Large Image if not exists in Folder
		if(file_exists($large_image_path.$productImage->image)){
			unlink($large_image_path.$productImage->image);
		}

		// Delete Small Image if not exists in Folder
		if(file_exists($small_image_path.$productImage->image)){
			unlink($small_image_path.$productImage->image);
		}
		Product::where(['id'=>$id])->delete();
		return redirect()->back()->with('success','Product deleted successfully!');
	}
	public function deleteProductImage($id = null){
		// Get Product Image
		$productImage = Product::where('id',$id)->first();

		// Get Product Image Paths
		$large_image_path = 'assets/images/backend_images/products/large/';
		$small_image_path = 'assets/images/backend_images/products/small/';

		// Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

		 // Delete Image from Products table
		Product::where(['id'=>$id])->update(['image'=>'']);
		return redirect()->back()->with('success','Product image deleted successfully!');
	}

	public function addImages(Request $request, $id=null){
        $productDetails = Product::where(['id' => $id])->first();
        $categoryDetails = Category::where(['id'=>$productDetails->category_id])->first();
        $category_name = $categoryDetails->name;

        if($request->isMethod('post')){
            $data = $request->all();
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach($files as $file){
                    // Upload Images after Resize
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'assets/images/backend_images/products/large'.'/'.$fileName;
                    $small_image_path = 'assets/images/backend_images/products/small'.'/'.$fileName;  
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);
                    $image->image = $fileName;  
                    $image->product_id = $data['product_id'];
                    $image->save();
                }   
            }
		
            return redirect('admin/add-images/'.$id)->with('success', 'Product Images has been added successfully');
        }

        $productImages = ProductsImage::where(['product_id' => $id])->orderBy('id','DESC')->get();
		
        return view('admin.products.add_images')->with(compact('productDetails','category_name','productImages'));
    }

	public function deleteProductImages($id=null){
        // Get Product Image
        $productImage = ProductsImage::where('id',$id)->first();
        // Get Product Image Paths
        $large_image_path = 'assets/images/backend_images/products/large/';
        $small_image_path = 'assets/images/backend_images/products/small/';
        // Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }
        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }
        // Delete Image from Products Images table
        ProductsImage::where(['id'=>$id])->delete();

        return redirect()->back()->with('success', 'Product alternate mage has been deleted successfully');
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
                        return redirect('admin/add-attributes/'.$id)->with('error', '"'.$data['size'][$key].'" Attribute already exists. Please add another Attribute.');    
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
		$productDetails = Product::with('attributes')->where(['id'=>$id])->first();
		//dd($productDetails);
		return view('admin.products.add_attributes')->with(compact('productDetails'));
	}

	public function editAttributes(Request $request,$id=null){
		if($request->isMethod('post')){
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;
			foreach($data['idAttr'] as $key=> $attr){
                if(!empty($attr)){
                    ProductsAttribute::where(['id' => $data['idAttr'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('success', 'Product Attributes has been updated successfully');
		}
	}

	public function deleteAttribute($id = null){
		ProductsAttribute::where(['id'=>$id])->delete();
		return redirect()->back()->with('success','Attribute deleted successfully!');
	}

	public function products($url=null){
		$countCategories =  Category::where(['url'=>$url,'status'=>1])->count();
		if($countCategories==0){
			abort(404);
		}
		$categories = Category::where(['parent_id'=>0,'status'=>1])->get();
		$categoriesDetail = Category::where(['url'=>$url])->first();
		
		if($categoriesDetail->parent_id==0){
    		$subCategories = Category::where(['parent_id'=>$categoriesDetail->id])->get();
    		$subCategories = json_decode(json_encode($subCategories));

			if(!$subCategories){
				$productsAll = Product::where('category_id',$categoriesDetail->id)->get();
			}
			else{
				foreach($subCategories as $subcat){
					$cat_ids[] = $subcat->id;
				}
				$productsAll = Product::whereIn('category_id', $cat_ids)->get();
			}
    		
			
    	}else{
    		$productsAll = Product::where(['category_id'=>$categoriesDetail->id])->get();
            
    	}
		
		return view('products.listing')->with(compact('categoriesDetail','productsAll','categories'));
	}

	public function product($id=null){
		$productDetails = Product::with('attributes')->where(['id'=>$id])->first();
		$productDetails = json_decode(json_encode($productDetails));
		$products = Product::inRandomOrder()->limit('8')->get();
		$productImages = ProductsImage::where(['product_id' => $id])->orderBy('id','DESC')->get();
		$productStock = ProductsAttribute::where(['product_id' => $id])->sum('stock');
	
		$categories = Category::where(['parent_id'=>0,'status'=>1])->get();
		return view('products.detail')->with(compact('productDetails','categories','products','productImages','productStock'));
	}
	public function getProductPrice(Request $request){
		$data=$request->all();
		$prodSize = explode('-',$data['idSize']);
		$pid = $prodSize[0];
		if(isset($prodSize[1])){
			$psize = $prodSize[1];
			$proAttr = ProductsAttribute::where(['product_id'=>$pid,'size'=>$psize])->first();
			echo $proAttr->price;
			echo "#";
			echo $proAttr->stock;
		}
		
	}

	public function addtocart(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        if(empty(Auth::user()->email)){
            $data['user_email'] = '';    
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = Session::get('session_id');
        if(!isset($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }

        $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],'product_color' => $data['product_color'],'size' => $data['size'],'session_id' => $session_id])->count();
        if($countProducts>0){
            return redirect()->back()->with('flash_message_error','Product already exist in Cart!');
        }

        $sizeIDArr = explode('-',$data['size']);
        $product_size = $sizeIDArr[1];

        $getSKU = ProductsAttribute::select('sku')->where(['product_id' => $data['product_id'], 'size' => $product_size])->first();
                
        DB::table('cart')
        ->insert(['product_id' => $data['product_id'],'product_name' => $data['product_name'],
            'product_code' => $getSKU['sku'],'product_color' => $data['product_color'],
            'price' => $data['price'],'size' => $product_size,'quantity' => $data['quantity'],'user_email' => $data['user_email'],'session_id' => $session_id]);

        return redirect('cart')->with('flash_message_success','Product has been added in Cart!');

    }    

	public function cart(){           
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();     
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();    
        }
        
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        /*echo "<pre>"; print_r($userCart); die;*/
        return view('products.cart')->with(compact('userCart'));
    }
}
