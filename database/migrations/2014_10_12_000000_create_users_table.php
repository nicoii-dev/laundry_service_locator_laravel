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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('role');
            $table->string('status');
            $table->string('email')->unique();
            $table->string('is_verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

            // Insert some stuff
            DB::table('users')->insert(
                array(
                    'id' => '1',
                    'first_name' => 'admin',
                    'last_name' => 'admin',
                    'gender' => 'male',
                    'phone_number' => '09751234567',
                    'role' => 'admin',
                    'status' => '1',
                    'email' => 'admin@admin.com',
                    'is_verified' => '1',
                    'password' => bcrypt('Default123'),
                )
            );
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
