<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        return view('admin.add-category');
    }

    public function all_category()
    {
        $this->AdminAuthCheck();
        $all_category_info=DB::table('categorys')->get();
        return view('admin.all-category', compact('all_category_info'));
        //return view('admin.all-category');
    }

    public function save_category(Request $request)
    {
        $this->AdminAuthCheck();
        $data=array();
        $data['category_id']=$request->category_id;
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;
        $data['publication_status']=$request->publication_status;

        DB::table('categorys')->insert($data);
        Session::put('message','Category Added Successfully!!');
        return Redirect::to('/add-category');
    }

    public function inactive_category($category_id)
    {
        DB::table('categorys')
            ->where('category_id',$category_id)
            ->update(['publication_status' => 0]);
        Session::put('message','Category Inactive Successfully!!');
        return Redirect::to('/all-category');
    }

    public function active_category($category_id)
    {
        DB::table('categorys')
            ->where('category_id',$category_id)
            ->update(['publication_status' => 1]);
        Session::put('message','Category Active Successfully!!');
        return Redirect::to('/all-category');
    }

    public function edit_category($category_id)
    {
        $this->AdminAuthCheck();
        $edit_category_info=DB::table('categorys')
                                ->where('category_id',$category_id)
                                ->first();

        return view('admin.edit_category', compact('edit_category_info'));
    }

    public function update_category(Request $request, $category_id)
    {
        $this->AdminAuthCheck();
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_description']=$request->category_description;

        DB::table('categorys')
            ->where('category_id', $category_id)
            ->update($data);
        Session::put('message','Category Updated Successfully!!');
        return Redirect::to('/all-category');
        
    }

    public function delete_category($category_id)
    {
        $this->AdminAuthCheck();
        DB::table('categorys')
            ->where('category_id', $category_id)
            ->delete();
        Session::put('message','Category Deleted Successfully!!');
        return Redirect::to('/all-category');
    }
}
