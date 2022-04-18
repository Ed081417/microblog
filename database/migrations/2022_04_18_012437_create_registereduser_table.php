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
        // Schema::create('registereduser', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        // Schema::create('users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('first_name');
        //     $table->string('middle_name')->nullable();
        //     $table->string('last_name');
        //     $table->date('date_of_birth');
        //     $table->string('email')->unique();
        //     $table->string('username');           
        //     $table->string('password');
        //     $table->string('image')->nullable();
        //     $table->string('token_verification');
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->timestamp('created_at')->nullable()->useCurrent();
        //     $table->timestamp('updated_at')->nullable()->useCurrent();
        //     $table->timestamp('deleted_at')->nullable();
        //     $table->rememberToken();

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registereduser');
    }
};
