@extends('layouts.app')

@section('title', 'Grand Aveline - Home')

@section('content')
    <!-- Hero Section -->
    <section class="relative">
        <img alt="Aerial view of Avallon hotel with pool" class="w-full h-screen object-cover" src="{{ asset('images/hotelpage.jpg') }}"/>
        <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center text-center text-white z-40" data-aos="fade-up">
            <h1 class="text-5xl md:text-6xl" style="font-family: 'Raleway', serif;">
                Welcome to Our Hotel
            </h1>
            <p class="text-lg md:text-xl mt-4" style="font-family: Merriweather, serif;">
                Grand Aveline Resort & Spa
            </p>
            @auth
                <a href="{{ route('bookings.create') }}" class="mt-8 px-8 py-3 bg-[#451a03] text-white font-semibold rounded-2xl inline-block hover:bg-[#7a3e1f] hover:scale-105 transition-all duration-300 ease-in-out">
                    BOOK NOW
                </a>
            @else
                <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="mt-8 px-8 py-3 bg-[#451a03] text-white font-semibold rounded-2xl inline-block hover:bg-[#7a3e1f] hover:scale-105 transition-all duration-300 ease-in-out">
                    BOOK NOW
                </a>
            @endauth
        </div>
    </section>

    <!-- Main Content -->
    <main class="px-6 md:px-12 lg:px-24 py-12">
        <!-- About Section -->
        <section class="flex flex-col md:flex-row items-center mb-16" id="about">
            <div class="md:w-1/2 md:pr-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-6" style="font-family: Merriweather, serif;">
                    About
                </h2>
                <p class="text-lg md:text-xl mb-8 leading-relaxed" style="font-family: 'Open Sans', serif;">
                    A perfect blend of modern luxury and timeless elegance in the heart of Bali. Offering a range of exceptional services, we cater to both business and leisure travelers.
                </p>
                <div id="about-more" class="hidden">
                    <p class="text-lg md:text-xl mb-8 leading-relaxed" style="font-family: 'Open Sans', serif;">
                        Our hotel features a stunning infinity pool, a world-class spa, and gourmet dining options that will make your stay unforgettable. We also offer personalized services to ensure that every guest feels special and valued.
                    </p>
                </div>
                <a href="#" id="about-toggle" class="text-[#451a03] font-semibold border-b-2 border-[#451a03] hover:text-[#92400e] hover:border-[#451a03] transition">
                    Read More
                </a>
            </div>
            <div class="md:w-1/2 mt-8 md:mt-0">
                <img alt="Spacious hotel room with modern amenities" class="w-full rounded-xl shadow-lg" src="{{ asset('images/aboutni.jpg') }}">
            </div>
        </section>

        <!-- History Section -->
        <section class="flex flex-col md:flex-row-reverse items-center mb-16">
            <div class="md:w-1/2 md:pl-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-6" style="font-family: Merriweather, serif;">
                    History
                </h2>
                <p class="text-lg md:text-xl mb-8 leading-relaxed" style="font-family: 'Open Sans', serif;">
                    Hotel Grand Aveline was founded in 2001 with a vision to redefine luxury in hospitality. From a humble boutique hotel to a symbol of excellence and innovation, we have welcomed guests from around the world and continue to evolve to meet the needs of the future.
                </p>
                <div id="history-more" class="hidden">
                    <p class="text-lg md:text-xl mb-8 leading-relaxed" style="font-family: 'Open Sans', serif;">
                        Over the years, we have expanded our services and facilities to ensure that every guest has a memorable experience. Our commitment to quality and service has made us a favorite among travelers.
                    </p>
                </div>
                <a href="#" id="history-toggle" class="text-[#451a03] font-semibold border-b-2 border-[#451a03] hover:text-[#92400e] hover:border-[#451a03] transition">
                    Read More
                </a>
            </div>
            <div class="md:w-1/2 mt-8 md:mt-0">
                <img alt="Spacious hotel room with modern amenities" class="w-full rounded-xl shadow-lg" src="{{ asset('images/historyni.jpg') }}">
            </div>
        </section>

        <section class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-[#451a03]" style="font-family: 'Raleway', serif;">Rooms Include</h2>
        </section>

        <section class="container mx-auto px-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-6">
                <div class="card bg-white p-6 rounded-2xl shadow-lg text-center" data-aos="zoom-in">
                    <i class="fas fa-utensils text-4xl text-[#451a03] mb-4"></i>
                    <p class="text-lg">Breakfast</p>
                </div>

                <div class="card bg-white p-6 rounded-2xl shadow-lg text-center" data-aos="zoom-in">
                    <i class="fas fa-wifi text-4xl text-[#451a03] mb-4"></i>
                    <p class="text-lg">Free Wifi</p>
                </div>

                <div class="card bg-white p-6 rounded-2xl shadow-lg text-center" data-aos="zoom-in">
                    <i class="fas fa-concierge-bell text-4xl text-[#451a03] mb-4"></i>
                    <p class="text-lg">Room Service</p>
                </div>

                <div class="card bg-white p-6 rounded-2xl shadow-lg text-center" data-aos="zoom-in">
                    <i class="fas fa-wine-glass text-4xl text-[#451a03] mb-4"></i>
                    <p class="text-lg">Welcome Drink</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Facilities Section -->
    <section class="px-6 md:px-12 lg:px-24 py-12" id="facilities">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-12 text-[#451a03]" style="font-family: 'Raleway', serif;">
            Facilities
        </h1>
        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="card bg-[#451a03] text-white shadow-lg rounded-lg overflow-hidden hover:bg-[#5a2605] transition duration-300" data-aos="zoom-in">
                <img alt="Modern gym with various equipment" src="{{ asset('images/gym.jpg') }}" class="w-full h-48 object-cover">
                <div class="card-content p-4">
                    <h2 class="text-xl font-bold mb-2">State-of-the-art Gym</h2>
                    <p class="text-sm">
                        Equipped with the latest fitness machines and free weights to keep you in shape during your stay.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card bg-[#451a03] text-white shadow-lg rounded-lg overflow-hidden hover:bg-[#5a2605] transition duration-300" data-aos="zoom-in">
                <img alt="Elegant restaurant dining area" src="{{ asset('images/restaurant.jpg') }}" class="w-full h-48 object-cover">
                <div class="card-content p-4">
                    <h2 class="text-xl font-bold mb-2">Gourmet Restaurant</h2>
                    <p class="text-sm">
                        Enjoy a fine dining experience with a variety of international cuisines prepared by our top chefs.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card bg-[#451a03] text-white shadow-lg rounded-lg overflow-hidden hover:bg-[#5a2605] transition duration-300" data-aos="zoom-in">
                <img alt="Children's playground with various play equipment" src="{{ asset('images/playground.jpg') }}" class="w-full h-48 object-cover">
                <div class="card-content p-4">
                    <h2 class="text-xl font-bold mb-2">Kids' Playground</h2>
                    <p class="text-sm">
                        A fun and safe area for children to play and enjoy their time.
                    </p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="card bg-[#451a03] text-white shadow-lg rounded-lg overflow-hidden hover:bg-[#5a2605] transition duration-300" data-aos="zoom-in">
                <img alt="Luxurious swimming pool area" src="{{ asset('images/swimmingpool.jpg') }}" class="w-full h-48 object-cover">
                <div class="card-content p-4">
                    <h2 class="text-xl font-bold mb-2">Swimming Pool</h2>
                    <p class="text-sm">
                        Relax and unwind in our outdoor swimming pool with a stunning view.
                    </p>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="card bg-[#451a03] text-white shadow-lg rounded-lg overflow-hidden hover:bg-[#5a2605] transition duration-300" data-aos="zoom-in">
                <img alt="Cozy library with bookshelves" src="{{ asset('images/library.jpg') }}" class="w-full h-48 object-cover">
                <div class="card-content p-4">
                    <h2 class="text-xl font-bold mb-2">Cozy Library</h2>
                    <p class="text-sm">
                        A quiet place to read and relax with a wide selection of books.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Seller Section -->
    <section class="relative px-6 md:px-12 lg:px-24 py-12" style="font-family: roboto , serif;" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-[#451a03] text-center mb-10" style="font-family: 'Raleway', serif;">
            Best Seller
        </h2>
        <div class="relative w-10/12 md:w-8/12 lg:w-6/12 mx-auto shadow-xl rounded-lg overflow-hidden mb-8">
            <img alt="Luxurious hotel room with modern decor" class="w-full h-full object-cover" src="{{ asset('images/kamar1.jpg') }}"/>

            <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center text-center text-white p-6">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 text-shadow-lg">
                    Standard Room
                </h2>

                <p class="text-lg md:text-xl lg:text-2xl mb-6 text-shadow-lg">
                    Kamar standar dengan fasilitas dasar yang nyaman dan praktis untuk tamu yang mencari kenyamanan tanpa banyak tambahan.
                </p>

                <div class="flex items-center justify-center mt-6 space-x-4">
                    <div class="flex items-center">
                        <i class="material-icons text-xl">person</i>
                        <span class="ml-2">1 Guests</span>
                    </div>
                </div>

                <p class="text-3xl md:text-4xl font-bold mt-4">
                    Rp.700.000
                    <span class="text-lg">/ Malam</span>
                </p>

                @auth
                    <a href="{{ route('bookings.create') }}" class="mt-6 px-8 py-3 bg-[#451a03] text-white font-semibold rounded-2xl inline-block hover:bg-[#7a3e1f] hover:scale-105 transition-all duration-300 ease-in-out" data-aos="zoom-in">
                        BOOK ROOMS
                    </a>
                @else
                    <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="mt-6 px-8 py-3 bg-[#451a03] text-white font-semibold rounded-2xl inline-block hover:bg-[#7a3e1f] hover:scale-105 transition-all duration-300 ease-in-out" data-aos="zoom-in">
                        BOOK ROOMS
                    </a>
                @endauth
            </div>
        </div>

        <div class="relative w-10/12 md:w-8/12 lg:w-6/12 mx-auto shadow-xl rounded-lg overflow-hidden">
            <img alt="Luxurious hotel room with modern decor" class="w-full h-full object-cover" src="{{ asset('images/kamar1.jpg') }}"/>

            <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center text-center text-white p-6">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 text-shadow-lg">
                    Deluxe Room
                </h2>

                <p class="text-lg md:text-xl lg:text-xl mb-6 text-shadow-lg">
                    Kamar deluxe yang luas, dengan fasilitas premium dan pemandangan yang indah, cocok untuk tamu yang mencari pengalaman lebih mewah.
                </p>

                <div class="flex items-center justify-center mt-6 space-x-4">
                    <div class="flex items-center">
                        <i class="material-icons text-xl">person</i>
                        <span class="ml-2">2-3 Guests</span>
                    </div>
                </div>

                <p class="text-3xl md:text-4xl font-bold mt-4">
                    Rp1.300.000
                    <span class="text-lg">/ night</span>
                </p>

                @auth
                    <a href="{{ route('bookings.create') }}" class="mt-6 px-8 py-3 bg-[#451a03] text-white font-semibold rounded-2xl inline-block hover:bg-[#7a3e1f] hover:scale-105 transition-all duration-300 ease-in-out" data-aos="zoom-in">
                        BOOK ROOMS
                    </a>
                @else
                    <a href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;" class="mt-6 px-8 py-3 bg-[#451a03] text-white font-semibold rounded-2xl inline-block hover:bg-[#7a3e1f] hover:scale-105 transition-all duration-300 ease-in-out" data-aos="zoom-in">
                        BOOK ROOMS
                    </a>
                @endauth
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Toggle bagian About
            document.getElementById('about-toggle').addEventListener('click', function(event) {
                event.preventDefault();
                const aboutMore = document.getElementById('about-more');
                const toggleText = this;

                if (aboutMore.classList.contains('hidden')) {
                    aboutMore.classList.remove('hidden');
                    toggleText.textContent = 'Hide';
                } else {
                    aboutMore.classList.add('hidden');
                    toggleText.textContent = 'Read More';
                }
            });

            // Toggle bagian History
            document.getElementById('history-toggle').addEventListener('click', function(event) {
                event.preventDefault();
                const historyMore = document.getElementById('history-more');
                const toggleText = this;

                if (historyMore.classList.contains('hidden')) {
                    historyMore.classList.remove('hidden');
                    toggleText.textContent = 'Hide';
                } else {
                    historyMore.classList.add('hidden');
                    toggleText.textContent = 'Read More';
                }
            });
        </script>
    @endpush
@endsection
