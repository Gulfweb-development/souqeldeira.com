<?php

namespace Database\Factories;

use App\Models\Faq;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;

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
            'question_ar' => 'السؤال رقم ' . $index,
            'question_en' => 'Question Number ' . $index,
            'answer_ar' => 'اجابة على السؤال رقم ' . $index,
            'answer_en' => 'Answer Of Question Number ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
