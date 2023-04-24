<?php

namespace App\Models;

use App\Notifications\AnggotaResetPasswordNotification;
use App\Notifications\PenggunaResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
