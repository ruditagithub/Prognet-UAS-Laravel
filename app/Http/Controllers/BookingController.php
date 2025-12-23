<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function showBookingForm()
    {
        $rooms = Room::all();
        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        $validator = Validator::make($request->all(), [
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'room_id' => 'required|exists:rooms,id',
            'num_rooms' => 'required|integer|min:1',
            'total_price' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Mohon lengkapi form dengan benar.');
        }

        // Generate booking ID
        $lastBooking = Booking::orderBy('booking_id', 'desc')->first();
        $lastId = $lastBooking ? intval(str_replace('BKNG', '', $lastBooking->booking_id)) : 0;
        $newId = $lastId + 1;
        $bookingId = 'BKNG' . $newId;

        // Clean total price
        $totalPrice = str_replace(['IDR ', ','], '', $request->total_price);

        Booking::create([
            'booking_id' => $bookingId,
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'num_rooms' => $request->num_rooms,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('home')->with('success', 'Booking berhasil!');
    }
}
