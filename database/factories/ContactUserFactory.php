<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\User;
use App\Models\ContactUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ad_id' => Ad::inRandomOrder()->first()->id,
            'user_to' => User::inRandomOrder()->first()->id,
            'user_from' => User::inRandomOrder()->first()->id,
            'text' => $this->faker->paragraph(),
        ];
    }
}
