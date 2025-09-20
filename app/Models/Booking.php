<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'string',
        'end_time' => 'string',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get duration in hours
     */
    public function getDurationInHours(): float
    {
        try {
            // Handle different time formats
            $startTimeStr = is_string($this->start_time) ? $this->start_time : $this->start_time->format('H:i');
            $endTimeStr = is_string($this->end_time) ? $this->end_time : $this->end_time->format('H:i');

            $startTime = \Carbon\Carbon::createFromFormat('H:i', $startTimeStr);
            $endTime = \Carbon\Carbon::createFromFormat('H:i', $endTimeStr);

            return $startTime->diffInHours($endTime);
        } catch (\Exception $e) {
            // Fallback: calculate duration manually
            $startParts = explode(':', $this->start_time);
            $endParts = explode(':', $this->end_time);

            if (count($startParts) === 2 && count($endParts) === 2) {
                $startMinutes = (int)$startParts[0] * 60 + (int)$startParts[1];
                $endMinutes = (int)$endParts[0] * 60 + (int)$endParts[1];
                return round(($endMinutes - $startMinutes) / 60, 2);
            }

            return 1.0; // Default fallback
        }
    }
}
