<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $guarded = [];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'pengguna_id');
    }
}
