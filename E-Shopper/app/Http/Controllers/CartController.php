<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $qty = $request->qty;
        $weight = $request->weight;
        $product_id = $request->product_id;
        $product_info = DB::table('products')
                        ->where('product_id', $product_id)
                        ->first();

        $data['qty'] = $qty;
        $data['weight'] = $weight;
        $data['id'] = $product_info->product_id;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;

        Cart::add($data);
        return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
        $all_published_category = DB::table('categorys')
                                    ->where('publication_status', 1)
                                    ->get();
        return view('pages.add_to_cart', compact('all_published_category'));
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }

    public function update_to_cart(Request $request)
    {
        $qty = $request->qty;
        $rowId = $request->rowId;

        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }

}
