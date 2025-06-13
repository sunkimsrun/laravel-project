<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Room
{
    public static function getRooms()
    {
        return DB::table('rooms')->get();
    }

    public static function getRoomById($id)
    {
        return DB::table('rooms')->where('id', $id)->first();
    }

    public static function createRoom($hotel_id, $room_number, $type, $price)
    {
        $id = DB::table('rooms')->insertGetId([
            'hotel_id' => $hotel_id,
            'room_number' => $room_number,
            'type' => $type,
            'price' => $price
        ]);
        return DB::table('rooms')->where('id', $id)->first();
    }

    public static function updateRoom($id, $room_number, $type, $price)
    {
        DB::table('rooms')->where('id', $id)->update([
            'room_number' => $room_number,
            'type' => $type,
            'price' => $price
        ]);
        return DB::table('rooms')->where('id', $id)->first();
    }

    public static function deleteRoomById($id)
    {
        return DB::table('rooms')->where('id', $id)->delete();
    }
}
