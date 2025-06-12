<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Guest
{
    // Get all guests
    public static function getGuests()
    {
        return DB::table('guests')->get();
    }

    // Get a guest by ID
    public static function getGuestById($id)
    {
        return DB::table('guests')->where('id', $id)->first();
    }

    // Create a new guest
    public static function createGuest($name, $phone_number = null, $address = null)
    {
        $id = DB::table('guests')->insertGetId([
            'name' => $name,
            'email' => $name . '@hotel.com',
            'phone_number' => $phone_number ?? '0000000000',
            'address' => $address ?? 'Unknown Address',
            'created_at' => now(),
        ]);
        return DB::table('guests')->where('id', $id)->first();
    }

    // Update a guest
    public static function updateGuest($id, $name, $email, $phone_number = null, $address = null)
    {
        DB::table('guests')->where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number ?? '0000000000',
            'address' => $address ?? 'Unknown Address',
        ]);
        return DB::table('guests')->where('id', $id)->first();
    }

    // Delete a guest
    public static function deleteGuestById($id)
    {
        return DB::table('guests')->where('id', $id)->delete();
    }
}
