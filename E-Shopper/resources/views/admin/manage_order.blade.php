@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">All Orders</a></li>
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
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Orders</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Order ID</th>
								  <th>Customer Name</th>
								  <th>Total Order</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead> 
						@foreach( $all_order_info as $data )
						  <tbody>
							<tr>
								<td>{{ $data->order_id }}</td>
								<td class="center">{{ $data->customer_name }}</td>
								<td class="center">{{ $data->order_total }}</td>

								<td class="center">
								@if( $data->order_status == 'pending')
									<span class="label label-danger">Pending</span>
								@else
									<span class="label label-success">Deliverd</span>
								@endif
								</td>

								<td class="center">
								@if( $data->order_status == 'pending' )
									<a class="btn btn-danger" href="{{URL::to('/inactive/'. $data->order_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
								@else
									<a class="btn btn-success" href="{{URL::to('/active/'. $data->order_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
								@endif

									<a class="btn btn-info" href="{{URL::to('/edit/'. $data->order_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete/'. $data->order_id)}}" id="delete">
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