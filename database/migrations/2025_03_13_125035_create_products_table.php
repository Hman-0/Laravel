<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**Magration dùng để thao tác với cơ sở dữ liệu
     * TRong một file bắt buộc phải có up và down
     * up: thực hiện các công việc thay đổi hay câp nhật cơ sở dữ liệu 
     * down: thực hiện các công việc ngược lại với up bảng
    
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //Set độ dài và và quy định không đc trùng nhau 
            $table->string('ma_san_pham' , 20) -> unique();
            $table->string('ten_san_pham' , 100);
            $table->decimal('gia_san_pham' , 10 , 2);
            //nullable cho phép null
            $table->decimal('giam_gia' , 10 , 2) ->nullable();
            //unsignedInteger không cho phép số âm
            $table->unsignedInteger('so_luong');
            $table->date('ngay_nhap_kho');
            $table->text('mo_ta')->nullable();
            //default giá trị mặc định
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
