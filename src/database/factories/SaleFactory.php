<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $value = $this->faker->numberBetween($min = 10, $max = 6000);
        $comission = $value * (8.5 / 100);
        return [
            'value' => $value,
            'comission' => $comission,
            'seller_id' => $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
