<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'guest_id',
        'reservation_code',
        'check_in',
        'check_out',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function reservationDetails()
    {
        return $this->hasMany(ReservationDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
