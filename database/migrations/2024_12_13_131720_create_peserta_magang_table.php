<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_magang', function (Blueprint $table) {
            $table->integer('id_peserta')->autoIncrement();
            $table->integer('id_instansi');
            $table->string('nama', 255);
            $table->string('nomor_induk', 50)->unique();
            $table->enum('jenis_kelamin', ['laki laki', 'perempuan']);
            $table->text('alamat')->nullable();
            $table->string('jurusan', 255);
            $table->enum('status', ['mahasiswa', 'siswa']);
            $table->string('berkas', 255)->nullable(); // Berkas untuk upload file
            $table->timestamps();
            $table->foreign('id_instansi')->references('id_instansi')->on('instansi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_magang');
    }
}