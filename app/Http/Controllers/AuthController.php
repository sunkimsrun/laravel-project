<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    // User registration
    public function register(Request $request)
    {
        $body = $request->all();

        $user = new User();
        $user->name = $body['name'];
        $user->email = $body['email'];
        $user->password = bcrypt($body['password']);
        $user->save();

        return response()->json(['message' => 'User created', 'data' => $user]);
    }

    // User login, return JWT token
    public function login(Request $request)
    {
        $body = $request->all();
        $email = $body['email'];
        $password = $body['password'];

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!password_verify($password, $user->password)) {
            return response()->json(['message' => 'Invalid either email or password'], 401);
        }

        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + 60 * 60, // 1 hour expiration
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return response()->json(['access_token' => $jwt]);
    }

    // Delete user by id
    public function deleteUser($id)
    {
        return User::destroy($id)
            ? response()->json(['message' => 'User deleted'])
            : response()->json(['error' => 'User not found'], 404);
    }
}
