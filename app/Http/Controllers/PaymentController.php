<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request, Order $order)
    {
        $payment = $order->payment()->first();
        if ($payment) {
            $snapToken = $payment->snap_token;
            return view('payment.show', compact('snapToken', 'order'));
        }

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'email' => Auth::user()->email,
                'phone' => $order->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->payment()->create([
            'snap_token' => $snapToken,
        ]);

        return view('payment.show', compact('snapToken', 'order'));
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
}
