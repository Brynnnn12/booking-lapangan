<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'snap_token',
        'amount',
        'status'
    ];

    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
