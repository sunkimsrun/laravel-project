<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hospitality Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-200 via-blue-300 to-blue-400 min-h-screen font-sans text-gray-900">

  <div class="max-w-7xl mx-auto bg-white rounded-3xl shadow-lg p-10 mt-12 mb-12">

    <h1 class="text-4xl font-extrabold mb-8 bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-blue-900 flex items-center gap-3">
      <span>👥</span> Guests
    </h1>

    @if(session('guest_message'))
      <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
        {{ session('guest_message') }}
      </div>
    @endif

    <table class="table-auto w-full border-collapse border border-gray-300 mb-10">
      <thead>
        <tr class="bg-blue-100 text-blue-900 font-semibold">
          <th class="border border-gray-300 px-4 py-2">ID</th>
          <th class="border border-gray-300 px-4 py-2">Name</th>
          <th class="border border-gray-300 px-4 py-2">Email</th>
          <th class="border border-gray-300 px-4 py-2">Phone</th>
          <th class="border border-gray-300 px-4 py-2">Address</th>
        </tr>
      </thead>
      <tbody>
        @foreach($guests as $guest)
          <tr class="hover:bg-blue-50">
            <td class="border border-gray-300 px-4 py-2">{{ $guest->id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $guest->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $guest->email }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $guest->phone_number }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $guest->address }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <h2 class="text-3xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">
      Add New Guest
    </h2>

    <form method="POST" action="{{ url('/guests') }}" class="space-y-6 mb-12">
      @csrf
      <div>
        <label class="block mb-1 font-semibold" for="name">Name</label>
        <input id="name" type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block mb-1 font-semibold" for="phone_number">Phone Number</label>
        <input id="phone_number" type="text" name="phone_number" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block mb-1 font-semibold" for="address">Address</label>
        <input id="address" type="text" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-md transition duration-200">
        Add Guest
      </button>
    </form>

    <hr class="my-12 border-gray-300" />

    <h1 class="text-4xl font-extrabold mb-8 bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-blue-900 flex items-center gap-3">
      <span>🏨</span> Hotels
    </h1>

    @if(session('hotel_message'))
      <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
        {{ session('hotel_message') }}
      </div>
    @endif

    <table class="table-auto w-full border-collapse border border-gray-300 mb-10">
      <thead>
        <tr class="bg-blue-100 text-blue-900 font-semibold">
          <th class="border border-gray-300 px-4 py-2">ID</th>
          <th class="border border-gray-300 px-4 py-2">Name</th>
          <th class="border border-gray-300 px-4 py-2">Location</th>
          <th class="border border-gray-300 px-4 py-2">Rating</th>
          <th class="border border-gray-300 px-4 py-2">Contact Info</th>
        </tr>
      </thead>
      <tbody>
        @foreach($hotels as $hotel)
          <tr class="hover:bg-blue-50">
            <td class="border border-gray-300 px-4 py-2">{{ $hotel->id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $hotel->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $hotel->location }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $hotel->rating }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $hotel->contact_info }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <h2 class="text-3xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">
      Add New Hotel
    </h2>

    <form method="POST" action="{{ url('/hotels') }}" class="space-y-6">
      @csrf
      <div>
        <label class="block mb-1 font-semibold" for="hotel_name">Name</label>
        <input id="hotel_name" type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block mb-1 font-semibold" for="location">Location</label>
        <input id="location" type="text" name="location" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block mb-1 font-semibold" for="rating">Rating</label>
        <input id="rating" type="number" step="0.1" name="rating" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block mb-1 font-semibold" for="contact_info">Contact Info</label>
        <input id="contact_info" type="text" name="contact_info" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-md transition duration-200">
        Add Hotel
      </button>
    </form>

  </div>

</body>
</html>
