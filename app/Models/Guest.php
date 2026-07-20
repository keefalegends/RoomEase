<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'nik'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
