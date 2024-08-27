<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
  
    public function index()
    {
        $shippings = Shipping::simplePaginate(7);
        return view('shipping.index', compact('shippings'));
    }

    public function create()
    {
        return view('shipping.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'province' => 'required',
        'fee' => 'nullable',
    ]);

    $fee = $request->fee ?? 100.00;

    Shipping::create([
        'province' => $request->province,
        'fee' => $fee,
    ]);

    return redirect()->route('shipping.index');
}


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'province' => 'required',
    //         'fee' => 'required',
    //     ]);

    //     Shipping::create([
    //         'province' => $request->province,
    //         'fee' => $request->fee,
    //     ]);

    //     return redirect()->route('shipping.index');
        
    // }

    public function show(Shipping $shipping)
    {
        //
    }


    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('shipping.edit', compact('shipping'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'province' => 'required',
            'fee' => 'required',
        ]);

        $shipping = Shipping::findOrFail($id);
        $shipping->province = $request->input('province');
        $shipping->fee = $request->input('fee');

        $shipping->save();

        return redirect()->route('shipping.index');
    }


    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->route('shipping.index');
    }
    public function getShippingFee(Request $request)
    {
        $province = $request->query('province');
        
        // Find the shipping fee for the selected province
        $shipping = Shipping::where('province', $province)->first();
        
        // Return the shipping fee or a default value if the province is not found
        if ($shipping) {
            return response()->json(['fee' => $shipping->fee]);
        } else {
            return response()->json(['fee' => 0.00]); // Default value if province is not found
        }
    }
}
