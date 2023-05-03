<?php

use App\Models\Pengguna;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->string('password');
            $table->string('jenis_kelamin')->nullable();
            $table->string('email')->unique();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('nim')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('role')->default('ANGGOTA');
            $table->string('status')->default('NONAKTIF');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Pengguna::factory(3)->create([
            'role' => 'PENGURUS',
            'status' => 'AKTIF',
        ]);

        Pengguna::factory(12)->create([
            'role' => 'ANGGOTA',
        ]);

        Pengguna::factory()->create([
            'nama' => 'Angellita',
            'username' => 'angellita',
            'role' => 'ANGGOTA',
            'status' => 'AKTIF',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
