<header class="fixed top-0 left-0 right-0 z-50 bg-[#451a03] shadow-lg">
    <nav class="w-full flex justify-between items-center p-6 text-white">
        <div class="text-2xl font-bold" style="font-family: Merriweather, serif;">
            <a href="{{ route('home') }}" class="hover:text-[#fcd34d]">Grand Aveline</a>
        </div>
        <ul class="hidden md:flex space-x-6">
            <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('home') }}">Home</a></li>
            <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('home') }}#about">About</a></li>
            @guest
                <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('login') }}">Login</a></li>
            @endguest
            <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('rooms.index') }}">Rooms</a></li>
            @auth
                <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('bookings.create') }}">Book</a></li>
                <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('bookings.mybookings') }}">My Bookings</a></li>
            @else
                <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;">Book</a></li>
            @endauth
            <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('home') }}#facilities">Facilities</a></li>
            <li><a class="hover:text-[#fcd34d] cursor-pointer transition" href="{{ route('contact') }}">Contact us</a></li>
            @auth
                <li><button class="hover:text-[#fcd34d] cursor-pointer transition" id="logout-button">Logout</button></li>
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
            <li><a class="hover:text-[#fcd34d] block" href="{{ route('home') }}">Home</a></li>
            <li><a class="hover:text-[#fcd34d] block" href="{{ route('home') }}#about">About</a></li>
            @guest
                <li><a class="hover:text-[#fcd34d] block" href="{{ route('login') }}">Login</a></li>
            @endguest
            <li><a class="hover:text-[#fcd34d] block" href="{{ route('rooms.index') }}">Rooms</a></li>
            @auth
                <li><a class="hover:text-[#fcd34d] block" href="{{ route('bookings.create') }}">Book</a></li>
                <li><a class="hover:text-[#fcd34d] block" href="{{ route('bookings.mybookings') }}">My Bookings</a></li>
            @else
                <li><a class="hover:text-[#fcd34d] block" href="#" onclick="alert('Anda harus login terlebih dahulu!'); window.location.href='{{ route('login') }}'; return false;">Book</a></li>
            @endauth
            <li><a class="hover:text-[#fcd34d] block" href="{{ route('home') }}#facilities">Facilities</a></li>
            <li><a class="hover:text-[#fcd34d] block" href="{{ route('contact') }}">Contact us</a></li>
            @auth
                <li><button class="hover:text-[#fcd34d]" onclick="logout()">Logout</button></li>
            @endauth
        </ul>
    </div>
</header>

@auth
    <script>
        function logout() {
            if(confirm('Apakah Anda yakin ingin logout?')) {
                window.location.href = '{{ route("logout") }}';
            }
        }
    </script>
@endauth
