<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Hotels table
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->string('name');
            $table->string('location');
            $table->float('rating')->default(0);
            $table->string('contact_info');
        });

        // 2. Rooms table
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->string('room_number');
            $table->string('type');
            $table->decimal('price_per_night', 8, 2);
            $table->string('status')->default('available');
        });

        // 3. Guests table
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address');
        });

        // 4. Bookings table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('status')->default('confirmed');
            $table->decimal('total_price', 10, 2);
        });

        // 5. Payments table
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade')->unique();
            $table->date('payment_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('guests');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('hotels');
    }
};
