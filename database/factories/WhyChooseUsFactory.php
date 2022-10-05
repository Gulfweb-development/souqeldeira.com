<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\WhyChooseUs;
use Illuminate\Database\Eloquent\Factories\Factory;

class WhyChooseUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WhyChooseUs::class;

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
            'name_ar' => 'عنوان رقم ' . $index,
            'name_en' => 'Title Number ' . $index,
            'text_ar' => 'نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص نص ' . $index,
            'text_en' => 'text text text text text text text text text text text text ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
