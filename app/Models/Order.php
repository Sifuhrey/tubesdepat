<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'id_pesanan');
    }
}
