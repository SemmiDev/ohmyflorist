<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::where('user_id', Auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('orders.list', compact('orders'));
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashed = hash('sha512', $request->order_id . $request->status_code .$request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order = Order::findOrFail($request->order_id);
                $order->status = 'Paid';
                $order->save();
            }
        }
    }

    public function store(StoreOrderRequest $request, Product $product)
    {
        $totalPrice = $product->price * $request->quantity;
        if ($product->discount>0) {
            $totalPrice = $totalPrice - ($totalPrice * $product->discount);
        }

        $productId = $product->id;

        $order = Order::create([
            'id' => rand(),
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'address' => $request->address,
            'user_id' => Auth()->user()->id,
            'phone' => $request->phoneNumber,
            'qty' => $request->quantity,
            'total_price' => $totalPrice,
            'product_id' => $productId,
            'status' => 'Unpaid',
        ]);

        return redirect()->route('payment.index', $order->id);
    }

    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
