<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();

        try {
            $booking = Booking::findOrFail($booking_id);

            // Kembalikan stok kamar jika booking confirmed
            if ($booking->status === 'confirmed') {
                $room = Room::findOrFail($booking->room_id);
                $room->increment('available_rooms', $booking->num_rooms);
            }

            $booking->delete();

            DB::commit();

            return redirect()->route('admin.index')->with('success', 'Booking deleted successfully! Stok kamar dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting booking: ' . $e->getMessage());
        }
    }
}
