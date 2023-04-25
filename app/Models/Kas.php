<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    protected $table = 'kas';

    protected $guarded = [];

    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];

    public function getTanggalDibuatAttribute()
    {
        if ($this->tanggal_transaksi) {
            return $this->tanggal_transaksi->format('d-m-Y');
        }
    }
}
