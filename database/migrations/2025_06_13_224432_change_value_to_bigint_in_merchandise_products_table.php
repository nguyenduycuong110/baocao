<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('merchandise_products', function (Blueprint $table) {
            $table->bigInteger('value')->change();
        });
    }

    
    public function down(): void
    {
        Schema::table('merchandise_products', function (Blueprint $table) {
            $table->integer('column_name')->change();
        });
    }
};
