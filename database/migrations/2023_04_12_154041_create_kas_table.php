<?php

use App\Models\Kas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->string('no_cek')->nullable();
            $table->integer('jumlah');
            $table->string('jenis');
            $table->string('keterangan')->nullable();
            $table->dateTime('tanggal_transaksi')->default(now());
            $table->timestamps();
        });

        Kas::factory()->count(5)->create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas');
    }
}
