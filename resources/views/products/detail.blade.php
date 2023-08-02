@extends('layouts.frontLayout.front_design')
@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				@include('layouts.frontLayout.front_sidebar')
			</div>	
			<div class="col-sm-9 padding-right">
				<div class="product-details">
					<div class="col-sm-5">
						<div class="view-product">
							<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
								<a id="mainImgLarge" href="{{ asset('assets/images/backend_images/products/large/'.$productDetails->image) }}">
									<img width="300" class="mainImg" src="{{asset('assets/images/backend_images/products/large/'.$productDetails->image) }}" alt="" />
								</a>
							</div>
							<h3>ZOOM</h3>
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
							@if(count($productImages)>0)
								<div class="item active thumbnails">
									<a href="{{ asset('assets/images/backend_images/products/large/'.$productDetails->image) }}" data-standard="{{ asset('assets/images/backend_images/products/large/'.$productDetails->image) }}">
										<img class="changeImage" style="width:80px;cursor:pointer;padding:5px;border:1px solid #ddd;" src="{{asset('assets/images/backend_images/products/large/'.$productDetails->image)}}" alt="">
									</a>
									@foreach($productImages as $altimage)
									<a href="{{ asset('assets/images/backend_images/products/large/'.$altimage->image) }}" data-standard="{{ asset('assets/images/backend_images/products/large/'.$altimage->image) }}">
										<img class="changeImage" style="width:80px;cursor:pointer;padding:5px;border:1px solid #ddd;" src="{{asset('assets/images/backend_images/products/large/'.$altimage->image)}}" alt="">
									</a>
									@endforeach
								</div>
							@endif	
							</div>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="product-information">
							<!-- <img src="{{asset('assets/images/frontend_images/product-details/1.jpg')}}" class="newarrival" alt="" /> -->
							<h2>{{$productDetails->product_name}}</h2>
							<p>{{$productDetails->product_code}}</p>
							@if($productDetails->attributes)
							<p>
								<select name="selSize" id="selSize" style="width:150px;">
									<option >Select Size</option>
									@foreach($productDetails->attributes as $sizes)
									<option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
									@endforeach
								</select>
							</p>
							@endif	
							<img src="{{asset('assets/images/frontend_images/product-details/rating.png')}}" alt="" />
							<span>
								<span id="getPrice">INR {{$productDetails->price}}</span>
								<label>Quantity:</label>
								<input type="text" value="1" />
								@if($productStock>0)
								<button id="addtocartButton" type="button" class="btn btn-fefault cart">
									<i class="fa fa-shopping-cart"></i>
									Add to cart
								</button>
								@endif
							</span>
							<p><b>Availability: </b><span id="Availability">@if($productStock>0) In Stock @else Out Of Stock @endif </span></p>
							<a href=""><img src="{{asset('assets/images/frontend_images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
						</div>
					</div>
				</div>
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
							<li><a href="#care" data-toggle="tab">Material & Care</a></li>
							<li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="details" >
							{!!$productDetails->description!!}
						</div>
						<div class="tab-pane fade" id="care" >
						{!!$productDetails->care!!}
						</div>
						<div class="tab-pane fade " id="reviews" >
							<div class="col-sm-12">
								<ul>
									<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
									<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
									<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
								</ul>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
								<p><b>Write Your Review</b></p>
								<form action="#">
									<span>
										<input type="text" placeholder="Your Name"/>
										<input type="email" placeholder="Email Address"/>
									</span>
									<textarea name="" ></textarea>
									<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
									<button type="button" class="btn btn-default pull-right">
										Submit
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="recommended_items">
					<h2 class="title text-center">recommended items</h2>
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								@foreach($products as $product)	
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{asset('assets/images/backend_images/products/large/'.$product->image)}}" alt="" />
												<h2>INR {{$product->price}}</h2>
												<p><a href="{{url('product/'.$product->id)}}">{{$product->product_name}}</a></p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
						<i class="fa fa-angle-left"></i>
						</a>
						<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
						<i class="fa fa-angle-right"></i>
						</a>			
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection 