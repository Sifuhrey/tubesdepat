<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   protected $table = 'keranjang';
   protected $primaryKey = 'id_keranjang';
   protected $fillable = ['id_user','id_produk','quantity'];
   public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }
}
