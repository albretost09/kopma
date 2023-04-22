<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    protected $table = 'simpanan';

    protected $guarded = [];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function riwayatPenarikan()
    {
        return $this->hasMany(RiwayatPenarikan::class, 'simpanan_id');
    }
}
