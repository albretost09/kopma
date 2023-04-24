<?php

use App\Models\Pengguna;
use App\Models\Simpanan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna');
            $table->integer('jumlah');
            $table->string('jenis_simpanan');
            $table->string('jenis_transaksi')->nullable();
            $table->string('bukti_transaksi')->nullable();
            $table->dateTime('tanggal_transaksi')->default(now());
            $table->string('status')->default('DITERIMA');
            $table->timestamps();
        });

        Simpanan::create([
            'pengguna_id' => Pengguna::where('username', 'angellita')->first()->id,
            'jumlah' => 100000,
            'jenis_simpanan' => 'Pokok',
            'jenis_transaksi' => 'Tunai',
            'bukti_transaksi' => null,
            'status' => 'DITERIMA',
            'tanggal_transaksi' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simpanan');
    }
}
