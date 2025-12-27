<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama',
        'username',
        'phone',
        'email',
        'password',
        'role', // Tambahkan ini
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }

    // Helper method untuk cek admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Helper method untuk cek user biasa
    public function isUser()
    {
        return $this->role === 'user';
    }
}
