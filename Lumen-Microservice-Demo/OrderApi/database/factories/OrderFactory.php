<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => 1,
            'quantity' => $this->faker->numberBetween(0,90),
            'discount' => $this->faker->numberBetween(0,90),
            'total_price' => $this->faker->numberBetween(0,90),
        ];
    }
}
