<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class VariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 100),
            'weight' => $this->faker->numberBetween(1, 100),
            'length' => $this->faker->numberBetween(1, 100),
            'width' => $this->faker->numberBetween(1, 100),
            'height' => $this->faker->numberBetween(1, 100),
            'thickness' => $this->faker->numberBetween(1, 100),
            'diameter' => $this->faker->numberBetween(1, 100),
        ];
    }
}
