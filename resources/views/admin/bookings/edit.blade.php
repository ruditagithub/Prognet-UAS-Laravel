<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<form action="{{ route('admin.bookings.update', $booking->booking_id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-4 w-full max-w-md">
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
        <label for="booking_id" class="block text-sm font-medium text-gray-700">Booking ID</label>
        <input type="text" name="booking_id" id="booking_id" value="{{ old('booking_id', $booking->booking_id) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>
    <div>
        <label for="checkin" class="block text-sm font-medium text-gray-700">Check-in Date</label>
        <input type="date" name="checkin" id="checkin" value="{{ old('checkin', $booking->checkin->format('Y-m-d')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>
    <div>
        <label for="checkout" class="block text-sm font-medium text-gray-700">Check-out Date</label>
        <input type="date" name="checkout" id="checkout" value="{{ old('checkout', $booking->checkout->format('Y-m-d')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>
    <div>
        <label for="num_rooms" class="block text-sm font-medium text-gray-700">Number of Rooms</label>
        <input type="number" name="num_rooms" id="num_rooms" value="{{ old('num_rooms', $booking->num_rooms) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>
    <div>
        <label for="total_price" class="block text-sm font-medium text-gray-700">Total Price</label>
        <input type="number" name="total_price" id="total_price" value="{{ old('total_price', $booking->total_price) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update Booking</button>
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
