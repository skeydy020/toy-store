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
        Schema::create('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donhang_id');  // Cột khóa phụ danh mục

            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('donhang_id')
                  ->references('id')
                  ->on('don_hangs')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa

            $table->unsignedBigInteger('sanpham_id');  // Cột khóa phụ danh mục
            $table->foreign('sanpham_id')
                  ->references('id')
                  ->on('san_phams')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa

            $table->integer('SoLuong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_don_hangs');
    }
};
