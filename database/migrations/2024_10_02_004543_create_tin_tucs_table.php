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
        Schema::create('tin_tucs', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('thumb',255);
            $table->text('description');

            $table->unsignedBigInteger('user_id');  // Cột khóa phụ danh mục

            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa

            $table->unsignedBigInteger('danhmuc_id');  // Cột khóa phụ danh mục

            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('danhmuc_id')
                  ->references('id')
                  ->on('danh_muc_tin_tucs')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa
            $table->longtext('content');

            $table->integer('active');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_tucs');
    }
};
