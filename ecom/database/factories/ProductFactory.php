<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'productID' => $this->faker->uuid,
            'productName' => $this->faker->word,
            'productBrandID' => $this->faker->uuid,
            'subCategoryID' => $this->faker->uuid,
            'productOriginalPrice' => $this->faker->randomNumber(),
            'productDiscountPrice' => $this->faker->randomNumber(),
            'productInfo' => $this->faker->text,
            'productBarcode' => $this->faker->word,
            'productInStock' => $this->faker->randomNumber(),
            'productImage' => $this->faker->word,
            'productSideImage1' => $this->faker->word,
            'productSideImage2' => $this->faker->word,
            'productSideImage3' => $this->faker->word,
            'productCreatedDate' => $this->faker->dateTime(),
            'productModifiedDate' => $this->faker->dateTime(),
            'isFlashSale' => $this->faker->boolean,
            'isActive' => $this->faker->boolean,
        ];
    }
}
