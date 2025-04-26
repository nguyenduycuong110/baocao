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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('vat_tax');
            $table->integer('export_import_tax');
            $table->integer('income_tax');
            $table->integer('personal_income_tax');
            $table->integer('other_revenue');
            $table->integer('refunded_tax_declaration');
            $table->integer('refunded_tax_amount');
            $table->integer('current_debt');
            $table->integer('overdue_debt');
            $table->integer('tax_collection_declaration');
            $table->integer('tax_amount');
            $table->integer('business');
            $table->date('entry_date');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->tinyInteger('publish')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
