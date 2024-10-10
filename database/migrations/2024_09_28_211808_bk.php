<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konten', function (Blueprint $table) {
            $table->bigIncrements('idkonten');
            $table->String('judul');
            $table->String('tags');
            $table->date('tanggal');
            $table->integer('iduser');
            $table->string('gambar');
            $table->longText('konten');
            $table->timestamps();
        });

        Schema::create('komentar', function (Blueprint $table) {
            $table->bigIncrements('idkomentar');
            $table->String('komentar');
            $table->String('idkonten');
            $table->timestamps();
        });
        Schema::create('balasankomentar', function (Blueprint $table) {
            $table->bigIncrements('idbalasankomentar');
            $table->String('idkomentar');
            $table->String('komentar');
            $table->timestamps();
        });
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->bigIncrements('idpengaturan');
            $table->String('logo');
            $table->String('namawebsite');
            $table->longText('deskripsi');
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
        //
    }
}
