<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurus2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus2', function (Blueprint $table) {
            $table->id();
            $table->integer('jenis_sampah_id');
            $table->date('tanggal');
            $table->string('nama');
            $table->string('phone')->nullable();
            $table->string('jenis_sampah');
            $table->string('harga_satuan');
            $table->string('berat');

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
        Schema::dropIfExists('pengurus2');
    }
}
