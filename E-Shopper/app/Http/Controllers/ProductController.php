<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{

    public function AdminAuthCheck()
    {
        $admin_id = Session::get('admin_id');
        
        if($admin_id)
        {
            return;
        }
        else{
            return Redirect::to('/admin')->send();
        }
    }

    public function index()
    {
        $this->AdminAuthCheck();
        return view('admin.add-product');
    }

    public function all_product()
    {
        $this->AdminAuthCheck();
        $all_product_info=DB::table('products')
                            ->join('categorys','products.category_id','categorys.category_id')
                            ->join('manufactures','products.manufacture_id','manufactures.manufacture_id')
                            ->select('products.*','categorys.category_name','manufactures.manufacture_name')
                            ->get();
        
        return view('admin.all-product', compact('all_product_info'));
        //return view('admin.all-product');
    }

    public function save_product(Request $request)
    {
        $this->AdminAuthCheck();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        // $data['product_color']=$request->product_color;
        $data['publication_status']=$request->publication_status;

        $image=$request->file('product_image');
        if($image)
        {
            $image_name=time();
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $data['product_image']=$image_url;
                DB::table('products')->insert($data);
                Session::put('message','Added Successfully!!');
                return Redirect::to('/add-product');
                
            }
            $data['product_image']='';
                DB::table('products')->insert($data);
                Session::put('message','Added Successfully Without Image!!');
                return Redirect::to('/add-product');
        }

        //for videos
        $video=$request->file('product_video');
        if($video)
        {
            $video_name=time();
            $ext=$video->getClientOriginalName();
            $video_full_name=$video_name.'.'.$ext;
            $upload_path='video/';
            $video_url=$upload_path.$video_full_name;
            $success=$video->move($upload_path,$video_full_name);
            
            if($success)
            {
                $data['product_video']=$video_url;
                DB::table('products')->insert($data);
                Session::put('message','Added Successfully!!');
                return Redirect::to('/add-product');
                
            }
            $data['product_video']='';
                DB::table('products')->insert($data);
                Session::put('message','Added Successfully Without Video!!');
                return Redirect::to('/add-product');
        }
  

    }

    public function inactive_product($product_id)
    {
        DB::table('products')
            ->where('product_id',$product_id)
            ->update(['publication_status' => 0]);
        Session::put('message','Inactive Successfully!!');
        return Redirect::to('/all-product');
    }

    public function active_product($product_id)
    {
        DB::table('products')
            ->where('product_id',$product_id)
            ->update(['publication_status' => 1]);
        Session::put('message','Active Successfully!!');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id)
    {
        $this->AdminAuthCheck();
        $edit_product_info=DB::table('products')
                                ->where('product_id',$product_id)
                                ->first();
        return view('admin.edit-product', compact('edit_product_info'));
    }

    public function update_product(Request $request, $product_id)
    {
        $this->AdminAuthCheck();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        // $data['product_color']=$request->product_color;

        DB::table('products')->where('product_id', $product_id)->update($data);
        Session::put('message','Updated Successfully!!');
        return Redirect::to('/all-product');

        // $image=$request->file('product_image');
        // if($image)
        // {
        //     $image_name=time();
        //     $ext=strtolower($image->getClientOriginalExtension());
        //     $image_full_name=$image_name.'.'.$ext;
        //     $upload_path='image/';
        //     $image_url=$upload_path.$image_full_name;
        //     $success=$image->move($upload_path,$image_full_name);
        //     if($success)
        //     {
        //         $data['product_image']=$image_url;
                
        //         DB::table('products')->where('product_id', $product_id)->update($data);
        //         Session::put('message','Product Updated Successfully!!');
        //         return Redirect::to('/all-product');
                
        //     }
        //     $data['product_image']='';
        //         DB::table('products')->where('product_id', $product_id)->update($data);
        //         Session::put('message','Product Updated Successfully Without Image!!');
        //         return Redirect::to('/all-product');
                
        // }
    }

    public function delete_product($product_id)
    {
        $this->AdminAuthCheck();
        DB::table('products')
            ->where('product_id',$product_id)
            ->delete();

        Session::put('message','Deleted Successfully!!');
        return Redirect::to('/all-product');
    }

}
