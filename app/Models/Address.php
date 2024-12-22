<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Nama tabel (jika berbeda dari plural model)
    protected $table = 'alamat';

    // Primary key
    protected $primaryKey = 'id_alamat'; // Sesuaikan dengan nama primary key di tabel

    // Non-incrementing (opsional, jika primary key bukan integer auto-increment)
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Kolom yang bisa diisi
    protected $fillable = ['label', 'address', 'courier_note', 'postalcode', 'id_user'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
