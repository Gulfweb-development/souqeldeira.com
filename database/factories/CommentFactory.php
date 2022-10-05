<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'ad_id' => Ad::inRandomOrder()->first()->id,
            'text' => $this->faker->paragraph(),
            'stars' => rand(1,5),
            'is_approved' => rand(0,1),
        ];
    }
}
