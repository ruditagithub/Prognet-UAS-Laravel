<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-4 w-full max-w-md">
    @csrf

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label for="room_type" class="block text-sm font-medium text-gray-700">Room Type</label>
        <input type="text" name="room_type" id="room_type" value="{{ old('room_type', $room->room_type) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
        <input type="number" name="price" id="price" value="{{ old('price', $room->price) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div>
        <label for="available_rooms" class="block text-sm font-medium text-gray-700">Available Rooms</label>
        <input type="number" name="available_rooms" id="available_rooms" value="{{ old('available_rooms', $room->available_rooms) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update Room</button>
</form>

<script>
    @if(session('success'))
    alert('{{ session('success') }}');
    window.location.href = '{{ route('admin.index') }}';
    @endif

    @if(session('error'))
    alert('{{ session('error') }}');
    @endif
</script>
</body>
</html>
