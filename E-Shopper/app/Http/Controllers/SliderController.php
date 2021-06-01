<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class SliderController extends Controller
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
        return view('admin.add_slider');
    }

    public function all_slider()
    {
        $this->AdminAuthCheck();
        $all_slider_info = DB::table('sliders')->get();
        
        return view('admin.all_slider', compact('all_slider_info'));
    }

    public function save_slider(Request $request)
    {
        $this->AdminAuthCheck();
        $data=array();
        $data['publication_status']=$request->publication_status;

        $image=$request->file('slider_image');
        if($image)
        {
            $image_name=time();
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='slider/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $data['slider_image']=$image_url;
                DB::table('sliders')->insert($data);
                Session::put('message','Slider Added Successfully!!');
                return Redirect::to('/add-slider');
                
            }
            $data['slider_image']= '';
                DB::table('sliders')->insert($data);
                Session::put('message','Slider Added Successfully Without Image!!');
                return Redirect::to('/add-slider');
        }
    }

    public function inactive_slider($slider_id)
    {
        DB::table('sliders')
            ->where('slider_id', $slider_id)
            ->update(['publication_status' => 0]);

        Session::put('message','Slider Inctive Successfully!!');
        return Redirect::to('/all-slider');
    }

    public function active_slider($slider_id)
    {
        DB::table('sliders')
            ->where('slider_id', $slider_id)
            ->update(['publication_status' => 1]);

        Session::put('message','Slider Active Successfully!!');
        return Redirect::to('/all-slider');
    }

    public function delete_slider($slider_id)
    {
        $this->AdminAuthCheck();
        DB::table('sliders')
            ->where('slider_id', $slider_id)
            ->delete();
        
        Session::put('message','Slider Deleted Successfully!!');
        return Redirect::to('/all-slider');
    }
}
