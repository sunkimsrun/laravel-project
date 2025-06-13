<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Booking
{
    public static function getBookings()
    {
        return DB::table('bookings')->get();
    }

    public static function getBookingById($id)
    {
        return DB::table('bookings')->where('id', $id)->first();
    }

    public static function createBooking($guest_id, $room_id, $check_in, $check_out)
    {
        $id = DB::table('bookings')->insertGetId([
            'guest_id' => $guest_id,
            'room_id' => $room_id,
            'check_in' => $check_in,
            'check_out' => $check_out
        ]);
        return DB::table('bookings')->where('id', $id)->first();
    }

    public static function updateBooking($id, $check_in, $check_out)
    {
        DB::table('bookings')->where('id', $id)->update([
            'check_in' => $check_in,
            'check_out' => $check_out
        ]);
        return DB::table('bookings')->where('id', $id)->first();
    }

    public static function deleteBookingById($id)
    {
        return DB::table('bookings')->where('id', $id)->delete();
    }
}
