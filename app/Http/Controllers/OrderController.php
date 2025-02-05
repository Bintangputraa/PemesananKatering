<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function transaction(Request $request) {
        $transaction = order::where('user_id', $request->user_id)->with('menu')->get(); // Ambil transaksi dari model order

        $orders = $transaction->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'menu_id' => $order->menu_id,
                'nama_menu' => $order->menu->nama_menu, // Mengambil nama_menu dari relasi
                'gambar' => $order->menu->gambar,
                'harga' => $order->menu->harga,
                'alamat' => $order->alamat,
                'detail_rumah' => $order->detail_rumah,
                'jumlah' => $order->jumlah,
                'total_harga' => $order->total_harga,
                'tanggal_pemesanan' => $order->tanggal_pemesanan,
                'jam' => $order->jam,
                'status' => $order->status,
                'snap_token' => $order->snap_token,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ];
        });
        
        return response()->json([
            'order' => $orders
        ], 200);
        
    }

    public function index()
    {
        $orders = order::all(); 
        return view('transaction', compact('orders'));
    }

    public function status(Request $request) {
        DB::table('orders')->where('id', $request->order_id)->update(['status' => 'success']);

        return response()->json(['message' => 'Payment success'], 200);
    }
}
