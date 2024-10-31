<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi'; // Nama tabel yang sesuai

    protected $fillable = [
        'donatur_id',
        'jumlah',
        'deskripsi',
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'donatur_id'); // Relasi dengan model Donatur
    }
}
