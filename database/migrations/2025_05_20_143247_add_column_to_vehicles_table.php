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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->tinyInteger('close')->default(0);
            $table->unsignedBigInteger('person_close_id')->nullable(); 
            $table->foreign('person_close_id')->references('id')->on('users') ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('close');
            $table->dropColumn('person_close_id');
        });
    }
};
