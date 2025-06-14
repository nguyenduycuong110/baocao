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
        Schema::table('cargos', function (Blueprint $table) {
            $table->decimal('temp_import', 15, 2)->change();
            $table->decimal('reexport', 15, 2)->change();
            $table->decimal('overdue_not_reexported', 15, 2)->change();
            $table->decimal('export_turnover', 15, 2)->change();
            $table->decimal('import_turnover', 15, 2)->change();
            $table->decimal('taxable_export_turnover', 15, 2)->change();
            $table->decimal('taxable_import_turnover', 15, 2)->change();
            $table->decimal('outgoing_transit', 15, 2)->change();
            $table->decimal('incoming_transit', 15, 2)->change();
            $table->decimal('outgoing_transit_turnover', 15, 2)->change();
            $table->decimal('incoming_transit_turnover', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->integer('temp_import')->change();
            $table->integer('reexport')->change();
            $table->integer('overdue_not_reexported')->change();
            $table->integer('export_turnover')->change();
            $table->integer('import_turnover')->change();
            $table->integer('taxable_export_turnover')->change();
            $table->integer('taxable_import_turnover')->change();
            $table->integer('outgoing_transit')->change();
            $table->integer('incoming_transit')->change();
            $table->integer('outgoing_transit_turnover')->change();
            $table->integer('incoming_transit_turnover')->change();
        });
    }
};
