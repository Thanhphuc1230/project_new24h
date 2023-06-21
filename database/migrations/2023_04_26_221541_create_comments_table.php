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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id_comment');
            $table->uuid();
            $table->string('comment');
            $table->string('user_uuid_comment');
            $table->unsignedTinyInteger('status_comment');
            $table->string('post_uuid_comment');
            $table->timestamps();

            $table->foreign('user_uuid_comment')->references('uuid')->on('users');
            $table->foreign('post_uuid_comment')->references('uuid')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
