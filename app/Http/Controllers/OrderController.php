<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
       $orders = Order::simplePaginate(5);
       return view('order.index', compact('orders'));
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {

    $user = User::find($request->user_id);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $shippingAddress = ShippingAddress::create([
        'user_id' => $request->user_id,
        'country' => $request->country,
        'shipping_id' => $request->shipping_id,
        'city' => $request->city,
        'brgy' => $request->brgy,
        'zipcode' => $request->zipcode,
    ]);

    $order = Order::create([
        'shipping_address_id' => $shippingAddress->id,
        'payment_method' => $request->payment_method,
        'subtotal' => $request->subtotal,
        'shipping' => $request->shipping_fee,
        'total' => $request->total_amount,
    ]);

    Mail::to($user->email)->send(new OrderConfirmationMail($order));
    return redirect()->to('/customer/' . $request->user_id)->with('success', 'Your order is in process.');
}


    public function show(Order $order)
    {
        
    }


    public function edit(Order $order)
    {
        
    }

    public function update(Request $request, Order $order)
    {
        
    }


    public function destroy(Order $order)
    {
        
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully');
    }
}
