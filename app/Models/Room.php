<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'room_type',
        'price',
        'available_rooms',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'available_rooms' => 'integer',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }
}
