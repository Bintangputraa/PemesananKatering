<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class historyOrder extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'order_id',
        'user_id',
        'nama',
        'no_telf',
        'alamat',
        'menu_id',
        'jumlah',
        'harga',
        'total',
        'tanggal',
        'metode_pembayaran',
        'payment_id',
        'status',
    ];
}
