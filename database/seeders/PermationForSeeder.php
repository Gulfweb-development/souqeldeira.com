<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermationForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permation_fors')->insert([
            [
                'name_ar' => 'المدريين',
                'name_en' => 'Admins',
            ],
            [
                'name_ar' => 'الادوار',
                'name_en' => 'Roles',
            ],
            [
                'name_ar' => 'الاعدادات',
                'name_en' => 'Settings',
            ],
            [
                'name_ar' => 'المحافظات',
                'name_en' => 'Governorates',
            ],
            [
                'name_ar' => 'المناطق',
                'name_en' => 'Regions',
            ],
            [
                'name_ar' => 'نوع العقار',
                'name_en' => 'Building Type',
            ],
            [
                'name_ar' => 'العملاء',
                'name_en' => 'Clients',
            ],
            [
                'name_ar' => 'الاسئلة الشائعة',
                'name_en' => 'FAQS',
            ],
            [
                'name_ar' => 'اتفاقية الاستخدام',
                'name_en' => 'Policies',
            ],
            [
                'name_ar' => 'عن الموقع',
                'name_en' => 'About',
            ],
            [
                'name_ar' => 'اتصل بنا',
                'name_en' => 'Contact',
            ],
            [
                'name_ar' => 'المدونة',
                'name_en' => 'Blog',
            ],
            [
                'name_ar' => 'الاعضاء',
                'name_en' => 'Users',
            ],
            [
                'name_ar' => 'الوكالات',
                'name_en' => 'Agencies',
            ],
            [
                'name_ar' => 'الاعلانات',
                'name_en' => 'Ads',
            ],
            [
                'name_ar' => 'المدارس',
                'name_en' => 'Schools',
            ],
            [
                'name_ar' => 'التعليقات',
                'name_en' => 'Comments',
            ],
            [
                'name_ar' => 'الاشعارات',
                'name_en' => 'Notifications',
            ],
        ]);
    }
}
