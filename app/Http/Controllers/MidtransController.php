<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function createTransaction(Request $request)
{
    $data = $request->all();

    // Membuat order baru
    $transaction = order::create([
        'user_id' => $data['user_id'],
        'menu_id' => $data['menu_id'],
        'alamat' => $data['alamat'],
        'detail_rumah' => $data['detail_rumah'],
        'jumlah' => $data['jumlah'],
        'total_harga' => $data['total_harga'],
        'tanggal_pemesanan' => $data['tanggal_pemesanan'],
        'jam' => $data['jam'],
        'status' => 'pending'
    ]);

    // Set Config Midtrans
    Config::$serverKey = config('midtrans.server_key'); 
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = config('midtrans.is_sanitized');
    Config::$is3ds = config('midtrans.is_3ds');

    // Siapkan parameter untuk transaksi
    $params = array(
        'transaction_details' => array(
            'order_id' => $transaction->id, // Gunakan ID dari transaksi
            'gross_amount' => $data['total_harga'], // Akses array dengan benar
        ),
        'customer_details' => array(
            'first_name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['no_telf'],
        ),
    );


    // Mendapatkan snap token
    // Log::info('Request data:', $params);
    $snapToken = Snap::getSnapToken($params);
    // Log::info('Snap token:', $snapToken);
    $transaction->snap_token = $snapToken;
    $transaction->save();
    return response()->json([
        'message' => 'Transaction created successfully',
        'transaction' => $transaction, // pastikan snap_token ada di $transaction
        'snap_token' => $transaction->snap_token, // kirim snap_token secara eksplisit
    ]);
    
    return redirect()->route('transaction', $transaction->id);
}


    public function transaction($user_id) {
        $transaction = order::where('user_id', $user_id)->Where('status', 'sukses')->get(); // Ambil transaksi dari model order

        return response()->json([
            'order' => $transaction
        ], 200);
    }


}
