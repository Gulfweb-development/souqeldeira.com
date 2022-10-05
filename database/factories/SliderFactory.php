<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

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
            'name_ar' => 'عنوان على الصورة' . $index,
            'name_en' => 'Title On Image ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
