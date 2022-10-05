<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

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
            'title_ar' => 'ميتا العنوان الصفحة الرئيسية رقم'.$index,
            'title_en' => 'meta title home page number ' . $index,
            'description_ar' => 'ميتا الوصف الصفحة الرئيسية رقم ميتا الوصف الصفحة الرئيسية رقم ميتا الوصف الصفحة الرئيسية رقم' . $index,
            'description_en' => 'meta description home page number meta description home page number meta description home page number ' . $index,
            // 'publish_all_to_social_media' => rand(0,1),
            'facebook' => 'facebook.com',
            'twitter' => 'twitter.com',
            'instagram' => 'instagram.com',
            'youtube' => 'youtube.com',
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ];
    }
}
