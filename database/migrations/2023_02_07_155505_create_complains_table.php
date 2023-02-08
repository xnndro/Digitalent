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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->string('complain_id');
            $table->string('user_id');
            $table->string('user_room')->nullable();
            $table->string('complain_type');
            $table->string('transaction_id')->nullable();
            $table->string('fotoBarang')->nullable();
            $table->string('complain_name');
            $table->text('description');
            $table->string('jumlahBarang')->nullable();
            $table->string('status')->default('pending');

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
        Schema::dropIfExists('complains');
    }
};
