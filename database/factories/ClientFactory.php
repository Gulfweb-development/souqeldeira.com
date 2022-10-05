<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $index = 0;
        $index = $index + 1;
        return [
            'name_ar' => 'الاسم ' . $index,
            'name_en' => 'Name ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
