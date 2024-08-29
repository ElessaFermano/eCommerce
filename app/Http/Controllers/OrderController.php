<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\User;
use App\Notifications\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
       $orders = Order::simplePaginate(5);
       $ord = Order::with('user')->where('shipping_address_id')->first();
       return view('order.index', compact('orders', 'ord'));
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
    $productID = json_decode($request->product_id);
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
   
        foreach ($productID as $product_id){
  
        $order = Order::create([
        'user_id' => $user->id,
        'product_id' => $product_id,
        'shipping_address_id' => $shippingAddress->id,
        'payment_method' => $request->payment_method,
        'subtotal' => $request->subtotal,
        'shipping' => $request->shipping_fee,
        'total' => $request->total_amount,
        'order_id' => rand(100000, 999999),  

    ]);
 }
   
    Cart::where('user_id', $request->user_id)->delete();

    Mail::to($user->email)->send(new OrderConfirmationMail($order));
     
    Http::asForm()->post('https://api.semaphore.co/api/v4/messages', [
        'apikey' => env('SMS_API_KEY'),
        'number' => '09973208548',
        'message' => 'Thank you for shopping with us! Your order ID is: ' . $order->order_id,
    ]);
    $admin = User::where('role', 'admin')->first(); 
    $admin->notify(new OrderPlaced($order));


    return redirect()->to('/customer/' . $request->user_id)->with('success', 'Your order is in process.');
}

    public function show($id)
    {
        $orders = Order::where('user_id', $id);
        $products = $orders->pluck('product_id', 'id');
        
  
        foreach($products as $product){
              $pr = Product::find($product)->all();
              
        }
        return view('order', compact('pr'));
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

    public function orderAPI()
    {
        $orders = Order::get();
        
        if($orders)
        {
            return response()->json(['status' => 200,
            'data' => $orders,
            
        ]);
    
        } else{
            return response()->json(['status' => 404,
            'message' => 'Not Found',
        ]);
        }
    }

  
}
