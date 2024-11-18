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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');  // Cột khóa phụ danh mục

            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa
            
            $table->unsignedBigInteger('pttt_id');  // Cột khóa phụ danh mục

            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('pttt_id')
                  ->references('id')
                  ->on('p_t_thanh_toans')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa
            
            $table->string('TenKH',255);  
            $table->string('DiaChiNhanHang',255);    
            $table->string('SDT',11);
            $table->text('GhiChu');
            $table->integer('TongTien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
