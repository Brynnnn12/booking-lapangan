<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BookingController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'field', 'payment'])->where('user_id', Auth::id())->paginate(10);
        return view('dashboard.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Booking::create($data);
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        return view('dashboard.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $this->authorize('update', $booking);
        $booking->update($request->validated());
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }

    /**
     * Generate PDF receipt for booking
     */
    public function generateReceipt(Booking $booking)
    {
        $this->authorize('view', $booking);

        // Load booking with relationships
        $booking->load(['user', 'field', 'payment']);

        // Generate barcode
        try {
            $generator = new BarcodeGeneratorPNG();
            $barcodeData = str_pad($booking->id, 6, '0', STR_PAD_LEFT);
            $barcode = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcodeData, $generator::TYPE_CODE_128)) . '" alt="Barcode" style="width: 200px; height: 50px;">';
        } catch (\Exception $e) {
            // Fallback barcode as text
            $barcode = '<div style="text-align: center; font-family: monospace; font-size: 14px; padding: 10px; border: 1px solid #ccc;">' . str_pad($booking->id, 6, '0', STR_PAD_LEFT) . '</div>';
        }

        // Generate PDF
        try {
            $pdf = Pdf::loadView('pdf.booking-receipt', compact('booking', 'barcode'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'defaultFont' => 'DejaVu Sans',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => false
                ]);

            return $pdf->download('struk-booking-' . $booking->id . '.pdf');
        } catch (\Exception $e) {
            // Fallback: return simple HTML response
            return response()->view('pdf.booking-receipt', compact('booking', 'barcode'))
                ->header('Content-Type', 'text/html');
        }
    }
}
