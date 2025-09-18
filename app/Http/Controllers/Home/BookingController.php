<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('home.bookings', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Fetch the field to get price per hour
        $field = \App\Models\Field::findOrFail($request->field_id);
        $pricePerHour = $field->price_per_hour;

        // Calculate duration in hours
        $startTime = \Carbon\Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = \Carbon\Carbon::createFromFormat('H:i', $request->end_time);
        $durationInHours = $startTime->diffInHours($endTime);

        // Calculate total price
        $totalPrice = $pricePerHour * $durationInHours;

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $request->field_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Automatically create payment
        \App\Models\Payment::create([
            'booking_id' => $booking->id,
            'amount' => $totalPrice,
            'status' => 'pending', // or whatever default status
        ]);

        //midtrans config
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$clientKey = config('services.midtrans.client_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => $totalPrice,
            ],

            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $payment->update([
            'snap_token' => $snapToken,
        ])

        return response()->json([
            'snap_token' => $snapToken,
            'payment_id' => $payment->id,
        ]);
    }
}
