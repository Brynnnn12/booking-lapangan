<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class PaymentService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken($booking, $user)
    {
        // Buat order_id unik dengan kombinasi booking_id dan timestamp
        $orderId = $booking->id . '-' . time() . '-' . rand(100, 999);

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
            'item_details' => [
                [
                    'id'       => $booking->id,
                    'price'    => $booking->total_price,
                    'quantity' => 1,
                    'name'     => 'Booking Lapangan #' . $booking->id,
                ]
            ],
        ];

        return Snap::getSnapToken($params);
    }
}
