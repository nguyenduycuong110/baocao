<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->integer('green_channel');
            $table->integer('yellow_channel');
            $table->integer('red_channel');
            $table->integer('void_declaration');
            $table->integer('green_channel_import');
            $table->integer('yellow_channel_import');
            $table->integer('red_channel_import');
            $table->integer('void_declaration_import');
            $table->integer('temp_import');
            $table->integer('reexport');
            $table->integer('overdue_not_reexported');
            $table->integer('export_turnover');
            $table->integer('import_turnover');
            $table->integer('taxable_export_turnover');
            $table->integer('taxable_import_turnover');
            $table->integer('outgoing_transit');
            $table->integer('incoming_transit');
            $table->integer('outgoing_transit_turnover');
            $table->integer('incoming_transit_turnover');
            $table->date('entry_date');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');    
            $table->tinyInteger('publish')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
