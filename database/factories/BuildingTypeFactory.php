<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\BuildingType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuildingType::class;

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
            'name_ar' => 'نوع العقار ' . $index,
            'name_en' => 'Building Type ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
