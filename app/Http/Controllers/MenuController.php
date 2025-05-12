<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{


    // Menampilkan semua data menu
    public function index()
    {
        $menus = menu::all();
        return view('menu', compact('menus'));
    }



    // Menyimpan menu baru
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'kategori' => 'required|string',
        'harga' => 'required|numeric',
        'gambar' => 'required|array', // Pastikan gambar adalah array
        'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi setiap file gambar
    ]);

    // Mengambil semua gambar yang diunggah
    $gambarPaths = [];

    if ($request->hasFile('gambar')) {
        foreach ($request->file('gambar') as $gambar) {
            // Menyimpan gambar dan mendapatkan path
            $path = $gambar->store('uploads', 'public');
            // Tambahkan URL base menggunakan asset()
            $fullPath = asset('storage/' . $path); // Menambahkan storage path agar bisa diakses
            $gambarPaths[] = $fullPath;
        }
    }

    // Buat instance Menu baru
    $menu = new Menu();
    $menu->nama_menu = $request->input('nama_menu');
    $menu->deskripsi = $request->input('deskripsi');
    $menu->kategori = $request->input('kategori');
    $menu->recomend = $request->input('recomend');
    $menu->harga = $request->input('harga');

    $baseUrl = 'https://65f4-2407-0-3006-4461-1026-77e5-6491-f4d8.ngrok-free.app'; // Gunakan base URL yang diinginkan

    // Gabungkan base URL dengan setiap path gambar
    foreach ($gambarPaths as &$gambarPath) {
        $gambarPath = $baseUrl . '/storage/uploads/' . basename($gambarPath);
    }

    // Menyimpan array gambar sebagai JSON
    $menu->gambar = json_encode($gambarPaths);

    // Menyimpan data ke database
    $menu->save();

    // Mengembalikan respons sukses
    return response()->json([
        'message' => 'Menu berhasil ditambahkan!',
        'menu' => $menu
    ], 201);
}

// Mengupdate menu
public function update(Request $request, $id)
{
    $menu = Menu::find($id);
    if (!$menu) {
        return response()->json(['message' => 'Menu not found'], 404);
    }

    // Validasi hanya jika gambar diupload
    if ($request->hasFile('gambar')) {
        $validatedData = $request->validate([
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPaths = [];
        foreach ($request->file('gambar') as $gambar) {
            $path = $gambar->store('uploads', 'public');
            // Gunakan URL ngrok atau domain Anda
            $gambarPaths[] = 'https://65f4-2407-0-3006-4461-1026-77e5-6491-f4d8.ngrok-free.app/storage/' . $path;
        }

        // Simpan gambar sebagai JSON string
        $menu->gambar = json_encode($gambarPaths);
    }


    $menu->save();

    return response()->json($menu, 200);
}





    // Menampilkan detail menu tertentu
    public function show($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            return response()->json($menu, 200);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }




    // Fungsi untuk menampilkan menu berdasarkan kategori
    public function getBykategori($kategori)
    {
        // Mengambil data menu yang sesuai dengan kategori
        $menus = Menu::where('kategori', $kategori)->get();

        // Jika data tidak ditemukan
        if ($menus->isEmpty()) {
            return response()->json([
                'message' => 'No menu found in this kategori'
            ], 404);
        }

        // Mengembalikan data menu
        return response()->json([
            'menus' => $menus
        ], 200);
    }



    public function getByRecomend($recomend)
    {
        // Mengambil data menu yang sesuai dengan recomend
        $menus = Menu::where('recomend', $recomend)->get();

        // Jika data tidak ditemukan
        if ($menus->isEmpty()) {
            return response()->json([
                'message' => 'No menu found in this recomend'
            ], 404);
        }

        // Mengembalikan data menu
        return response()->json([
            'menus' => $menus
        ], 200);
    }
    

    // Menghapus menu
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->delete();
            return response()->json(['message' => 'Menu deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Menu not found'], 404);
        }
    }
}
