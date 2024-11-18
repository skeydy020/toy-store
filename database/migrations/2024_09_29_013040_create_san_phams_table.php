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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id(); 
            $table->string('Code');// mã sp
            $table->string('name');  // Cột tên sản phẩm
            $table->string('thumb',255);  //ảnh
            $table->text('description')->nullable();  // Cột mô tả sản phẩm, có thể null
            $table->double('Gia', 10, 2);  // Cột giá với định dạng số thập phân (tối đa 10 chữ số, 2 chữ số sau dấu phẩy)
            $table->double('GiamGia', 10, 2);  // Cột giá với định dạng số thập phân (tối đa 10 chữ số, 2 chữ số sau dấu phẩy)
            $table->unsignedBigInteger('menu_id');  // Cột khóa phụ danh mục

            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('menu_id')
                  ->references('id')
                  ->on('menus')
                  ->onDelete('cascade'); // Nếu danh mục bị xóa, sản phẩm cũng bị xóa

            $table->unsignedBigInteger('dotuoi_id');  // Cột khóa phụ danh mục
            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('dotuoi_id')
                  ->references('id')
                  ->on('do_tuois');

            $table->unsignedBigInteger('gioitinh_id');  // Cột khóa phụ danh mục
            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('gioitinh_id')
                  ->references('id')
                  ->on('gioi_tinhs');

            $table->unsignedBigInteger('thuonghieu_id');  // Cột khóa phụ danh mục
            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('thuonghieu_id')
                  ->references('id')
                  ->on('thuong_hieus'); 

            $table->unsignedBigInteger('xuatxu_id');  // Cột khóa phụ danh mục
            // Khóa phụ, tham chiếu tới bảng categories
            $table->foreign('xuatxu_id')
                  ->references('id')
                  ->on('xuat_xus');


            $table->integer('SoLuong');  // Cột số lượng sản phẩm


            $table->longtext('content')->nullable();
            $table->integer('active');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
