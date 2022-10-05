<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

class GovernorateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Governorate::class;

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
            'name_ar' => ' المحافظة ' . $index,
            'name_en' => 'Governorate ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
