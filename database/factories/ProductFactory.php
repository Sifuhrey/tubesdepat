<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($this->faker));
        return [
            'productname' => $this->faker->foodName(),
            'category' => $this->faker->randomElement(['putih', 'hitam', 'aromatik', 'ketan']),
            'price' => $this->faker->numberBetween(15000, 50000),
            'stock' => $this->faker->numberBetween(10, 50),
            'description' => $this->faker->text(1600),
            'imgname' => $this->faker->imageUrl(800, 800, 'animals', true, 'Product Image'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
