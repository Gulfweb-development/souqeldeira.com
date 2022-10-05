<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Policy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Policy::class;

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
            'name_ar' => 'عنوان سياسة الاستخدام رقم ' . $index,
            'name_en' => 'Title of policy number  ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
