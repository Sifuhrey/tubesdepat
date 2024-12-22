<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pengiriman';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_pengiriman',
        'id_pesanan',
        'waktukirim',
        'waktusampai',
        'status',
    ];

    // Konversi otomatis waktu
    protected $casts = [
        'waktukirim' => 'datetime',
        'waktusampai' => 'datetime',
    ];
}
