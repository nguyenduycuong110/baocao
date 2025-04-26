<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->integer('flow_decl'); // Số lượng tờ khai luồng 
            $table->integer('stop_via_supervision'); // Dừng hàng qua KVGS
            $table->integer('violated_decl'); // Tờ khai phát hiện vi phạm
            $table->integer('collect_bus_info'); // Thu thập thông tin doanh nghiệp
            $table->integer('prop_disb_setup'); // Đề xuất thiết lập tiêu chí
            $table->integer('act_disb_setup'); // Thiết lập tiêu chí phân tích
            $table->integer('item_profile_set'); // Thiết lập hồ sơ mặt hàng trọng điểm
            $table->integer('bus_profile_set'); // Thiết lập hồ sơ doanh nghiệp trọng điểm
            $table->date('entry_date');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->tinyInteger('publish')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risks');
    }
};
