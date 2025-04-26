<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_guidelines');
            $table->integer('business_info');
            $table->integer('issue_solving');
            $table->integer('regulation_proposal');
            $table->date('entry_date');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('note')->nullable();
            $table->tinyInteger('publish')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('others');
    }
};
