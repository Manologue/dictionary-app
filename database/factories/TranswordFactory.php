<?php

namespace Database\Factories;

use App\Models\Keyword;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transword>
 */
class TranswordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word' => fake()->word,
            'class' => fake()->word,
            'vocal' => fake()->word,
            'etymology' => fake()->sentence,
            'sample' => fake()->sentence,
            'active' => fake()->boolean,
            // 'keyword_id' => Keyword::all()->random()->id,
            'keyword_id' => Keyword::whereBetween('id', [10000, 11738])->get()->random()->id,
            'created_by' => 1,
            'updated_by' => null,
        ];
    }
}
