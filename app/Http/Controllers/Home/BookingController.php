<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Field;
use App\Models\Payment;
use App\Http\Requests\StoreBookingRequest;
use Midtrans\Transaction;

class BookingController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $fields = Field::paginate(10);
        return view('home.fields', compact('fields'));
    }

    public function create(Request $request)
    {
        $fields = Field::all();
        $selectedField = null;
        if ($request->has('field_id')) {
            $selectedField = Field::find($request->field_id);
        }
        return view('home.booking-create', compact('fields', 'selectedField'));
    }

    public function myBookings()
    {
        $bookings = Booking::with('payment', 'field')
            ->where('user_id', Auth::id())
            ->get();

        return view('home.bookings', compact('bookings'))->with('success', 'Berhasil memuat daftar booking Anda.');
    }

    public function store(StoreBookingRequest $request)
    {
        // Ambil harga lapangan
        $field = Field::findOrFail($request->field_id);

        // Hitung durasi booking (jam)
        $duration = (strtotime($request->end_time) - strtotime($request->start_time)) / 3600;

        if ($duration <= 0) {
            return response()->json(['message' => 'Waktu booking tidak valid'], 400);
        }

        // Hitung total harga
        $totalPrice = $duration * $field->price_per_hour;

        // Cek bentrok booking
        $existingBooking = Booking::where('field_id', $field->id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })
            ->first();

        if ($existingBooking) {
            return response()->json(['message' => 'Lapangan sudah dipesan pada waktu ini'], 400);
        }

        // Simpan booking
        $booking = Booking::create([
            'user_id'      => Auth::id(),
            'field_id'     => $request->field_id,
            'booking_date' => $request->booking_date,
            'start_time'   => $request->start_time,
            'end_time'     => $request->end_time,
            'total_price'  => $totalPrice,
            'status'       => 'pending',
        ]);

        // Simpan payment (pakai booking_id sebagai order_id)
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount'     => $totalPrice,
            'status'     => 'pending',
            'order_id'   => $booking->id, // order_id = booking_id
        ]);

        // Buat Snap Token
        $snapToken = $this->paymentService->createSnapToken($booking, Auth::user());
        $payment->update(['snap_token' => $snapToken]);

        return response()->json([
            'snap_token' => $snapToken,
            'booking_id' => $booking->id,
            'payment_id' => $payment->id,
        ]);
    }


    // Midtrans callback
    public function callback(Request $request)
    {
        $bookingId = $request->order_id; // order_id = booking_id
        $transactionStatus = $request->transaction_status;


        $booking = Booking::find($bookingId);
        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $payment = $booking->payment;

        if (in_array($transactionStatus, ['settlement', 'capture'])) {
            $payment->update(['status' => 'paid']);
            $booking->update(['status' => 'confirmed']);
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            $payment->update(['status' => 'failed']);
            $booking->update(['status' => 'canceled']);
        } elseif ($transactionStatus === 'pending') {
            $payment->update(['status' => 'pending']);
            $booking->update(['status' => 'pending']);
        }

        return response()->json(['message' => 'Callback processed']);
    }


    public function checkStatus($bookingId)
    {
        $booking = Booking::with('payment')->find($bookingId);

        if (! $booking || ! $booking->payment) {
            return response()->json(['message' => 'Booking atau Payment tidak ditemukan'], 404);
        }

        try {
            // Ambil status dari Midtrans
            $status = Transaction::status($booking->id);

            $transactionStatus = $status->transaction_status;


            if (in_array($transactionStatus, ['settlement', 'capture'])) {
                $booking->payment->update(['status' => 'paid']);
                $booking->update(['status' => 'confirmed']);
            } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                $booking->payment->update(['status' => 'failed']);
                $booking->update(['status' => 'canceled']);
            } else { // pending
                $booking->payment->update(['status' => 'pending']);
                $booking->update(['status' => 'pending']);
            }

            return response()->json([
                'message' => 'Status diperbarui',
                'booking_status' => $booking->status,
                'payment_status' => $booking->payment->status,
                'midtrans_status' => $transactionStatus,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal cek status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
