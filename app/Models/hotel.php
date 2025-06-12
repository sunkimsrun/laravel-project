<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Hotel
{
    // Get all hotels
    public static function getHotels()
    {
        return DB::table('hotels')->get();
    }

    // Create a new hotel
    public static function createHotel($name, $location, $rating, $contact_info)
    {
        $id = DB::table('hotels')->insertGetId([
            'name' => $name,
            'location' => $location,
            'rating' => $rating,
            'contact_info' => $contact_info,
            'created_at' => now()
        ]);

        return DB::table('hotels')->where('id', $id)->first();
    }

    // Update an existing hotel by ID
    public static function updateHotel($id, $name, $location, $rating, $contact_info)
    {
        DB::table('hotels')->where('id', $id)->update([
            'name' => $name,
            'location' => $location,
            'rating' => $rating,
            'contact_info' => $contact_info
        ]);

        return DB::table('hotels')->where('id', $id)->first();
    }

    // Delete a hotel by ID
    public static function deleteHotelById($id)
    {
        return DB::table('hotels')->where('id', $id)->delete();
    }
}
