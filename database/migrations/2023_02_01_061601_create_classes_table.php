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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('namaKelas');
            $table->integer('jumlahSiswa')->default(0);
            $table->string('status')->default('Belum Lulus');
            $table->timestamps();
        });

        DB::table('classes')->insert([
            ['namaKelas' => 'PPBP 1'],
            ['namaKelas' => 'PPBP 2'],
            ['namaKelas' => 'PPBP 3'],
            ['namaKelas' => 'PPBP 4'],
            ['namaKelas' => 'PPBP 5'],
            ['namaKelas' => 'PPTI 11'],
            ['namaKelas' => 'PPTI 12'],
            ['namaKelas' => 'PPTI 13'],
            ['namaKelas' => 'PPTI 14'],
            ['namaKelas' => 'PPTI 15'],
            ['namaKelas' => 'PPTI 16']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
};
