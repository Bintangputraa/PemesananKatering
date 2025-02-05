<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use ValidatesRequests;
    public function login(Request $request)
    {
        
        // Validasi input email dan password
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Cek kredensial pengguna
        $credentials = $request->only('email', 'password');

        try {
            // Jika kredensial valid, buat token JWT
            if (!$token = FacadesJWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid email or password'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Jika berhasil, return token
        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => Auth::user(),
        ]);
    }
    

    public function register(Request $request)
    {
        $user = User::create([
            'id' => rand(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telf' => $request->no_telf,
            'alamat' => $request->alamat,
        ]);

        $token = FacadesJWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'));
    }

    public function update(Request $request)
{

    // Cari user berdasarkan ID
    DB::table('users')->where('id', $request->id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : DB::raw('password'),
        'no_telf' => $request->no_telf,
        'alamat' => $request->alamat,
    ]);

    return response()->json(['message' => 'User updated successfully']);
}


    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}