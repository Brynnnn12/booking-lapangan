<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->paginate(10);
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
}
