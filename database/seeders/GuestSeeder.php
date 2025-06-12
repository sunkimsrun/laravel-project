<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        // Insert 1 guest
        $guestId = DB::table('guests')->insertGetId([
            'name' => "Guest VIP",
            'email' => "vipguest@example.com",
            'phone_number' => "012345678",
            'address' => "Elite Street, Phnom Penh",
            'created_at' => now(),
        ]);

        // Insert 2 hotels and book 1 room from each
        for ($i = 1; $i <= 2; $i++) {
            // Insert hotel
            $hotelId = DB::table('hotels')->insertGetId([
                'name' => "Hotel #$i",
                'location' => "City $i",
                'rating' => 4 + $i * 0.3,
                'contact_info' => "hotel$i@example.com",
                'created_at' => now(),
            ]);

            // Insert room for this hotel
            $roomId = DB::table('rooms')->insertGetId([
                'hotel_id' => $hotelId,
                'room_number' => "10$i",
                'type' => "single",
                'price_per_night' => 60 + ($i * 10), // 70, 80
                'status' => 'booked',
                'created_at' => now(),
            ]);

            // Booking dates for each hotel (non-overlapping)
            $checkIn = Carbon::parse("2025-06-" . (10 + ($i - 1) * 5));  // 2025-06-10, 2025-06-15
            $checkOut = $checkIn->copy()->addDays(3);
            $price = 3 * (60 + ($i * 10));

            // Insert booking
            $bookingId = DB::table('bookings')->insertGetId([
                'guest_id' => $guestId,
                'room_id' => $roomId,
                'check_in_date' => $checkIn,
                'check_out_date' => $checkOut,
                'status' => 'confirmed',
                'total_price' => $price,
                'created_at' => now(),
            ]);

            // Insert payment
            DB::table('payments')->insert([
                'booking_id' => $bookingId,
                'payment_date' => $checkIn->copy()->subDays(2),
                'created_at' => now(),
            ]);
        }
    }
}
