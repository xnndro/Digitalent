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
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->string('class_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('form_status')->nullable();
            $table->string('roommate_status')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['name' => 'Admin', 'email' => 'admin@digitalent.id','password' => Hash::make('admin'), 'role' => 'admin','class_id' => 'NULL','phone' => '088275169992'],
            ['name' => 'User', 'email' => 'user@digitalent.id','password' => Hash::make('user'), 'role' => 'user','class_id' => '1','phone' => '088275169992'],
            ['name' => 'Femme', 'email' => 'femme@vendor.id', 'password' => Hash::make('femme'), 'role' => 'vendor','class_id' => 'NULL','phone' => '088275169992'],
            ['name' => 'Bclean', 'email' => 'Bclean@vendor.id', 'password' => Hash::make('bclean'), 'role' => 'vendor','class_id' => 'NULL','phone' => '088275169992'],
            ['name' => 'Mills', 'email' => 'mills@vendor.id', 'password' => Hash::make('mills'), 'role' => 'vendor','class_id' => 'NULL','phone' => '088275169992'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
