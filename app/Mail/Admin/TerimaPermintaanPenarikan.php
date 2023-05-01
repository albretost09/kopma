<?php

namespace App\Mail\Admin;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TerimaPermintaanPenarikan extends Mailable
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
        $admin = Admin::query()->where('username', 'admin')->first();

        return $this->subject('[Pemberitahuan] Permintaan Penarikan Dana Diterima')
            ->view('emails.admin.terima-permintaan-penarikan', compact('permintaanPenarikan', 'user', 'admin'));
    }
}
