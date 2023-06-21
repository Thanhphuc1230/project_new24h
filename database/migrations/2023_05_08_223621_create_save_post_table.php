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
        Schema::create('save_post', function (Blueprint $table) {
            $table->id('id_save_post');
            $table->uuid();
            $table->uuid('uuid_post');
            $table->uuid('user_uuid');
            $table->unsignedTinyInteger('status_save');
            $table->timestamps();

            $table->foreign('uuid_post')->references('uuid')->on('news');
            $table->foreign('user_uuid')->references('uuid')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_post');
    }
};
