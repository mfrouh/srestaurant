<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
       $orders=Order::all();
       return view('Backend.order.index',compact('orders'));
    }

    public function order_details($id)
    {
       $orderDetails=OrderDetails::where('order_id',$id)->get();
       return view('Backend.main.order_details',compact('orderDetails'));
    }
}
