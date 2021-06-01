<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class ManufactureController extends Controller
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
        return view('admin.add_manufacture');
    }

    public function all_manufacture()
    {
        $this->AdminAuthCheck();
        $all_manufacture_info=DB::table('manufactures')->get();
        return view('admin.all-manufacture', compact('all_manufacture_info'));
        //return view('admin.all-manufacture');
    }

    public function save_manufacture(Request $request)
    {
        $this->AdminAuthCheck();
        $data=array();
        $data['manufacture_id']=$request->manufacture_id;
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;
        $data['publication_status']=$request->publication_status;

        DB::table('manufactures')->insert($data);
        Session::put('message','Manufacture Added Successfully!!');
        return Redirect::to('/add-manufacture');

    }

    public function inactive_manufacture($manufacture_id)
    {
        DB::table('manufactures')
            ->where('manufacture_id',$manufacture_id)
            ->update(['publication_status' => 0]);
        Session::put('message','Manufacture Inactive Successfully!!');
        return Redirect::to('/all-manufacture');
    }

    public function active_manufacture($manufacture_id)
    {
        DB::table('manufactures')
            ->where('manufacture_id',$manufacture_id)
            ->update(['publication_status' => 1]);
        Session::put('message','Manufacture Active Successfully!!');
        return Redirect::to('/all-manufacture');
    }

    public function edit_manufacture($manufacture_id)
    {
        $this->AdminAuthCheck();
        $edit_manufacture_info=DB::table('manufactures')
                                ->where('manufacture_id',$manufacture_id)
                                ->first();

        return view('admin.edit_manufacture', compact('edit_manufacture_info'));
    }

    public function update_manufacture(Request $request, $manufacture_id)
    {
        $this->AdminAuthCheck();
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;

        DB::table('manufactures')
            ->where('manufacture_id', $manufacture_id)
            ->update($data);

        Session::put('message','Manufacture Update Successfully!!');
        return Redirect::to('/all-manufacture');
    }

    public function delete_manufacture($manufacture_id)
    {
        $this->AdminAuthCheck();
        DB::table('manufactures')
            ->where('manufacture_id', $manufacture_id)
            ->delete();
        Session::put('message','Manufacture Delete Successfully!!');
        
        return Redirect::to('/all-manufacture');
    }
    
}
