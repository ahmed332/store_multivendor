<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=$this->faker->words(2,true);
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            // 'description'=>$this->faker->sentences(),
                    'description' => implode(' ', $this->faker->sentences(15)), // تحويل المصفوفة إلى نص

            'image'=>$this->faker->imageUrl,
        ];
    }
}
