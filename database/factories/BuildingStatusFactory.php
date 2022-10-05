<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\BuildingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuildingStatus::class;

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
            'name_ar' => 'حالة العقار ' . $index,
            'name_en' => 'Building Status ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
