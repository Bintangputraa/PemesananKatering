<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        
        'user_id',
        'menu_id',
        'alamat',
        'detail_rumah',
        'jumlah',
        'total_harga',
        'tanggal_pemesanan',
        'jam',
        'status',
        'snap_token'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

}
