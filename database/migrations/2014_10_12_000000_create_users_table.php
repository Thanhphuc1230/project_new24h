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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('fullname');
            $table->string('phone',20)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('provider',50)->nullable();
            $table->string('provider_id')->nullable();
            $table->tinyInteger('level')->default(3)->comment('1:Admin - 2:Staff - 3:User');
            $table->string('avatar')->nullable();
            $table->tinyInteger('status_user')->default(1);
            $table->rememberToken();
            $table->string('email_token',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
