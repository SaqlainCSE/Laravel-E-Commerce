@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Update Courses</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Courses</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
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
					<div class="box-content">
						<form class="form-horizontal" action="{{ url('/update-product', $edit_product_info->product_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
						  <fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Courses Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_name" value="{{ $edit_product_info->product_name }}">
							  </div>
							</div>

                            <div class="control-group">
								<label class="control-label" for="selectError3">Courses Category</label>
								<div class="controls">
								  <select id="selectError3" name="category_id">
                                  <option>Select Category</option>
                                <?php
                                    $all_published_category = DB::table('categorys')
                                                                ->where('publication_status',1)
                                                                ->get();
                                    foreach( $all_published_category as $data )
                                    {
							    ?>
									<option value="{{$data->category_id}}">{{$data->category_name}}</option>

                                <?php }?>

								  </select>
								</div>
							</div>

                            <div class="control-group">
								<label class="control-label" for="selectError3">Manufacture Name</label>
								<div class="controls">
								  <select id="selectError3" name="manufacture_id">
                                  <option>Select Manufacture</option>
                                <?php
                                    $all_published_manufacture = DB::table('manufactures')
                                                                ->where('publication_status',1)
                                                                ->get();
                                    foreach( $all_published_manufacture as $data )
                                    {
								?>
									<option value="{{$data->manufacture_id}}">{{$data->manufacture_name}}</option>

                                <?php } ?>
                            
								  </select>
								</div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Courses Short Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_short_description" rows="3">
                                    {{ $edit_product_info->product_short_description }}
                                </textarea>
							  </div>
							</div>

                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Courses Long Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_long_description" rows="3">
                                    {{ $edit_product_info->product_long_description }}
                                </textarea>
							  </div>
							</div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Courses Image</label>
							  <div class="controls">
								<input type="file" class="input-file uniform_on" name="product_image" id="fileInput">
							  </div>
							</div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Courses Price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_price" value="{{ $edit_product_info->product_price }}">
							  </div>
							</div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Courses Size</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_size" value="{{ $edit_product_info->product_size }}">
							  </div>
							</div>

                            <!-- <div class="control-group">
							  <label class="control-label" for="date01">Product Color</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_color" value="{{ $edit_product_info->product_color }}">
							  </div>
							</div> -->



							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>

						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->


@endsection