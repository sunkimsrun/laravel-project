<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Payment
{
    public static function getPayments()
    {
        return DB::table('payments')->get();
    }

    public static function getPaymentById($id)
    {
        return DB::table('payments')->where('id', $id)->first();
    }

    public static function createPayment($booking_id, $amount, $method, $paid_at)
    {
        $id = DB::table('payments')->insertGetId([
            'booking_id' => $booking_id,
            'amount' => $amount,
            'method' => $method,
            'paid_at' => $paid_at
        ]);
        return DB::table('payments')->where('id', $id)->first();
    }

    public static function updatePayment($id, $amount, $method, $paid_at)
    {
        DB::table('payments')->where('id', $id)->update([
            'amount' => $amount,
            'method' => $method,
            'paid_at' => $paid_at
        ]);
        return DB::table('payments')->where('id', $id)->first();
    }

    public static function deletePaymentById($id)
    {
        return DB::table('payments')->where('id', $id)->delete();
    }
}
