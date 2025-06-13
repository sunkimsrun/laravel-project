<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'User created', 'data' => $user]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        return response()->json(['access_token' => $jwt]);
    }

    public function deleteUser($id)
    {
        return User::destroy($id)
            ? response()->json(['message' => 'User deleted'])
            : response()->json(['error' => 'User not found'], 404);
    }
}
