<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ma_san_pham' => $this->faker->unique()->numerify('SP###'),
            'ten_san_pham' => $this->faker->word(),
            'gia_san_pham' => $this->faker->randomFloat(2, 1000, 100000),
            'giam_gia' => $this->faker->optional()->randomFloat(2, 0, 50),
            'img' => null,
            'so_luong' => $this->faker->numberBetween(1, 100),
            'ngay_nhap_kho' => $this->faker->dateTimeThisYear(),
            'mo_ta' => $this->faker->text(),
            'trang_thai' => $this->faker->boolean(),
        ];
    }
}
