<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendLangController extends Controller
{
    public static $setting = null ;
    private static $defaultKeywords = [
        'ar' => [
            'عقارات',
            'شقق',
            'ايجا',
            'البيع',
            'فلل',
            'للبيد',
            'الكويت',
            'الايجار شقق في الكويت',
            'بيوت للبيع في الكويت',
        ],
        'en' => [
            'عقارات',
            'شقق',
            'ايجا',
            'البيع',
            'فلل',
            'للبيد',
            'الكويت',
            'الايجار شقق في الكويت',
            'بيوت للبيع في الكويت',
        ],
    ];

    private static function array_random($array, $amount = 1)
    {
        $keys = array_rand($array, $amount);

        if ($amount == 1) {
            return $array[$keys];
        }

        $results = [];
        foreach ($keys as $key) {
            $results[] = $array[$key];
        }

        return $results;
    }
    public static function keyWords($all =false){
        if ( $all )
            return implode(',' , self::$defaultKeywords[ app()->getLocale()] );
        return implode(',' ,self::array_random(self::$defaultKeywords[ app()->getLocale()] , 7 ) );
    }
    public static function setting()
    {
        if ( self::$setting == null )
            self::$setting = Setting::latest()->first();
        return self::$setting;
    }
    public function lang($lang)
    {
        Session()->put('front-locale', $lang);
        return redirect()->back();
    }
}
