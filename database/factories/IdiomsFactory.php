<?php

namespace Database\Factories;

use App\Models\Transword;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idioms>
 */
class IdiomsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => fake()->sentence,
            // 'transword_id' => Keyword::all()->random()->id,
            'transword_id' => Transword::whereBetween('id', [900, 1000])->get()->random()->id,
            'created_by' => 1,
            'updated_by' => null,
        ];
    }
}
