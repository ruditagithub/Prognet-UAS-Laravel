<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function showBookingForm()
    {
        $rooms = Room::where('available_rooms', '>', 0)->get();
        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'checkin' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
            'checkout' => [
                'required',
                'date',
                'after:checkin'
            ],
            'room_id' => 'required|exists:rooms,id',
            'num_rooms' => 'required|integer|min:1',
            'total_price' => 'required|string',
        ], [
            'checkin.after_or_equal' => 'Tanggal check-in tidak boleh sebelum hari ini.',
            'checkout.after' => 'Tanggal check-out harus setelah check-in (minimal 1 hari).',
            'num_rooms.min' => 'Minimal booking 1 kamar.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Mohon perbaiki input Anda.');
        }

        // Validasi checkout minimal besok dari checkin
        $checkin = Carbon::parse($request->checkin);
        $checkout = Carbon::parse($request->checkout);

        if ($checkout->lessThanOrEqualTo($checkin)) {
            return back()->with('error', 'Check-out harus minimal 1 hari setelah check-in.')->withInput();
        }

        // Cek ketersediaan kamar
        $room = Room::findOrFail($request->room_id);

        if ($room->available_rooms < $request->num_rooms) {
            return back()->with('error', 'Maaf, kamar tidak tersedia. Tersisa ' . $room->available_rooms . ' kamar.')->withInput();
        }

        if ($room->available_rooms == 0) {
            return back()->with('error', 'Maaf, kamar sudah penuh. Tidak ada kamar tersedia.')->withInput();
        }

        // Mulai transaction
        DB::beginTransaction();

        try {
            // Generate booking ID
            $lastBooking = Booking::orderBy('booking_id', 'desc')->first();
            $lastId = $lastBooking ? intval(str_replace('BKNG', '', $lastBooking->booking_id)) : 0;
            $newId = $lastId + 1;
            $bookingId = 'BKNG' . $newId;

            // Clean total price - PERBAIKAN DI SINI
            // Hapus semua karakter kecuali angka
            $totalPrice = preg_replace('/[^0-9]/', '', $request->total_price);

            // Validasi apakah total price valid
            if (empty($totalPrice) || !is_numeric($totalPrice)) {
                throw new \Exception('Total price tidak valid');
            }

            // Create booking
            $booking = Booking::create([
                'booking_id' => $bookingId,
                'user_id' => Auth::id(),
                'room_id' => $request->room_id,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
                'num_rooms' => $request->num_rooms,
                'total_price' => $totalPrice,
                'status' => 'confirmed',
            ]);

            // Kurangi stok kamar
            $room->decrement('available_rooms', $request->num_rooms);

            DB::commit();

            return redirect()->route('bookings.mybookings')->with('success', 'Booking berhasil! Booking ID: ' . $bookingId);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function myBookings()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        $bookings = Booking::with('room')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookings.my-bookings', compact('bookings'));
    }

    public function cancel($booking_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        $booking = Booking::where('booking_id', $booking_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Cek apakah booking sudah lewat
        if ($booking->checkin->isPast()) {
            return back()->with('error', 'Tidak dapat membatalkan booking yang sudah berlalu.');
        }

        DB::beginTransaction();

        try {
            // Kembalikan stok kamar
            $room = Room::findOrFail($booking->room_id);
            $room->increment('available_rooms', $booking->num_rooms);

            // Update status booking
            $booking->update(['status' => 'cancelled']);

            DB::commit();

            return back()->with('success', 'Booking berhasil dibatalkan. Stok kamar dikembalikan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
