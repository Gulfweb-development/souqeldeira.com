<?php

namespace Database\Factories;

use App\Models\Info;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Info::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text_ar' => 'الهاتف : 123131233123
            البريد الالكترونى : test@test.com
            فاكس : 123213',
            'text_en' => 'phone : (386) 413-2754
email : test@test.com
fax: 123213',
        ];
    }
}
