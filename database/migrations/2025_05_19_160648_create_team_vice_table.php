<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('team_vice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->nullable(); 
            $table->foreign('team_id')->references('id')->on('teams') ->onDelete('set null');
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->foreign('user_id')->references('id')->on('users') ->onDelete('set null');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('team_vice');
    }
};
