<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\AnggotaResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PenggunaResetPasswordNotification;

class Pengguna extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $guarded = [];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PenggunaResetPasswordNotification($token, $this->email, $this->role));
    }

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'pengguna_id');
    }

    public function getJenisKelaminAttribute($value)
    {
        return $value == 'L' ? 'Laki-laki' : 'Perempuan';
    }
}
