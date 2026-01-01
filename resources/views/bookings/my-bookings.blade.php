@extends('layouts.app')

@section('title', 'My Bookings - Grand Aveline')

@push('styles')
    <style>
        .booking-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status-confirmed { background-color: #10b981; color: white; }
        .status-pending { background-color: #f59e0b; color: white; }
        .status-cancelled { background-color: #ef4444; color: white; }
    </style>
@endpush

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800" style="font-family: 'Raleway', serif;">My Bookings</h1>
                    <p class="text-gray-600 mt-2 text-sm md:text-base">Kelola dan lihat riwayat booking Anda</p>
                </div>
                <a href="{{ route('bookings.create') }}" class="bg-[#451a03] text-white px-6 py-3 rounded-lg hover:bg-[#7a3e1f] transition duration-300 shadow-md whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i> Book New Room
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Bookings List -->
            @if($bookings->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    @foreach($bookings as $booking)
                        <div class="booking-card bg-white rounded-xl shadow-lg overflow-hidden">
                            <!-- Card Header -->
                            <div class="bg-gradient-to-r from-[#451a03] to-[#7a3e1f] text-white p-4 md:p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start gap-2">
                                    <div class="flex-1">
                                        <h3 class="text-xl md:text-2xl font-bold mb-1">{{ $booking->room->room_type }}</h3>
                                        <p class="text-xs md:text-sm opacity-90">Booking ID: {{ $booking->booking_id }}</p>
                                    </div>
                                    <span class="status-badge status-{{ $booking->status }}">
                                {{ $booking->status }}
                            </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-4 md:p-6">
                                <!-- Metadata -->
                                <div class="grid grid-cols-2 gap-3 md:gap-4 mb-4">
                                    <div class="flex items-start gap-2">
                                        <i class="fas fa-calendar-check text-[#451a03] text-lg md:text-xl mt-1"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Check-in</p>
                                            <p class="font-semibold text-sm md:text-base truncate">{{ $booking->checkin->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <i class="fas fa-calendar-times text-[#451a03] text-lg md:text-xl mt-1"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Check-out</p>
                                            <p class="font-semibold text-sm md:text-base truncate">{{ $booking->checkout->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3 md:gap-4 mb-4">
                                    <div class="flex items-start gap-2">
                                        <i class="fas fa-door-open text-[#451a03] text-lg md:text-xl mt-1"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Jumlah Kamar</p>
                                            <p class="font-semibold text-sm md:text-base">{{ $booking->num_rooms }} Kamar</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <i class="fas fa-moon text-[#451a03] text-lg md:text-xl mt-1"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500">Durasi</p>
                                            <p class="font-semibold text-sm md:text-base">{{ $booking->checkin->diffInDays($booking->checkout) }} Malam</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="border-t pt-4 mb-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600 text-sm md:text-base">Total Harga:</span>
                                        <span class="text-xl md:text-2xl font-bold text-[#451a03]">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Booking Date -->
                                <div class="text-xs md:text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    Dibuat: {{ $booking->created_at->format('d M Y, H:i') }}
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col sm:flex-row gap-2">
                                    @if($booking->status === 'confirmed' && $booking->checkin->isFuture())
                                        <form action="{{ route('bookings.cancel', $booking->booking_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini? Stok kamar akan dikembalikan.');">
                                            @csrf
                                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300 text-sm md:text-base">
                                                <i class="fas fa-times-circle mr-2"></i> Cancel Booking
                                            </button>
                                        </form>
                                    @endif

                                    @if($booking->status === 'cancelled')
                                        <div class="flex-1 bg-gray-200 text-gray-600 px-4 py-2 rounded-lg text-center text-sm md:text-base">
                                            <i class="fas fa-ban mr-2"></i> Dibatalkan
                                        </div>
                                    @endif

                                    @if($booking->checkin->isPast() && $booking->status === 'confirmed')
                                        <div class="flex-1 bg-blue-100 text-blue-800 px-4 py-2 rounded-lg text-center text-sm md:text-base">
                                            <i class="fas fa-check-circle mr-2"></i> Selesai
                                        </div>
                                    @endif

                                    @if($booking->checkin->isFuture() && $booking->status === 'confirmed')
                                        <div class="flex-1 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg text-center text-sm md:text-base">
                                            <i class="fas fa-hourglass-half mr-2"></i> Menunggu
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-800">Statistik Booking</h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                        <div class="text-center p-3 md:p-4 bg-blue-50 rounded-lg">
                            <p class="text-2xl md:text-3xl font-bold text-blue-600">{{ $bookings->count() }}</p>
                            <p class="text-xs md:text-sm text-gray-600 mt-1">Total Bookings</p>
                        </div>
                        <div class="text-center p-3 md:p-4 bg-green-50 rounded-lg">
                            <p class="text-2xl md:text-3xl font-bold text-green-600">{{ $bookings->where('status', 'confirmed')->count() }}</p>
                            <p class="text-xs md:text-sm text-gray-600 mt-1">Confirmed</p>
                        </div>
                        <div class="text-center p-3 md:p-4 bg-red-50 rounded-lg">
                            <p class="text-2xl md:text-3xl font-bold text-red-600">{{ $bookings->where('status', 'cancelled')->count() }}</p>
                            <p class="text-xs md:text-sm text-gray-600 mt-1">Cancelled</p>
                        </div>
                        <div class="text-center p-3 md:p-4 bg-purple-50 rounded-lg col-span-2 lg:col-span-1">
                            <p class="text-xl md:text-2xl lg:text-3xl font-bold text-purple-600 break-all">Rp {{ number_format($bookings->where('status', 'confirmed')->sum('total_price'), 0, ',', '.') }}</p>
                            <p class="text-xs md:text-sm text-gray-600 mt-1">Total Spent</p>
                        </div>
                    </div>
                </div>

            @else
                <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 text-center">
                    <i class="fas fa-calendar-times text-gray-300 text-5xl md:text-6xl mb-4"></i>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">Belum Ada Booking</h3>
                    <p class="text-sm md:text-base text-gray-600 mb-6">Anda belum melakukan booking. Mulai pesan kamar sekarang!</p>
                    <a href="{{ route('bookings.create') }}" class="inline-block bg-[#451a03] text-white px-6 md:px-8 py-3 rounded-lg hover:bg-[#7a3e1f] transition duration-300 shadow-md">
                        <i class="fas fa-plus mr-2"></i> Book Your First Room
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            @if(session('success'))
            setTimeout(function() {
                alert('{{ session('success') }}');
            }, 100);
            @endif

            @if(session('error'))
            setTimeout(function() {
                alert('{{ session('error') }}');
            }, 100);
            @endif
        </script>
    @endpush
@endsection
