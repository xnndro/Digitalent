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
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('laundry_transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->float('total_pcs');
            $table->float('total_kg');
            $table->string('laundry_vendor_id');
            $table->date('tanggalMasuk');
            $table->date('tanggalVendor');
            $table->date('tanggalAmbil');
            $table->string('status');
            $table->string('laundry_type_id');
            $table->float('total_price');
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
        Schema::dropIfExists('laundries');
    }
};
