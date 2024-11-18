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
        Schema::create('p_t_thanh_toans', function (Blueprint $table) {
            $table->id();
            $table->string('TenPt',255);
            $table->text('MoTa');
            $table->integer('KichHoat'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_t_thanh_toans');
    }
};
