<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $email = $request->input('email'); // Mengambil email dari request
        $user = User::where('email', $email)->first(); // Cari user berdasarkan email

        if ($user) {
            return response()->json($user, 200); // Return data user jika ditemukan
        } else {
            return response()->json(['message' => 'User not found'], 404); // Return error jika tidak ditemukan
        }
    }

    function add(Request $request){
        DB::table('users')->insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'no_telf' => $request->no_telf,
            'alamat' => $request->alamat,
        ]);
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:6',
        'no_telf' => 'required|string|max:15',
        'alamat' => 'required|string|max:255',
    ]);

    // Update data user
    DB::table('users')->where('id', $id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : DB::raw('password'),
        'no_telf' => $request->no_telf,
        'alamat' => $request->alamat,
    ]);

    return response()->json(['message' => 'User updated successfully.'], 200);
}

}
