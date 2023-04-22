<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenarikan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penarikan';

    protected $guarded = [];

    public function simpanan()
    {
        return $this->belongsTo(Simpanan::class, 'simpanan_id');
    }
}
