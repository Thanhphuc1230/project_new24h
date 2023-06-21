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
        Schema::create('history', function (Blueprint $table) {
            $table->id('id_history');
            $table->uuid();
            $table->uuid('uuid_post');
            $table->uuid('user_uuid');
            $table->unsignedTinyInteger('status_history');
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
        Schema::dropIfExists('history');
    }
};
