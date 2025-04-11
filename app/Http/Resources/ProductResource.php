<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=> $this->id,
            'ma_san_pham'=> $this->ma_san_pham,
            'ten_san_pham'=> $this->ten_san_pham,
            'category'=> $this->category->ten_danh_muc ?? null,
            'gia_san_pham'=> $this->gia_san_pham,
            'giam_gia'=> $this->giam_gia,
            'img'=> $this->img,
            'so_luong'=> $this->so_luong,
            'ngay_nhap_kho'=> $this->ngay_nhap_kho,
            'mo_ta'=> $this->mo_ta,
            'trang_thai'=> $this->trang_thai,
            'created_at'=> $this->created_at->diffForHumans(),
        ];
    }
}
