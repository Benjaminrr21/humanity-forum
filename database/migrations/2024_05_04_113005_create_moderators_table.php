<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moderators', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->char('gender');
            $table->string('city');
            $table->string('country');
            $table->string('dateofbirth');
            $table->string('JMBG');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->string('password');
            
             $table->timestamp('email_verified_at')->nullable();

             $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

           $table->rememberToken(); 

           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderators');
    }
};
