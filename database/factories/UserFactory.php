<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone' => $this->faker->phoneNumber(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => 'password',
            'remember_token' => Str::random(10),
            'is_approved' => 1,
            'is_featured' => rand(0,1),
            // 'description_ar' => 'وصف الاعلان وصف الاعلان وصف الاعلان وصف الاعلان  رقم',
            'description' => 'user Description user Description user Description user Description  Number ',
            'type' => $this->faker->randomElement(['USER','COMPANY']),
            'field' => $this->faker->randomElement(['SALE','RENT','ALL','EXCHANGE','REQUEST']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
