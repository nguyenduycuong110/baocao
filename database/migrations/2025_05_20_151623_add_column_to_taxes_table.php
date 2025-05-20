<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->tinyInteger('close')->default(0);
            $table->unsignedBigInteger('person_close_id')->nullable(); 
            $table->foreign('person_close_id')->references('id')->on('users') ->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->dropColumn('close');
            $table->dropColumn('person_close_id');
        });
    }
};
