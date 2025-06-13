<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HospitalityController;
use App\Http\Middleware\EnsureTokenIsValid;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Route to show the form for creating guests and hotels(នេះដំណើរការបាន)
Route::get('/create', [HospitalityController::class, 'showGuestHotelForm'])->name('form.guesthotel');

// Create routes for guests and hotels from blade form (ទាំងពីរនេះមិនទាន់ដំណើរការបានទេ)
Route::post('/guests', [HospitalityController::class, 'createGuest']);
Route::post('/hotels', [HospitalityController::class, 'createHotel']);

// Auth routes
Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware(EnsureTokenIsValid::class);
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(EnsureTokenIsValid::class);

// Protected routes
Route::middleware([EnsureTokenIsValid::class])->group(function () {
    // Guests
    Route::get('/guests', [HospitalityController::class, 'getGuests']);
    Route::post('/guests', [HospitalityController::class, 'createGuest']);
    Route::patch('/guests/{id}', [HospitalityController::class, 'updateGuest']);
    Route::delete('/guests/{id}', [HospitalityController::class, 'deleteGuest']);

    // Hotels
    Route::get('/hotels', [HospitalityController::class, 'getHotels']);
    Route::post('/hotels', [HospitalityController::class, 'createHotel']);
    Route::patch('/hotels/{id}', [HospitalityController::class, 'updateHotel']);
    Route::delete('/hotels/{id}', [HospitalityController::class, 'deleteHotel']);

    // Rooms
    Route::get('/rooms', [HospitalityController::class, 'getRooms']);
    Route::post('/rooms', [HospitalityController::class, 'createRoom']);
    Route::patch('/rooms/{id}', [HospitalityController::class, 'updateRoom']);
    Route::delete('/rooms/{id}', [HospitalityController::class, 'deleteRoom']);

    // Bookings
    Route::get('/bookings', [HospitalityController::class, 'getBookings']);
    Route::post('/bookings', [HospitalityController::class, 'createBooking']);
    Route::patch('/bookings/{id}', [HospitalityController::class, 'updateBooking']);
    Route::delete('/bookings/{id}', [HospitalityController::class, 'deleteBooking']);

    // Payments
    Route::get('/payments', [HospitalityController::class, 'getPayments']);
    Route::post('/payments', [HospitalityController::class, 'createPayment']);
    Route::patch('/payments/{id}', [HospitalityController::class, 'updatePayment']);
    Route::delete('/payments/{id}', [HospitalityController::class, 'deletePayment']);

    // Users
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);
});
