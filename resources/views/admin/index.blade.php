<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8 bg-white p-4 shadow-md rounded-lg">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Admin Panel</h2>
            @auth
                <p class="text-sm text-gray-600 mt-1">Welcome, {{ Auth::user()->nama }} ({{ Auth::user()->username }})</p>
            @endauth
        </div>
        <a href="{{ route('logout') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Logout
        </a>
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

    <!-- Users Section -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Users</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">ID</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Name</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Username</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Phone</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Email</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Password</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Created At</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $user->id }}</td>
                        <td class="py-3 px-4 border-b">{{ $user->nama }}</td>
                        <td class="py-3 px-4 border-b">{{ $user->username }}</td>
                        <td class="py-3 px-4 border-b">{{ $user->phone }}</td>
                        <td class="py-3 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-3 px-4 border-b">********</td>
                        <td class="py-3 px-4 border-b">{{ $user->created_at }}</td>
                        <td class="py-3 px-4 border-b">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-700 inline-flex items-center space-x-1">
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('admin.users.destroy', $user->id) }}" class="text-red-500 hover:text-red-700 inline-flex items-center space-x-1 ml-3" onclick="return confirm('Are you sure you want to delete this user?')">
                                <span>Delete</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bookings Section -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Bookings</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Booking ID</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">User ID</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Room ID</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Check-in</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Check-out</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Number of Rooms</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Total Price</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Created At</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $booking->booking_id }}</td>
                        <td class="py-3 px-4 border-b">{{ $booking->user_id }}</td>
                        <td class="py-3 px-4 border-b">{{ $booking->room_id }}</td>
                        <td class="py-3 px-4 border-b">{{ $booking->checkin }}</td>
                        <td class="py-3 px-4 border-b">{{ $booking->checkout }}</td>
                        <td class="py-3 px-4 border-b">{{ $booking->num_rooms }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 border-b">{{ $booking->created_at }}</td>
                        <td class="py-3 px-4 border-b">
                            <a href="{{ route('admin.bookings.edit', $booking->booking_id) }}" class="text-yellow-500 hover:text-yellow-700 inline-flex items-center space-x-1">
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('admin.bookings.destroy', $booking->booking_id) }}" onclick="return confirm('Are you sure you want to delete this booking?');" class="text-red-500 hover:text-red-700 inline-flex items-center space-x-1 ml-3">
                                <span>Delete</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rooms Section -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Rooms</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg mb-4">
                <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Room ID</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Room Type</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Price</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Available Rooms</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $room->id }}</td>
                        <td class="py-3 px-4 border-b">{{ $room->room_type }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($room->price, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 border-b">{{ $room->available_rooms }}</td>
                        <td class="py-3 px-4 border-b">
                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="text-yellow-500 hover:text-yellow-700 inline-flex items-center space-x-1">
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('admin.rooms.destroy', $room->id) }}" onclick="return confirm('Are you sure you want to delete this room?');" class="text-red-500 hover:text-red-700 inline-flex items-center space-x-1 ml-3">
                                <span>Delete</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <h3 class="text-xl font-semibold mb-4">Add New Room</h3>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.rooms.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="id" class="block text-sm font-medium text-gray-700">Room ID</label>
                    <input type="text" name="id" id="id" value="{{ old('id') }}" pattern="RM[0-9]+" title="Format harus RM diikuti angka, contohnya RM10" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <div>
                    <label for="room_type" class="block text-sm font-medium text-gray-700">Room Type</label>
                    <input type="text" name="room_type" id="room_type" value="{{ old('room_type') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="available_rooms" class="block text-sm font-medium text-gray-700">Available Rooms</label>
                    <input type="number" name="available_rooms" id="available_rooms" value="{{ old('available_rooms') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Room</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
</body>
</html>
