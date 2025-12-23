<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $bookings = Booking::all();
        $rooms = Room::all();

        return view('admin.index', compact('users', 'bookings', 'rooms'));
    }
}
