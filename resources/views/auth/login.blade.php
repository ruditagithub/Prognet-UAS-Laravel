<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen" data-aos="fade-in" data-aos-duration="1000">
<div class="bg-[rgba(52,49,49,0.9)] rounded-lg shadow-lg overflow-hidden max-w-4xl w-full flex" data-aos="fade-up" data-aos-duration="1000">
    <div class="hidden md:block md:w-1/2 bg-cover" style="background-image: url({{ asset('images/logindanregis.jpg') }})" data-aos="fade-right" data-aos-duration="1000"></div>
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center" style="background-color: #451a03;" data-aos="fade-left" data-aos-duration="1000">
        <div class="login-form">
            <h2 class="text-3xl font-bold mb-6 text-white text-center" data-aos="zoom-in" data-aos-duration="1000">Login</h2>

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

            <form id="login-form" method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-4" data-aos="fade-up" data-aos-duration="1000">
                    <label for="username" class="block text-white mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required class="w-full px-4 py-2 border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-[#451a03] text-black">
                </div>
                <div class="mb-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <label for="password" class="block text-white mb-2">Password</label>
                    <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-[#451a03] text-black">
                </div>
                <button type="submit" class="w-full py-2 bg-white text-[#343131] rounded-lg hover:bg-gray-300 transition duration-300" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Login</button>
            </form>
            <div class="mt-6 text-center text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                Don't have an account? <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-500 transition duration-300">Register here</a>
            </div>
            <div class="mt-4 text-center text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <a href="{{ route('home') }}" class="text-yellow-400 hover:text-yellow-500 transition duration-300">Back to Home</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();

    @if(session('success') || session('error'))
    setTimeout(function() {
        @if(session('success'))
        alert('{{ session('success') }}');
        @endif
        @if(session('error'))
        alert('{{ session('error') }}');
        @endif
    }, 100);
    @endif
</script>
</body>
</html>
