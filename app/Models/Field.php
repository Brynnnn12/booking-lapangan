<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /** @use HasFactory<\Database\Factories\FieldFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'type',
        'price_per_hour',
        'photo',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
