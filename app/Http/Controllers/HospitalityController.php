<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Hotel;

class HospitalityController extends Controller
{
    // --- Guests ---

    // List all guests
    public function getGuests()
    {
        $guests = Guest::getGuests();
        return response()->json($guests);
    }

    // Get a guest by ID
    public function getGuest($id)
    {
        $guest = Guest::getGuestById($id);
        if (!$guest) {
            return response()->json(['error' => 'Guest not found'], 404);
        }
        return response()->json($guest);
    }

    // Create a new guest
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

        return response()->json(['message' => 'Guest created', 'data' => $guest], 201);
    }

    // Update an existing guest
    public function updateGuest(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $guest = Guest::updateGuest(
            $id,
            $data['name'],
            $data['email'],
            $data['phone_number'] ?? null,
            $data['address'] ?? null
        );

        if (!$guest) {
            return response()->json(['error' => 'Guest not found'], 404);
        }

        return response()->json(['message' => 'Guest updated', 'data' => $guest]);
    }

    // Delete a guest
    public function deleteGuest($id)
    {
        $deleted = Guest::deleteGuestById($id);

        if (!$deleted) {
            return response()->json(['error' => 'Guest not found'], 404);
        }

        return response()->json(['message' => 'Guest deleted']);
    }

    // --- Hotels ---

    // List all hotels
    public function getHotels()
    {
        $hotels = Hotel::getHotels();
        return response()->json($hotels);
    }

    // Create a new hotel
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

        return response()->json(['message' => 'Hotel created', 'data' => $hotel], 201);
    }

    // Update an existing hotel
    public function updateHotel(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'rating' => 'required|numeric',
            'contact_info' => 'required|string',
        ]);

        $hotel = Hotel::updateHotel(
            $id,
            $data['name'],
            $data['location'],
            $data['rating'],
            $data['contact_info']
        );

        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }

        return response()->json(['message' => 'Hotel updated', 'data' => $hotel]);
    }

    // Delete a hotel
    public function deleteHotel($id)
    {
        $deleted = Hotel::deleteHotelById($id);

        if (!$deleted) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }

        return response()->json(['message' => 'Hotel deleted']);
    }

    public function showGuestHotelForm()
{
    $guests = Guest::getGuests();
    $hotels = Hotel::getHotels();

    return view('create', compact('guests', 'hotels'));
}
    
}
