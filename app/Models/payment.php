<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class payment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'userr_id',
        'menu_id',
        'total_harga',
        'tanggal_pemesanan',
        'status',
        'snap_token'
    ];
}
