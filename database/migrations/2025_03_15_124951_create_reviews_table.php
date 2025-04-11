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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Liên kết với bảng users
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Liên kết với bảng products
            $table->text('content');
            $table->unsignedTinyInteger('rating'); // Đảm bảo chỉ nhận giá trị từ 0-255 (dùng cho rating 1-5 sao)
            $table->timestamps();
            $table->softDeletes(); // Thêm soft deletes để khớp với cấu trúc hiện tại
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
