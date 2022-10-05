<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\Info;
use App\Models\Role;
use App\Models\User;
use App\Models\About;
use App\Models\Admin;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Policy;
use App\Models\Region;
use App\Models\School;
use App\Models\Slider;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\ContactUser;
use App\Models\Governorate;
use App\Models\UserMessage;
use App\Models\WhyChooseUs;
use App\Models\BuildingType;
use App\Models\BuildingStatus;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermationForSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Admin::create([
            'email' => 'admin@admin.com',
            'name' => 'The Admin',
            'password' => 11111111,
        ]);
        Role::create([
            'name' => 'admin',
            'label_ar' => 'سوبر أدمن',
            'label_en' => 'Super Admin',
        ]);
        // Governorate::factory(5)->create()
        //     ->each(function ($value) {
        //         Region::factory(5)->create([
        //             'governorate_id' => $value->id,
        //         ]);
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });

        // BuildingType::factory(10)->create();

        // Slider::factory(5)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // BuildingStatus::factory(10)->create();
        // Faq::factory(20)->create();
        // Policy::factory(20)->create();
        // About::factory(5)->create();
        // Blog::factory(5)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // User::factory(5)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // Admin::factory(5)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // Company::factory(5)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // Agency::factory(5)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // Ad::factory(30)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // Setting::factory(1)->create();
        // Client::factory(5)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // WhyChooseUs::factory(4)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // Contact::factory(40)->create();
        // Info::factory(1)->create();
        // Comment::factory(300)->create();
        // ContactUser::factory(50)->create();
        // UserMessage::factory(20)->create();
        // School::factory(15)->create()
        //     ->each(function ($value) {
        //         $image = $this->createImage();
        //         $value->images()->create([
        //             'name' => $image['name'],
        //             'url'  =>  $image['url'],
        //             'group_name' => $image['group_name'],
        //         ]);
        //     });
        // Role::factory(10)->create();
        $this->call([
            PermationForSeeder::class,
            PermationSeeder::class,
            RoleSeeder::class
        ]);

        // Admin::factory()->create();
        // Governorate::factory(5)->create()
        // ->each(function ($value){
        //     Region::factory(5)->create([
        //         'governorate_id' => $value->id,
        //     ]);
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });

        // BuildingType::factory(10)->create();
        // Slider::factory(5)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        // BuildingStatus::factory(10)->create();
        // Faq::factory(20)->create();
        // Policy::factory(20)->create();
        // About::factory(5)->create();
        // Blog::factory(5)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        // User::factory(5)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        // Company::factory(5)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        // Agency::factory(5)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        // Ad::factory(30)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        Setting::factory(1)->create();


        // Client::factory(5)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        // WhyChooseUs::factory(4)->create()
        // ->each(function ($value) {
        //     $image = $this->createImage();
        //     $value->images()->create([
        //         'name' => $image['name'],
        //         'url'  =>  $image['url'],
        //         'group_name' => $image['group_name'],
        //     ]);
        // });
        // Contact::factory(40)->create();
        // Info::factory(1)->create();
        // Comment::factory(300)->create();
//   ContactUser::factory(50)->create();
//         UserMessage::factory(20)->create();
//         School::factory(15)->create()
//         ->each(function ($value) {
//             $image = $this->createImage();
//             $value->images()->create([
//                 'name' => $image['name'],
//                 'url'  =>  $image['url'],
//                 'group_name' => $image['group_name'],
//             ]);
//         });

    }

    public function createImage($width = 1920, $height = 1080)
    {
        // CREATE FAKER INSTANCE
        $faker = \Faker\Factory::create();
        // CREATE FAKER INSTANCE
        $filePath = public_path('uploads');
        // IMAGE TO CREATE AND SIZES & IMAGE NAME
        $imageName = $faker->image($filePath, $width, $height, null, false);
        return [
            'url'   => 'uploads/' . $imageName,
            'name'  => $imageName,
            'group_name'  => 'default',
        ];
    }
}
