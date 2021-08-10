<?php

declare(strict_types=1);

namespace Asseco\Tags\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function modelName()
    {
        return config('asseco-tags.models.tag');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => substr($this->faker->unique()->sentence(3, true), 0, 50),
            'color' => $this->faker->hexColor,
        ];
    }
}
