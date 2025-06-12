<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Hotel;

class PostController extends Controller
{
    // Create a new guest (from blade form)
    public function createGuest(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $guest = Guest::createGuest(
            $data['name'],
            $data['phone_number'] ?? null,
            $data['address'] ?? null
        );

        return redirect()->back()->with('guest_message', 'Guest added successfully!');
    }

    // Create a new hotel (from blade form)
    public function createHotel(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'rating' => 'required|numeric',
            'contact_info' => 'required|string',
        ]);

        $hotel = Hotel::createHotel(
            $data['name'],
            $data['location'],
            $data['rating'],
            $data['contact_info']
        );

        return redirect()->back()->with('hotel_message', 'Hotel added successfully!');
    }
}
