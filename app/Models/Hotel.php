<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'description'];

    public function roomTypes()
    {
        return $this->hasMany(RoomType::class);
    }
}
