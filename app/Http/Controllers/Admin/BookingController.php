<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function edit($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|string',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'num_rooms' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Error updating booking. Please try again.');
        }

        $booking = Booking::findOrFail($booking_id);
        $booking->update([
            'booking_id' => $request->booking_id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'num_rooms' => $request->num_rooms,
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('admin.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy($booking_id)
    {
        try {
            $booking = Booking::findOrFail($booking_id);
            $booking->delete();
            return redirect()->route('admin.index')->with('success', 'Booking deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting booking. Please try again.');
        }
    }
}
