<?php

namespace App\Mail\Anggota;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermintaanPenarikan extends Mailable
{
    use Queueable, SerializesModels;

    private $permintaanPenarikan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($permintaanPenarikan)
    {
        $this->permintaanPenarikan = $permintaanPenarikan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $permintaanPenarikan = $this->permintaanPenarikan;
        $user = $permintaanPenarikan->simpanan->pengguna;
        return $this->subject('[Permintaan Penarikan] ' . $user->nama)
            ->view('emails.anggota.permintaan-penarikan', compact('permintaanPenarikan', 'user'));
    }
}
