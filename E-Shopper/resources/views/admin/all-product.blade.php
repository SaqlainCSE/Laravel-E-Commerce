@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">All Courses</a></li>
			</ul>
				<p class="alert-success">
							<?php

								$message=Session::get('message');

								if($message)
								{
									echo $message;
									Session::put('message', null);
								}

								

							?>
				</p>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Courses</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Courses ID</th>
								  <th>Courses Name</th>
                                  <th>Courses Image</th>
                                  <th>Courses Price</th>
                                  <th>Courses Size</th>
                                  <!-- <th>Product Color</th> -->
                                  <th>Category Name</th>
                                  <th>Manufacture Name</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead> 
						@foreach( $all_product_info as $data )
						  <tbody>
							<tr>
								<td class="center">{{ $data->product_id }}</td>
								<td class="center">{{ $data->product_name }}</td>
                                <td> <img src="{{URL::to($data->product_image)}}" style="height: 80px; width: 80px"></td>
                                <td class="center">{{ $data->product_price }} BDT</td>
                                <td class="center">{{ $data->product_size }}</td>
                                <!-- <td class="center">{{ $data->product_color }}</td> -->
                                <td class="center">{{ $data->category_name }}</td>
                                <td class="center">{{ $data->manufacture_name }}</td>
                                

								<td class="center">
								@if( $data->publication_status == 1)
									<span class="label label-success">Active</span>
								@else
									<span class="label label-danger">Inactive</span>
								@endif
								</td>

								<td class="center">
								@if( $data->publication_status == 1 )
									<a class="btn btn-danger" href="{{URL::to('/inactive_product/'. $data->product_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
								@else
									<a class="btn btn-success" href="{{URL::to('/active_product/'. $data->product_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
								@endif

									<a class="btn btn-info" href="{{URL::to('/edit-product/'. $data->product_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-product/'. $data->product_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						  </tbody>
						@endforeach
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection