<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->bigInteger('smuggling_value')->change();
            $table->bigInteger('drug_pills')->change();
            $table->bigInteger('ip_value')->change();
            $table->bigInteger('admin_value')->change();
            $table->bigInteger('other_value')->change();
        });
    }

    
    public function down(): void
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->integer('smuggling_value')->change();
            $table->integer('drug_pills')->change();
            $table->integer('ip_value')->change();
            $table->integer('admin_value')->change();
            $table->integer('other_value')->change();
        });
    }
};
