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
        Schema::create('laundry_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->string('minimal_unit');
            $table->timestamps();
        });

        DB::table('laundry_types')->insert([
            ['name' => 'Kiloan', 'price' => 8500, 'minimal_unit' => '3'],
            ['name' => 'Selimut & Matras', 'price' => 12000, 'minimal_unit' => '2'],
            ['name' => 'Bantal & Guling' , 'price' => 36000, 'minimal_unit' => '2']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laundry_types');
    }
};
