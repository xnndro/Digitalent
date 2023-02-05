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
        Schema::dropIfExists('type_of_storages');
        Schema::create('type_of_storages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('expiry_date')->unsigned()->default(14);
        });

        DB::table('type_of_storages')->insert([
            ['name' => 'Sayur & Buah', 'expiry_date' => 4],
            ['name' => 'Obat & Skincare', 'expiry_date' => 14],
            ['name' => 'Telur', 'expiry_date' => 14],
            ['name' => 'Minuman', 'expiry_date' =>7],
            ['name' => 'Frozen Food', 'expiry_date' => 14],
            ['name' => 'Makanan', 'expiry_date' => 7],
            ['name' => 'Lainnya', 'expiry_date' => 14]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_of_storages');
    }
};
