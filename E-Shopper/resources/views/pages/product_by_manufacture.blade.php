@extends('layout')
@section('content')

<h2 class="title text-center">Features Items</h2>
					
					@foreach( $product_by_manufacture as $data )
					@if( $data->publication_status == 1)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to($data->product_image)}}" alt="" height="250px" width="250px"/>
											<h2>{{$data->product_price}} BDT</h2>
											<p>{{$data->product_name}}</p>
											<a href="{{URL::to('/view_product/'.$data->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{$data->product_price}} BDT</h2>
												<p>{{$data->product_name}}</p>
												<a href="{{URL::to('/view_product/'.$data->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>{{$data->manufacture_name}}</a></li>
										<li><a href="{{URL::to('/view_product/'.$data->product_id)}}"><i class="fa fa-plus-square"></i>View Product</a></li>
									</ul>
								</div>
							</div>
						</div>
						
					@endif
					@endforeach
					</div><!--features_items-->
					
					
					
					<?php
						$all_published_product = DB::table('products')
												->get();
					?>
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
							@foreach( $all_published_product as $data )
							@if( $data->publication_status == 1)
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to($data->product_image)}}" alt="" />
													<h2>{{$data->product_price}} BDT</h2>
													<p>{{$data->product_name}}</p>
													<a href="{{URL::to('/view_product/'.$data->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to($data->product_image)}}" alt="" />
													<h2>{{$data->product_price}} BDT</h2>
													<p>{{$data->product_name}}</p>
													<a href="{{URL::to('/view_product/'.$data->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									
									
								</div>
							@endif
							@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->

@endsection