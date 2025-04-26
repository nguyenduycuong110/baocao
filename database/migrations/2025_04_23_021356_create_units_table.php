<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->integer('total_unit_personnel');
            $table->integer('present_personnel');
            $table->integer('leadership_duty');
            $table->integer('absent_personnel');
            $table->integer('training_absence');
            $table->integer('leave_absence'); 
            $table->integer('compensatory_leave');
            $table->date('entry_date');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');    
            $table->tinyInteger('publish')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
