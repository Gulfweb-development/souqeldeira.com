<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agency::class;

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
            'user_id' => User::where('type', 'COMPANY')->inRandomOrder()->first()->id,
            'name_ar' => 'اسم الوكالة العقارية ' . $index,
            'name_en' => 'Agency Name ' . $index,
            'text_ar' => 'وصف الوكالة العقارية  وصف الوكالة العقارية  وصف الوكالة العقارية  وصف الوكالة العقارية ' . $index,
            'text_en' => 'Agency Description ' . $index,
            'is_featured' => rand(0,1),
        ];

    }
}
