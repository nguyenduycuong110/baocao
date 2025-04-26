<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->integer('declaration');
            $table->integer('accept_value');
            $table->integer('reject_value');
            $table->date('entry_date');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('note')->nullable();
            $table->tinyInteger('publish')->default(2);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
