<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

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
            'title_ar' => 'عنوان التدوينة  رقم ' . $index,
            'title_en' => 'Title of blog number ' . $index,
            'text_ar' => 'نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم نص التدوينة رقم ' . $index,
            'text_en' => 'Text of blog number Text of blog number Text of blog number Text of blog number Text of blog number Text of blog number Text of blog number Text of blog number Text of blog number Text of blog number ' . $index,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
