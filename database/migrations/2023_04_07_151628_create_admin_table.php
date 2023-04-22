<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->string('password');
            $table->string('nik', 16)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Admin::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
