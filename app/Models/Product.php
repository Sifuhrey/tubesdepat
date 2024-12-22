<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'produk';

    // Primary key dari tabel
    protected $primaryKey = 'id_produk';

    // Field yang dapat diisi secara massal
    protected $fillable = [
        'productname',
        'category',
        'price',
        'stock',
        'description',
        'imgname',
    ];

    // Relasi ke model Cart (Keranjang)
    public function keranjang()
    {
        return $this->hasMany(Cart::class, 'id_produk', 'id_produk');
    }

    // Relasi ke model Wishlist
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'id_produk', 'id_produk');
    }

    // Akses atribut harga dalam format uang
    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 2, ',', '.');
    }

    // Akses kategori dengan format kapital di awal huruf
    public function getFormattedCategoryAttribute()
    {
        return ucfirst($this->category);
    }

    // Akses URL gambar produk
    public function getImageUrlAttribute()
    {
        return $this->imgname ? asset('storage/' . $this->imgname) : asset('assets/default-product.png');
    }
}
