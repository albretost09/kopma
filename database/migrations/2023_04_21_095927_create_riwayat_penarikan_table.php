<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPenarikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_penarikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simpanan_id')->constrained('simpanan');
            $table->integer('jumlah_penarikan');
            $table->string('jenis_transaksi');
            $table->string('bank_tujuan')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->dateTime('tanggal_penarikan')->default(now());
            $table->string('status')->default('MENUNGGU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_penarikan');
    }
}
