<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permations')->insert([
            [
                'name' => 'admin_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 1,
            ],
            [
                'name' => 'admin_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 1,
            ],
            [
                'name' => 'admin_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 1,
            ],
            [
                'name' => 'admin_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 1,
            ],
            [
                'name' => 'role_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 2,
            ],
            [
                'name' => 'role_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 2,
            ],
            [
                'name' => 'role_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 2,
            ],
            [
                'name' => 'role_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 2,
            ],
             [
                'name' => 'setting_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 3,
            ],
            // [
            //     'name' => 'setting_create',
            //     'label_ar' => 'انشاء',
            //     'label_en' => 'Create',
            //     'permation_for_id' => 3,
            // ],
            [
                'name' => 'setting_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 3,
            ],
            // [
            //     'name' => 'setting_delete',
            //     'label_ar' => 'حذف',
            //     'label_en' => 'Delete',
            //     'permation_for_id' => 3,
            // ],
            // ////
            [
                'name' => 'governorate_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 4,
            ],
            [
                'name' => 'governorate_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 4,
            ],
            [
                'name' => 'governorate_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 4,
            ],
            [
                'name' => 'governorate_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 4,
            ],
            [
                'name' => 'region_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 5,
            ],
            [
                'name' => 'region_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 5,
            ],
            [
                'name' => 'region_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 5,
            ],
            [
                'name' => 'region_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 5,
            ],
            [
                'name' => 'building_type_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 6,
            ],
            [
                'name' => 'building_type_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 6,
            ],
            [
                'name' => 'building_type_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 6,
            ],
            [
                'name' => 'building_type_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 6,
            ], [
                'name' => 'client_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 7,
            ],
            [
                'name' => 'client_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 7,
            ],
            [
                'name' => 'client_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 7,
            ],
            [
                'name' => 'client_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 7,
            ], [
                'name' => 'faq_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 8,
            ],
            [
                'name' => 'faq_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 8,
            ],
            [
                'name' => 'faq_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 8,
            ],
            [
                'name' => 'faq_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 8,
            ], [
                'name' => 'policy_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 9,
            ],
            [
                'name' => 'policy_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 9,
            ],
            [
                'name' => 'policy_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 9,
            ],
            [
                'name' => 'policy_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 9,
            ],

            [
                'name' => 'about_text_view',
                'label_ar' => 'عرض النص',
                'label_en' => 'View Text',
                'permation_for_id' => 10,
            ],
            [
                'name' => 'about_text_create',
                'label_ar' => 'انشاء النص',
                'label_en' => 'Create Text',
                'permation_for_id' => 10,
            ],
            [
                'name' => 'about_text_edit',
                'label_ar' => 'تعديل النص',
                'label_en' => 'Edit Text',
                'permation_for_id' => 10,
            ],
            [
                'name' => 'about_text_delete',
                'label_ar' => 'حذف النص',
                'label_en' => 'Delete Text',
                'permation_for_id' => 10,
            ],

            [
                'name' => 'about_why_choose_view',
                'label_ar' => 'عرض لماذا نحن',
                'label_en' => 'View Why',
                'permation_for_id' => 10,
            ],
            [
                'name' => 'about_why_choose_create',
                'label_ar' => 'انشاء لماذا نحن',
                'label_en' => 'Create Why',
                'permation_for_id' => 10,
            ],
            [
                'name' => 'about_why_choose_edit',
                'label_ar' => 'تعديل لماذا نحن',
                'label_en' => 'Edit Why',
                'permation_for_id' => 10,
            ],
            [
                'name' => 'about_why_choose_delete',
                'label_ar' => 'حذف لماذا نحن ',
                'label_en' => 'Delete Why',
                'permation_for_id' => 10,
            ],

            [
                'name' => 'contact_message_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 11,
            ],
            [
                'name' => 'contact_message_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 11,
            ],

            [
                'name' => 'contact_info_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 11,
            ],
            [
                'name' => 'contact_info_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 11,
            ],


            [
                'name' => 'blog_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 12,
            ],
            [
                'name' => 'blog_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 12,
            ],
            [
                'name' => 'blog_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 12,
            ],
            [
                'name' => 'blog_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 12,
            ],

            [
                'name' => 'user_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 13,
            ],
            [
                'name' => 'user_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 13,
            ],
            [
                'name' => 'user_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 13,
            ],

            [
                'name' => 'agency_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 14,
            ],
            [
                'name' => 'agency_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 14,
            ],
            [
                'name' => 'agency_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 14,
            ],
            [
                'name' => 'agency_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 14,
            ],

            [
                'name' => 'ad_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 15,
            ],
            [
                'name' => 'ad_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 15,
            ],
            [
                'name' => 'ad_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 15,
            ],

            [
                'name' => 'school_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 16,
            ],
            [
                'name' => 'school_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 16,
            ],
            [
                'name' => 'school_edit',
                'label_ar' => 'تعديل',
                'label_en' => 'Edit',
                'permation_for_id' => 16,
            ],
            [
                'name' => 'school_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 16,
            ],

            [
                'name' => 'comment_view',
                'label_ar' => 'عرض',
                'label_en' => 'View',
                'permation_for_id' => 17,
            ],
            [
                'name' => 'comment_delete',
                'label_ar' => 'حذف',
                'label_en' => 'Delete',
                'permation_for_id' => 17,
            ],

            [
                'name' => 'notification_create',
                'label_ar' => 'انشاء',
                'label_en' => 'Create',
                'permation_for_id' => 18,
            ],

        ]);
    }
}
