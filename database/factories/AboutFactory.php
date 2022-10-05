<?php

namespace Database\Factories;

use App\Models\About;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = About::class;

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
            'text_ar' => 'نص عن الموقع نص عن الموقع نص عن الموقع نص عن الموقع نص عن الموقع نص عن الموقع ' . $index,
            'text_en' => 'About Us Website text About Us Website text About Us Website text About Us Website text About Us Website text ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
