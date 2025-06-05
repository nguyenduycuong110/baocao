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
        Schema::table('taxes', function (Blueprint $table) {
            $table->float('vat_tax')->change();
            $table->float('export_import_tax')->change();
            $table->float('income_tax')->change();
            $table->float('personal_income_tax')->change();
            $table->float('other_revenue')->change();
            $table->float('refunded_tax_amount')->change();
            $table->float('refunded_tax_declaration')->change();
            $table->float('current_debt')->change();
            $table->float('overdue_debt')->change();
            $table->float('tax_collection_declaration')->change();
            $table->float('tax_amount')->change();
            $table->float('business')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->integer('vat_tax')->change();
            $table->integer('export_import_tax')->change();
            $table->integer('income_tax')->change();
            $table->integer('personal_income_tax')->change();
            $table->integer('other_revenue')->change();
            $table->integer('refunded_tax_amount')->change();
            $table->integer('refunded_tax_declaration')->change();
            $table->integer('current_debt')->change();
            $table->integer('overdue_debt')->change();
            $table->integer('tax_collection_declaration')->change();
            $table->integer('tax_amount')->change();
            $table->integer('business')->change();
        });
    }
};
