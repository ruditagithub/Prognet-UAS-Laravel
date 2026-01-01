<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'booking_id',
        'user_id',
        'room_id',
        'checkin',
        'checkout',
        'num_rooms',
        'total_price',
        'status',
    ];

    protected $casts = [
        'checkin' => 'date',
        'checkout' => 'date',
        'num_rooms' => 'integer',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    // Helper: Hitung durasi menginap
    public function getDurationAttribute()
    {
        return $this->checkin->diffInDays($this->checkout);
    }

    // Helper: Format total price
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    // Helper: Status badge color
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'confirmed' => 'green',
            'pending' => 'yellow',
            'cancelled' => 'red',
            default => 'gray'
        };
    }
}
