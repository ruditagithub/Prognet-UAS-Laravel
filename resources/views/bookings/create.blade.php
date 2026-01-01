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
                        <ul class="list-disc list-inside">
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
                        <input
                            type="date"
                            id="checkin"
                            name="checkin"
                            value="{{ old('checkin', date('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <small class="text-gray-300">Minimal hari ini</small>
                    </div>

                    <!-- Check-out Date -->
                    <div>
                        <label for="checkout" class="block text-white font-semibold mb-2">Check-out Date</label>
                        <input
                            type="date"
                            id="checkout"
                            name="checkout"
                            value="{{ old('checkout', date('Y-m-d', strtotime('+1 day'))) }}"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <small class="text-gray-300">Minimal 1 hari setelah check-in</small>
                    </div>

                    <!-- Room Type -->
                    <div>
                        <label for="room" class="block text-white font-semibold mb-2">Room Type</label>
                        <select id="room" name="room_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">-- Pilih Tipe Kamar --</option>
                            @foreach($rooms as $room)
                                <option
                                    value="{{ $room->id }}"
                                    data-price="{{ $room->price }}"
                                    data-available="{{ $room->available_rooms }}"
                                    {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_type }} - Rp {{ number_format($room->price, 0, ',', '.') }}
                                    (Tersedia: {{ $room->available_rooms }} kamar)
                                </option>
                            @endforeach
                        </select>
                        <small id="stock-info" class="text-gray-300"></small>
                    </div>

                    <!-- Number of Rooms -->
                    <div>
                        <label for="num-rooms" class="block text-white font-semibold mb-2">Number of Rooms</label>
                        <input
                            type="number"
                            id="num-rooms"
                            name="num_rooms"
                            value="{{ old('num_rooms', 1) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            min="1"
                            max="10"
                            required>
                        <small class="text-gray-300">Maksimal sesuai stok tersedia</small>
                    </div>

                    <!-- Total Price -->
                    <div>
                        <label for="total-price" class="block text-white font-semibold mb-2">Total Price</label>
                        <input
                            type="text"
                            id="total-price"
                            name="total_price"
                            value="{{ old('total_price') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100"
                            readonly>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button
                            type="submit"
                            id="submit-btn"
                            class="bg-[#9a3412] text-white px-6 py-3 rounded-lg hover:bg-[#ea580c] transition duration-300 shadow-md self-center disabled:opacity-50 disabled:cursor-not-allowed">
                            Book Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            const roomSelect = document.getElementById('room');
            const numRoomsInput = document.getElementById('num-rooms');
            const totalPriceInput = document.getElementById('total-price');
            const checkinInput = document.getElementById('checkin');
            const checkoutInput = document.getElementById('checkout');
            const stockInfo = document.getElementById('stock-info');
            const submitBtn = document.getElementById('submit-btn');

            function calculatePrice() {
                const selectedOption = roomSelect.options[roomSelect.selectedIndex];

                if (!selectedOption.value) {
                    totalPriceInput.value = '';
                    stockInfo.textContent = '';
                    submitBtn.disabled = true;
                    return;
                }

                const roomPrice = parseInt(selectedOption.dataset.price);
                const availableStock = parseInt(selectedOption.dataset.available);
                const numRooms = parseInt(numRoomsInput.value);

                // Validasi stok
                if (availableStock === 0) {
                    stockInfo.textContent = '❌ Kamar tidak tersedia!';
                    stockInfo.classList.add('text-red-400');
                    submitBtn.disabled = true;
                    totalPriceInput.value = 'Tidak Tersedia';
                    return;
                }

                if (numRooms > availableStock) {
                    stockInfo.textContent = `❌ Stok tidak cukup! Hanya tersedia ${availableStock} kamar`;
                    stockInfo.classList.add('text-red-400');
                    submitBtn.disabled = true;
                    return;
                } else {
                    stockInfo.textContent = `✅ Tersedia ${availableStock} kamar`;
                    stockInfo.classList.remove('text-red-400');
                    stockInfo.classList.add('text-green-400');
                    submitBtn.disabled = false;
                }

                // Set max attribute
                numRoomsInput.max = availableStock;

                // Calculate total
                if (roomPrice > 0 && numRooms > 0) {
                    const totalPrice = roomPrice * numRooms;
                    totalPriceInput.value = "IDR " + totalPrice.toLocaleString('id-ID');
                } else {
                    totalPriceInput.value = "";
                }
            }

            // Validasi tanggal checkout
            function validateCheckout() {
                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);

                if (checkout <= checkin) {
                    checkoutInput.setCustomValidity('Check-out harus minimal 1 hari setelah check-in');
                } else {
                    checkoutInput.setCustomValidity('');
                }
            }

            // Event listeners
            roomSelect.addEventListener('change', calculatePrice);
            numRoomsInput.addEventListener('input', calculatePrice);
            checkinInput.addEventListener('change', function() {
                // Set min checkout = checkin + 1 day
                const checkin = new Date(this.value);
                checkin.setDate(checkin.getDate() + 1);
                checkoutInput.min = checkin.toISOString().split('T')[0];
                validateCheckout();
            });
            checkoutInput.addEventListener('change', validateCheckout);

            // Calculate on page load
            window.addEventListener('load', calculatePrice);

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
