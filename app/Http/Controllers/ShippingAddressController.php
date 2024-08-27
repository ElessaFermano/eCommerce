<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $provinces = Shipping::select('province')->distinct()->get();
        return view('shipping.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'country' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'brgy' => 'required|string',
            'zipcode' => 'required|integer',
        ]);
        $shipping = Shipping::where('province', $validated['province'])->first();

        if (!$shipping) {
            return back()->withErrors(['province' => 'Invalid province selected.']);
        }

        $shippingAddress = ShippingAddress::create([
            'user_id' => $validated['user_id'],
            'country' => $validated['country'],
            'shipping_id' => $shipping->id,
            'city' => $validated['city'],
            'brgy' => $validated['brgy'],
            'zipcode' => $validated['zipcode'],
        ]);

        return redirect()->route('order.create', [
            'shippingAddressId' => $shippingAddress->id,
            'user_id' => $validated['user_id'],
        ]);
    }


    public function show(ShippingAddress $shippingAddress)
    {
        //
    }


    public function edit(ShippingAddress $shippingAddress)
    {
        //
    }


    public function update(Request $request, ShippingAddress $shippingAddress)
    {
        //
    }


    public function destroy(ShippingAddress $shippingAddress)
    {
        //
    }
}
