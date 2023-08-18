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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('volatility'); //+ hoặc trừ hoặc nạp tiền
            $table->string('notify')->default(null); //+ hoặc trừ hoặc nạp tiền
            $table->integer('type')->default(0); //0 là check , 1 là nạp rút
            $table->integer('status')->default(0); //0 chưa xử lý, 1 là phê duyệt, 2 là từ chối
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
