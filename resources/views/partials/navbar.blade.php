<header>
    <nav class="w-full flex justify-between items-center p-6 bg-[#451a03] text-white">
        <div class="text-2xl font-bold" style="font-family: Merriweather, serif;">
            Grand Aveline
        </div>
        <ul class="hidden md:flex space-x-6">
            <li><a class="hover:text-[#fcd34d]" href="{{ route('home') }}">Home</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('home') }}#about">About</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('login') }}">Login</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('rooms.index') }}">Rooms</a></li>
            @auth
                <li><a class="hover:text-[#fcd34d]" href="{{ route('bookings.create') }}">Book</a></li>
            @else
                <li><a class="hover:text-[#fcd34d]" href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;">Book</a></li>
            @endauth
            <li><a class="hover:text-[#fcd34d]" href="{{ route('home') }}#facilities">Facilities</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('contact') }}">Contact us</a></li>
            @auth
                <li><button class="hover:text-[#fcd34d]" id="logout-button">Logout</button></li>
            @endauth
        </ul>
        <div class="md:hidden">
            <button id="menu-button" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden bg-[#451a03] text-white p-6">
        <ul class="space-y-4">
            <li><a class="hover:text-[#fcd34d]" href="{{ route('home') }}">Home</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('home') }}#about">About</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('login') }}">Login</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('rooms.index') }}">Rooms</a></li>
            @auth
                <li><a class="hover:text-[#fcd34d]" href="{{ route('bookings.create') }}">Book</a></li>
            @else
                <li><a class="hover:text-[#fcd34d]" href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;">Book</a></li>
            @endauth
            <li><a class="hover:text-[#fcd34d]" href="{{ route('home') }}#facilities">Facilities</a></li>
            <li><a class="hover:text-[#fcd34d]" href="{{ route('contact') }}">Contact us</a></li>
        </ul>
    </div>
</header>
