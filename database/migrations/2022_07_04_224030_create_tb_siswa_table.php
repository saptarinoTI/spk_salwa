<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('pendaftar', 8)->nullable();
            $table->enum('jenjang', ['sd', 'smp', 'sma'])->nullable();
            $table->enum('kondisi_ortu', ['1', '2', '3'])->nullable();
            $table->bigInteger('penghasilan_ortu')->nullable();
            $table->enum('kepemilikan_rmh', ['1', '2'])->nullable();
            $table->bigInteger('kepemilikan_hrt')->nullable();
            $table->bigInteger('pengeluaran_bln')->nullable();
            $table->enum('hutang_bnk', ['1', '2', '3', '4', '5'])->nullable();
            $table->enum('hutang_lain', ['1', '2', '3', '4', '5'])->nullable();
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
        Schema::dropIfExists('tb_siswa');
    }
};
