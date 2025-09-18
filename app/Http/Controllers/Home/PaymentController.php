<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        //midtrans config
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$clientKey = config('services.midtrans.client_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');

        $result = \Midtrans\Transaction::status($request->order_id);

        // Handle the result
    }
}
