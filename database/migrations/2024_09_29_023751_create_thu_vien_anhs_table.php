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
        Schema::create('thu_vien_anhs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sanpham_id');  // Cột khóa phụ danh mục

            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('sanpham_id')
                  ->references('id')
                  ->on('san_phams')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa
            $table->string('thumb',255);  //ảnh
            $table->integer('active');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thu_vien_anhs');
    }
};
