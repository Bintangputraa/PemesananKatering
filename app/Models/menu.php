<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class menu extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'gambar',
        'kategori',
        'recomend',
        'harga',
    ];

    public function getGambarAttribute($value)
    {
        return json_decode($value);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'menu_id');
    }


}
