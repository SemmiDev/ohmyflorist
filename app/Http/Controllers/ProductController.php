<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {
        return view('dashboard', [
            "products" => Product::all()
        ]);
    }

    public function show(Product $product)
    {
        return view('product.show', [
            'product' => $product,
        ]);
    }

    public function buy(StoreOrderRequest $request, Product $product)
    {
        $totalPrice = $product->price * $request->quantity;
        if ($product->discount>0) {
            $totalPrice = $totalPrice - ($totalPrice * $product->discount);
        }

        $order = Order::create([
            'id' => rand(),
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'address' => $request->address,
            'user_id' => Auth()->user()->id,
            'phone' => $request->phoneNumber,
            'qty' => $request->quantity,
            'total_price' => $totalPrice,
            'product_id' => $product->id,
            'status' => 'Unpaid',
        ]);

        return redirect()->route('product.invoice', $order->id);
    }
}
