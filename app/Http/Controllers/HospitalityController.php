<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Booking, Guest, Hotel, Payment, Room};

class HospitalityController extends Controller
{
    // Show the form for creating guests and hotels
    public function showGuestHotelForm() {
        return view('guest_hotel_form');
    }

    // ---------------- Guests ----------------
    public function getGuests() {
        return response()->json(Guest::getGuests());
    }

    public function createGuest(Request $request) {
        $guest = Guest::createGuest($request->name, $request->phone_number, $request->address);
        return response()->json(['message' => 'Guest created', 'data' => $guest], 201);
    }

    public function updateGuest(Request $request, $id) {
        $guest = Guest::updateGuest($id, $request->name, $request->email, $request->phone_number, $request->address);
        return $guest
            ? response()->json(['message' => 'Guest updated', 'data' => $guest])
            : response()->json(['error' => 'Guest not found'], 404);
    }

    public function deleteGuest($id) {
        return Guest::deleteGuestById($id)
            ? response()->json(['message' => 'Guest deleted'])
            : response()->json(['error' => 'Guest not found'], 404);
    }

    // ---------------- Hotels ----------------
    public function getHotels() {
        return response()->json(Hotel::getHotels());
    }

    public function createHotel(Request $request) {
        $hotel = Hotel::createHotel($request->name, $request->location, $request->rating, $request->contact_info);
        return response()->json(['message' => 'Hotel created', 'data' => $hotel], 201);
    }

    public function updateHotel(Request $request, $id) {
        $hotel = Hotel::updateHotel($id, $request->name, $request->location, $request->rating, $request->contact_info);
        return $hotel
            ? response()->json(['message' => 'Hotel updated', 'data' => $hotel])
            : response()->json(['error' => 'Hotel not found'], 404);
    }

    public function deleteHotel($id) {
        return Hotel::deleteHotelById($id)
            ? response()->json(['message' => 'Hotel deleted'])
            : response()->json(['error' => 'Hotel not found'], 404);
    }

    // ---------------- Rooms ----------------
    public function getRooms() {
        return response()->json(Room::getRooms());
    }

    public function createRoom(Request $request) {
        $room = Room::createRoom($request->hotel_id, $request->room_number, $request->type, $request->price);
        return response()->json(['message' => 'Room created', 'data' => $room], 201);
    }

    public function updateRoom(Request $request, $id) {
        $room = Room::updateRoom($id, $request->room_number, $request->type, $request->price);
        return $room
            ? response()->json(['message' => 'Room updated', 'data' => $room])
            : response()->json(['error' => 'Room not found'], 404);
    }

    public function deleteRoom($id) {
        return Room::deleteRoomById($id)
            ? response()->json(['message' => 'Room deleted'])
            : response()->json(['error' => 'Room not found'], 404);
    }

    // ---------------- Bookings ----------------
    public function getBookings() {
        return response()->json(Booking::getBookings());
    }

    public function createBooking(Request $request) {
        $booking = Booking::createBooking($request->guest_id, $request->room_id, $request->check_in, $request->check_out);
        return response()->json(['message' => 'Booking created', 'data' => $booking], 201);
    }

    public function updateBooking(Request $request, $id) {
        $booking = Booking::updateBooking($id, $request->check_in, $request->check_out);
        return $booking
            ? response()->json(['message' => 'Booking updated', 'data' => $booking])
            : response()->json(['error' => 'Booking not found'], 404);
    }

    public function deleteBooking($id) {
        return Booking::deleteBookingById($id)
            ? response()->json(['message' => 'Booking deleted'])
            : response()->json(['error' => 'Booking not found'], 404);
    }

    // ---------------- Payments ----------------
    public function getPayments() {
        return response()->json(Payment::getPayments());
    }

    public function createPayment(Request $request) {
        $payment = Payment::createPayment($request->booking_id, $request->amount, $request->method, $request->paid_at);
        return response()->json(['message' => 'Payment created', 'data' => $payment], 201);
    }

    public function updatePayment(Request $request, $id) {
        $payment = Payment::updatePayment($id, $request->amount, $request->method, $request->paid_at);
        return $payment
            ? response()->json(['message' => 'Payment updated', 'data' => $payment])
            : response()->json(['error' => 'Payment not found'], 404);
    }

    public function deletePayment($id) {
        return Payment::deletePaymentById($id)
            ? response()->json(['message' => 'Payment deleted'])
            : response()->json(['error' => 'Payment not found'], 404);
    }
}