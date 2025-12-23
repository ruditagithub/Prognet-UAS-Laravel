@extends('layouts.app')

@section('title', 'Book Now - Grand Aveline')

@section('content')
    <!-- Booking Form Section -->
    <main class="flex-grow flex items-center justify-center p-4 min-h-screen" data-aos="fade-up">
        <div class="container mx-auto p-6 max-w-2xl">
            <div class="bg-[#451a03] p-8 rounded-2xl shadow-2xl flex flex-col bg-opacity-90">
                <!-- Form Title -->
                <div class="mb-8 text-center">
                    <h1 class="text-4xl font-bold mb-4 text-white" style="font-family: Raleway, serif;">Hotel Booking Form</h1>
                    <p class="text-white mb-6 leading-relaxed">
                        Please fill out the form to book your stay at our hotel.
                    </p>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Booking Form -->
                <form class="flex flex-col space-y-4" action="{{ route('bookings.store') }}" method="POST" data-aos="zoom-in">
                    @csrf
                    <!-- Check-in Date -->
                    <div>
                        <label for="checkin" class="block text-white font-semibold mb-2">Check-in Date</label>
                        <input type="date" id="checkin" name="checkin" value="{{ old('checkin') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Check-out Date -->
                    <div>
                        <label for="checkout" class="block text-white font-semibold mb-2">Check-out Date</label>
                        <input type="date" id="checkout" name="checkout" value="{{ old('checkout') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Room Type -->
                    <div>
                        <label for="room" class="block text-white font-semibold mb-2">Room Type</label>
                        <select id="room" name="room" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="700000" data-room-id="RM1" {{ old('room') == '700000' ? 'selected' : '' }}>Standard Room - Rp 700,000</option>
                            <option value="1500000" data-room-id="RM2" {{ old('room') == '1500000' ? 'selected' : '' }}>Superior Room - Rp 1,500,000</option>
                            <option value="2300000" data-room-id="RM3" {{ old('room') == '2300000' ? 'selected' : '' }}>Suite Room - Rp 2,300,000</option>
                            <option value="1300000" data-room-id="RM4" {{ old('room') == '1300000' ? 'selected' : '' }}>Deluxe Room - Rp 1,300,000</option>
                            <option value="1800000" data-room-id="RM5" {{ old('room') == '1800000' ? 'selected' : '' }}>Family Room - Rp 1,800,000</option>
                            <option value="1700000" data-room-id="RM6" {{ old('room') == '1700000' ? 'selected' : '' }}>Executive Room - Rp 1,700,000</option>
                            <option value="1700000" data-room-id="RM7" {{ old('room') == '1700000' ? 'selected' : '' }}>View Room - Rp 1,700,000</option>
                            <option value="2500000" data-room-id="RM8" {{ old('room') == '2500000' ? 'selected' : '' }}>Honeymoon Room - Rp 2,500,000</option>
                        </select>
                    </div>

                    <!-- Number of Rooms -->
                    <div>
                        <label for="num-rooms" class="block text-white font-semibold mb-2">Number of Rooms</label>
                        <input type="number" id="num-rooms" name="num_rooms" value="{{ old('num_rooms', 1) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" required>
                    </div>

                    <!-- Total Price -->
                    <div>
                        <label for="total-price" class="block text-white font-semibold mb-2">Total Price</label>
                        <input type="text" id="total-price" name="total_price" value="{{ old('total_price') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                    </div>

                    <!-- Hidden input for room_id -->
                    <input type="hidden" id="room_id" name="room_id" value="{{ old('room_id', 'RM1') }}">

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-[#9a3412] text-white px-6 py-3 rounded-lg hover:bg-[#ea580c] transition duration-300 shadow-md self-center">
                            Book Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            function calculatePrice() {
                var roomSelect = document.getElementById('room');
                var roomPrice = parseInt(roomSelect.value);
                var roomId = roomSelect.options[roomSelect.selectedIndex].getAttribute('data-room-id');
                var numRooms = parseInt(document.getElementById('num-rooms').value);
                var totalPriceField = document.getElementById('total-price');
                var roomIdInput = document.getElementById('room_id');

                if (roomPrice > 0 && numRooms > 0) {
                    var totalPrice = roomPrice * numRooms;
                    totalPriceField.value = "IDR " + totalPrice.toLocaleString();
                } else {
                    totalPriceField.value = "";
                }

                roomIdInput.value = roomId;
            }

            // Add event listeners to update total price automatically
            document.getElementById('room').addEventListener('input', calculatePrice);
            document.getElementById('num-rooms').addEventListener('input', calculatePrice);

            // Calculate price on page load
            window.addEventListener('load', calculatePrice);

            @if(session('success'))
            setTimeout(function() {
                alert('{{ session('success') }}');
                window.location.href = '{{ route('home') }}';
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
