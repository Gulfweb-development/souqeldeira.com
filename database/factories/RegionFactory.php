<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Region;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Region::class;

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
            'governorate_id' => Governorate::inRandomOrder()->first()->id,
            'name_ar' => 'اسم المنطقة ' . $index,
            'name_en' => 'Region ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
