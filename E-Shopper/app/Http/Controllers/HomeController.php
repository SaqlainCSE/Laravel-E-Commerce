<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $all_published_product=DB::table('products')
                            ->join('categorys','products.category_id','categorys.category_id')
                            ->join('manufactures','products.manufacture_id','manufactures.manufacture_id')
                            ->select('products.*','categorys.category_name','manufactures.manufacture_name')
                            ->where('products.publication_status',1)
                            ->limit(9)
                            ->get();
        
        return view('pages.home_content', compact('all_published_product'));

        //return view('pages.home_content');
    }

    public function show_product_by_category($category_id)
    {
        $product_by_category=DB::table('products')
                            ->join('categorys','products.category_id','categorys.category_id')
                            ->select('products.*','categorys.category_name')
                            ->where('categorys.category_id',$category_id)
                            ->where('products.publication_status',1)
                            ->limit(18)
                            ->get();
        
        return view('pages.product_by_category', compact('product_by_category'));
    }

    public function show_product_by_manufacture($manufacture_id)
    {
        $product_by_manufacture=DB::table('products')
                            ->join('categorys','products.category_id','categorys.category_id')
                            ->join('manufactures','products.manufacture_id','manufactures.manufacture_id')
                            ->select('products.*','categorys.category_name','manufactures.manufacture_name')
                            ->where('manufactures.manufacture_id',$manufacture_id)
                            ->where('products.publication_status',1)
                            ->limit(18)
                            ->get();
        
        return view('pages.product_by_manufacture', compact('product_by_manufacture'));
        
    }

    public function product_details_by_id($product_id)
    {
        $product_by_details = DB::table('products')
                            ->join('categorys','products.category_id','categorys.category_id')
                            ->join('manufactures','products.manufacture_id','manufactures.manufacture_id')
                            ->select('products.*','categorys.category_name','manufactures.manufacture_name')
                            ->where('products.product_id',$product_id)
                            ->where('products.publication_status',1)
                            ->first();
        return view('pages.product_details', compact('product_by_details'));
    }
}
