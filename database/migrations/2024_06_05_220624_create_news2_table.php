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
        Schema::create('newss2s', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('owner');

            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news2');
    }
};
