@extends('layouts.app')

@section('title', 'Our Rooms - Grand Aveline')

@push('styles')
    <style>
        .room-card {
            transition: transform 0.3s ease;
        }
        .room-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush

@section('content')
    <main class="container mx-auto p-5 mt-20">
        <h1 class="text-4xl font-bold text-center text-gray-900 mb-10" style="font-family: Raleway,serif;">Our Rooms</h1>
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="categoryFilter" class="block text-gray-700 text-sm font-bold mb-2">Filter by Room Type:</label>
                <input type="text" id="categoryFilter" onkeyup="filterRooms()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter room type (e.g., Standard, Deluxe, Suite)">
            </div>
            <div>
                <label for="priceFilter" class="block text-gray-700 text-sm font-bold mb-2">Filter by Price (max):</label>
                <input type="number" id="priceFilter" onkeyup="filterRooms()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter max price">
            </div>
            <div>
                <label for="guestFilter" class="block text-gray-700 text-sm font-bold mb-2">Filter by Guests:</label>
                <select id="guestFilter" onchange="filterRooms()" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select guests</option>
                    <option value="1">1 Guest</option>
                    <option value="2">2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" style="font-family: 'Open Sans', serif;">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="Standard Room" data-room-price="700000" data-room-guests="1">
                <img class="w-full h-48 object-cover" src="{{ asset('images/standard.jpg') }}" alt="Single Room">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Standard Room</h2>
                    <p class="text-gray-700 mb-4">A room perfect for solo travelers. Includes a single bed, free Wi-Fi, and a private bathroom.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp700.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 1 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="Superior Room" data-room-price="1500000" data-room-guests="1,2">
                <img class="w-full h-48 object-cover" src="{{ asset('images/superior.jpg') }}" alt="Double Room">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Superior Room</h2>
                    <p class="text-gray-700 mb-4">Ideal for couples or friends. Features a double bed, free Wi-Fi, and a private bathroom.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp1.500.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 1-2 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="Suite Room" data-room-price="2300000" data-room-guests="3,4">
                <img class="w-full h-48 object-cover" src="{{ asset('images/suite.jpg') }}" alt="Suite">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Suite Room</h2>
                    <p class="text-gray-700 mb-4">Luxurious suite with a king-size bed, living area, free Wi-Fi, and a private bathroom.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp2.300.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 3-4 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="Deluxe Room" data-room-price="1300000" data-room-guests="2,3">
                <img class="w-full h-48 object-cover" src="{{ asset('images/deluxe.jpg') }}" alt="Deluxe Room">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Deluxe Room</h2>
                    <p class="text-gray-700 mb-4">A spacious room with premium amenities, including a minibar, electric kettle, larger TV.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp1.300.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 2-3 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Card 5 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="Family Room" data-room-price="1800000" data-room-guests="4,5">
                <img class="w-full h-48 object-cover" src="{{ asset('images/family.jpg') }}" alt="Family Room">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Family Room</h2>
                    <p class="text-gray-700 mb-4">A spacious room for families, with extra beds or bunk beds for children.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp1.800.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 4-5 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Card 6 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="Executive Room" data-room-price="1700000" data-room-guests="1,2">
                <img class="w-full h-48 object-cover" src="{{ asset('images/executive.jpg') }}" alt="Executive Room">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Executive Room</h2>
                    <p class="text-gray-700 mb-4">A business-friendly room with a large desk, fast Wi-Fi, and premium facilities.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp1.700.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 1-2 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>
            <!-- Card 7 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="View Room" data-room-price="1700000" data-room-guests="2,3">
                <img class="w-full h-48 object-cover" src="{{ asset('images/view.jpg') }}" alt="View Room">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">View Room</h2>
                    <p class="text-gray-700 mb-4">A room offering scenic views with varying amenities based on room class.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp1.700.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 2-3 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Card 8 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden room-card" data-room-type="Honeymoon Room" data-room-price="2500000" data-room-guests="2">
                <img class="w-full h-48 object-cover" src="{{ asset('images/honeymoon.jpg') }}" alt="Honeymoon Room">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Honeymoon Room</h2>
                    <p class="text-gray-700 mb-4">A romantic room for couples with luxurious amenities and special touches.</p>
                    <p class="text-gray-900 font-bold mb-4">Rp2.500.000 / night</p>
                    <p class="text-gray-700 flex items-center mb-4">
                        <span class="material-icons text-gray-600 mr-2">person</span> 2 Guest
                    </p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @else
                        <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="bg-[#451a03] hover:bg-[#fcd34d] text-white font-bold py-2 px-4 rounded inline-block text-center">
                            Book Now
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </main>
    @push('scripts')
        <script>
            function filterRooms() {
                const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
                const priceFilter = document.getElementById('priceFilter').value;
                const guestFilter = document.getElementById('guestFilter').value;
                const cards = document.getElementsByClassName('room-card');

                for (let i = 0; i < cards.length; i++) {
                    const card = cards[i];
                    const roomType = card.getAttribute('data-room-type').toLowerCase();
                    const roomPrice = parseInt(card.getAttribute('data-room-price'));
                    const roomGuests = card.getAttribute('data-room-guests').split(',').map(Number);

                    const matchesCategory = categoryFilter === '' || roomType.includes(categoryFilter);
                    const matchesPrice = priceFilter === '' || roomPrice <= parseInt(priceFilter);
                    const matchesGuests = guestFilter === '' || roomGuests.includes(parseInt(guestFilter));

                    if (matchesCategory && matchesPrice && matchesGuests) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                }
            }
        </script>
    @endpush
@endsection
