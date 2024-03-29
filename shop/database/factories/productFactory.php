<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->sentence($nbWords =2, $VariableWords=true),
            'price' => $this->faker->randomFloat($nbMaxDecimals=NULL, $min=100000, $max=NULL),
            'created_at' => $this->faker->dateTime($max='now', $timezone=NULL),
            'updated_at' => $this->faker->dateTime($max='now', $timezone=NULL)
        ];
    }
}
