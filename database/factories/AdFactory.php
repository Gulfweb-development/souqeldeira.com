<?php

namespace Database\Factories;

use App\Models\Ad;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agency;
use App\Models\Region;
use App\Models\Governorate;
use Illuminate\Support\Str;
use App\Models\BuildingType;
use App\Models\BuildingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

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
            'user_id' => User::inRandomOrder()->first()->id,
            'region_id' => Region::inRandomOrder()->first()->id,
            'governorate_id' => Governorate::inRandomOrder()->first()->id,
            'building_type_id' => BuildingType::inRandomOrder()->first()->id,
            'code' => Str::random(6),
            'title' => 'عنوان الاعلان رقم ' .$index,
            'text' => 'وصف الاعلان وصف الاعلان وصف الاعلان وصف الاعلان  رقم'. $index,
            'price' => (float)rand(1000,100000),
            'views' => rand(1000,100000),
            'phone' => $this->faker->phoneNumber,
            'archived_at' => Carbon::now()->addDay(rand(1,30))->format('Y-m-d H:i:s'),
            'type' => $this->faker->randomElement(['SALE', 'RENT']),
            'is_featured' => rand(0,1),
            'is_approved' => 1,
        ];
    }
}
