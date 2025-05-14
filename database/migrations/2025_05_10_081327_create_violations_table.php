<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->integer('smuggling_cases');
            $table->integer('smuggling_value');
            $table->integer('drug_cases');
            $table->integer('drug_pills');
            $table->integer('ip_cases');
            $table->integer('ip_value');
            $table->integer('admin_cases');
            $table->integer('admin_value');
            $table->integer('other_cases');
            $table->integer('other_value');
            $table->date('entry_date');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');    
            $table->tinyInteger('publish')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};
