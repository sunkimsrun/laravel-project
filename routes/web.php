<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Guest;
use App\Models\User;
use Firebase\JWT\JWT;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HospitalityController;


// ❌ This is PUBLIC – no token required (នេះមិនដំណើរការfrontendទេ)
Route::get('/create', function () {
    return view('create');
});

// ✅ This is PUBLIC – no token required (មួយនេះដំណើរការfrontend)
Route::get('/create', [HospitalityController::class, 'showGuestHotelForm'])->name('form.guesthotel');

Route::get('/', function () {
    return view('welcome');
});

Route::post('/post/guests', [PostController::class, 'createGuest']);
Route::post('post/hotels', [PostController::class, 'createHotel']);


Route::middleware([EnsureTokenIsValid::class])->group(function () {

    // Guests routes (from the Guest model)
    Route::get('/guests', fn() => response()->json(Guest::getGuests()));

    Route::post('/guests', function () {
        $body = request()->json()->all();
        $guest = Guest::createGuest($body['name'], $body['phone_number'], $body['address']);
        return response()->json(['message' => 'Guest created successfully', 'data' => $guest], 201);
    });

    Route::delete(
        '/guests/{id}',
        fn($id) =>
        Guest::deleteGuestById($id)
        ? response()->json(['message' => 'Guest deleted'])
        : response()->json(['error' => 'Guest not found'], 404)
    );

    Route::patch('/guests/{id}', function ($id) {
        $body = request()->json()->all();
        $guest = Guest::updateGuest(
            $id,
            $body['name'],
            $body['email'],
            $body['phone_number'] ?? null,
            $body['address'] ?? null
        );
        return $guest
            ? response()->json(['message' => 'Guest updated', 'data' => $guest])
            : response()->json(['error' => 'Guest not found'], 404);
    });





    // Hotels routes (from the Hotel model)
    Route::get('/hotels', fn() => response()->json(Hotel::getHotels()));

    Route::post('/hotels', function () {
        $body = request()->json()->all();
        $hotel = Hotel::createHotel(
            $body['name'],
            $body['location'],
            $body['rating'],
            $body['contact_info']
        );
        return response()->json(['message' => 'Hotel created successfully', 'data' => $hotel], 201);
    });

    Route::patch('/hotels/{id}', function ($id) {
        $body = request()->json()->all();
        $hotel = Hotel::updateHotel(
            $id,
            $body['name'],
            $body['location'],
            $body['rating'],
            $body['contact_info']
        );
        return $hotel
            ? response()->json(['message' => 'Hotel updated', 'data' => $hotel])
            : response()->json(['error' => 'Hotel not found'], 404);
    });

    Route::delete('/hotels/{id}', function ($id) {
        return Hotel::deleteHotelById($id)
            ? response()->json(['message' => 'Hotel deleted'])
            : response()->json(['error' => 'Hotel not found'], 404);
    });






    Route::post('/register', function () {
        $body = request()->all();
        $user = new User();
        $user->name = $body['name'];
        $user->email = $body['email'];
        $user->password = bcrypt($body['password']);
        $user->save();
        // response user
        return response()->json(['message' => 'User created', 'data' => $user]);
    })->withoutMiddleware(EnsureTokenIsValid::class); #បន្ថែមកន្លែងនេះព្រោះការregisterមិនចាំបាច់ដាក់ចូលក្នុងmiddlewareទេ

    Route::post('/login', function () {
        $body = request()->all();
        $email = $body['email'];
        $password = $body['password'];

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        if (!password_verify($password, $user->password)) {
            return response()->json(['message' => 'Invalid either email or password'], 401);
        }
        // Sign JWT token
        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + 60 * 60,
        ];
        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        return response()->json(['access_token' => $jwt]);
    })->withoutMiddleware(EnsureTokenIsValid::class); #បន្ថែមកន្លែងនេះព្រោះការregisterមិនចាំបាច់ដាក់ចូលក្នុងmiddlewareទេ





    // Delete user
    Route::delete(
        'users/{id}',
        fn($id) =>
        User::destroy($id)
        ? response()->json(['message' => 'User deleted'])
        : response()->json(['error' => 'User not found'], 404)
    );
});
