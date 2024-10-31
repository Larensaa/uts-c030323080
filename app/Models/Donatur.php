<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donatur'; // Nama tabel yang sesuai

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'foto',
    ];

    public function donasis()
{
    return $this->hasMany(Donasi::class, 'donatur_id'); // Relasi dengan model Donasi
}
}