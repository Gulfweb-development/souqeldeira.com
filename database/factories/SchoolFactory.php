<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\School;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static  $index = 0;
        $index = $index + 1;
        return [
            'governorate_id' => Governorate::inRandomOrder()->first()->id,
            'region_id' => Region::inRandomOrder()->first()->id,
            'title_ar' => 'عنوان المدرسة رقم ' .$index,
            'title_en' => 'Title School Number '.$index,
            'text_ar' => 'وصف المدرسة وصف المدرسة وصف المدرسة وصف المدرسة  رقم'. $index,
            'text_en' => 'Ad Description Ad Description Ad Description Ad Description School Number '. $index,
            'map_link' => 'map link is here',
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail(),
            'facebook' => 'facebook.com',
            'twitter' => 'twitter.com',
            'instagram' => 'instagram.com',
            'snapchat' => 'snapchat.com',
            'youtube' => 'youtube.com',
        ];
    }
}
