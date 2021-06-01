<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function login_check()
    {
        return view('pages.login');
    }

    public function customer_login(Request $request)
    {
        $customer_email = $request->customer_email;
        $password = md5($request->password);

        $result = DB::table('customers')
                    ->where('customer_email', $customer_email)
                    ->where('password', $password)
                    ->first();

        if($result)
        {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        }
        else{

            return Redirect::to('/login-check');   
        }
    }

    public function customer_logout()
    {
        Session::flush();
        return Redirect::to('/');
    }

    public function customer_registration(Request $request)
    {
        $data=array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['mobile_number'] = $request->mobile_number;
        $data['password'] = md5($request->password);

        $customer_id = DB::table('customers')
                        ->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        Session::put('message', 'Customer Registration Successfully!');

        return Redirect::to('/checkout');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }

    public function save_shipping_info(Request $request)
    {
        $data=array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_first_name'] = $request->shipping_first_name;
        $data['shipping_last_name'] = $request->shipping_last_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_mobile_number'] = $request->shipping_mobile_number;
        $data['shipping_city'] = $request->shipping_city;

        $shipping_id = DB::table('Shippings')
            ->insertGetId($data);

        Session::put('shipping_id', $shipping_id);

        return Redirect::to('/payment');
    
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function order_place(Request $request)
    {
        $payment_gateway = $request->payment_method;
        
        $payment_data = array();
        $payment_data['payment_method'] = $payment_gateway;
        $payment_data['payment_status'] = 'pending';

        $payment_id = DB::table('payments')
                        ->insertGetId($payment_data);

        $order_data = array();
        $order_data['payment_id'] = $payment_id;
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'pending';

        $order_id = DB::table('orders')
                    ->insertGetId($order_data);

        $order_details_data = array();
        $contents = Cart::content();

        foreach($contents as $data)
        {
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $data->id;
            $order_details_data['product_name'] = $data->name;
            $order_details_data['product_price'] = $data->price;
            $order_details_data['product_sales_quantity'] = $data->qty;

            DB::table('order_details')
                ->insert($order_details_data);
        }

        if($payment_gateway == 'handcash')
        {
            Cart::destroy();
            return view('pages.handcash');
        }
        elseif($payment_gateway == 'cart')
        {
            return view('exampleEasycheckout');
        }
        elseif($payment_gateway == 'bkash')
        {
            return view('exampleEasycheckout');
        }
        else{
            echo 'Not Selected';
        }

    }

    public function manage_order()
    {
        $all_order_info=DB::table('orders')
                            ->join('customers','orders.customer_id','customers.customer_id')
                            ->select('orders.*','customers.customer_name')
                            ->get();
        
        return view('admin.manage_order', compact('all_order_info'));
    }
}
