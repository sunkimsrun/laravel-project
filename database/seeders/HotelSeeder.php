<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        // កន្លែងនេះចង់អោយ 10 full loops—each inserting a hotel, 2 rooms, 1 guest, 1 booking, and 1 payment in every loop
        for ($i = 1; $i <= 10; $i++) {
            // Insert Hotel
            $hotelId = DB::table('hotels')->insertGetId([
                'name' => 'Hotel #' . $i,
                'location' => 'City ' . $i,
                'rating' => 3.5 + ($i % 2), // Alternating rating between 3.5 and 4.5
                'contact_info' => "hotel$i@example.com",
                'created_at' => now(),
            ]);

            // Insert Room 1
            $room1 = DB::table('rooms')->insertGetId([
                'hotel_id' => $hotelId,
                'room_number' => '10' . $i,
                'type' => 'single',
                'price_per_night' => 50.00,
                'status' => 'available',
                'created_at' => now(),
            ]);

            // Insert Room 2
            $room2 = DB::table('rooms')->insertGetId([
                'hotel_id' => $hotelId,
                'room_number' => '20' . $i,
                'type' => 'double',
                'price_per_night' => 75.00,
                'status' => 'booked',
                'created_at' => now(),
            ]);

            // Insert Guest
            $guestId = DB::table('guests')->insertGetId([
                'name' => "Guest $i",
                'email' => "guest$i@example.com",
                'phone_number' => "01234567$i",
                'address' => "Street $i, Phnom Penh",
                'created_at' => now(),
            ]);

            // Insert Booking
            $checkInDate = Carbon::parse('2025-06-10')->addDays($i);
            $checkOutDate = Carbon::parse('2025-06-15')->addDays($i);
            $totalNights = $checkInDate->diffInDays($checkOutDate);

            $bookingId = DB::table('bookings')->insertGetId([
                'guest_id' => $guestId,
                'room_id' => $room2,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'status' => 'confirmed',
                'total_price' => 75.00 * $totalNights,
                'created_at' => now(),
            ]);

            // Insert Payment
            DB::table('payments')->insert([
                'booking_id' => $bookingId,
                'payment_date' => $checkInDate->copy()->subDays(3),
                'created_at' => now(),
            ]);
        }
    }
}
