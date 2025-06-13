<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->decimal('export_turnover', 15, 2)->change();
            $table->decimal('import_turnover', 15, 2)->change();
            $table->decimal('outgoing_transit_turnover', 15, 2)->change();
            $table->decimal('incoming_transit_turnover', 15, 2)->change();
        });
    }

    
    public function down(): void
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->integer('export_turnover')->change();
            $table->integer('import_turnover')->change();
            $table->integer('outgoing_transit_turnover')->change();
            $table->integer('incoming_transit_turnover')->change();
        });
    }
};
