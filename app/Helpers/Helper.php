<?php

use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use App\Models\Ad;

// ADMIN DASHBOARD LAYOUT
define('ADMIN_LAYOUT', 'layouts.app-admin');
// USER PROFILE LAYOUT
define('PROFILE_LAYOUT', 'layouts.app-profile');
// DEFAULT ADMIN PAGINATION
define('APG', 10);
// DEFAULT FRONTEND PAGINATION
define('PG', 12);

if (!function_exists('adnotify')) {
    function adnotify(){
        if(!empty(Auth::guard('web')->user()->id)){
            $date = Carbon::now()->addDays(3);
            return  Ad::with('images', 'governorate', 'region')->select('id','title', 'region_id', 'governorate_id', 'views', 'created_at','is_approved')->whereDate('archived_at',$date)->where('user_id', Auth::guard('web')->user()->id)->get();
        }else{
            return [];
        }
    }
}


// ADMIN AUTH USER DATA
if (!function_exists('user')) {
    function user()
    {
        return Auth::guard('web')->user();
    }
}
// AUTH AND APPROVED USER
if (!function_exists('authApprovedUser')) {
    function authApprovedUser()
    {
        return Auth::guard('web')->check() && Auth::guard('web')->user()->is_approved == 1;
    }
}
// CHECK PERMATION IN PHP FILES
function permation($permationName)
{
    if (Auth::guard('admin')->user()->cannot($permationName)) {
        return abort(403, 'غير مسموح بالدخول');
    }
    return true;
}

// CHECK PERMATION IN BLADE FILES
function permationTo($permationName)
{
    if (Auth::guard('admin')->user()->cannot($permationName)) {
        return false;
    }
    return true;
}
// AUTH AND APPROVED USER
if (!function_exists('authApprovedUserCompany')) {
    function authApprovedUserCompany()
    {
        return Auth::guard('web')->check() && Auth::guard('web')->user()->type == 'COMPANY' && Auth::guard('web')->user()->is_approved == 1;
    }
}
// ADMIN AUTH USER DATA
if (!function_exists('admin')) {
    function admin()
    {
        return Auth::guard('admin')->user();
    }
}
// FAKER LOCAZATION (AR)
if (!function_exists('far')) {
    function far()
    {
        $fakerAr = \Faker\Factory::create('ar_SA');
        return $fakerAr;
    }
}
// NO DATA ALERT MESSAGES
if (!function_exists('noData')) {
    function noData()
    {
        return '<div class="alert alert-info">
                    <h3 class="text-center">' . __('app.no_data') . '</h3>
                </div>';
    }
}
// TABLE SHOW COUNT OPTIONS
if (!function_exists('showOptions')) {
    function showOptions()
    {
        return '  <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>';
    }
}
if (!function_exists('showApprovedFilter')) {
    function showApprovedFilter()
    {
        return '<option value="">' . __('app.all') . '</option><option value="1">' . __('app.approved') . '</option><option value="0">' . __('app.dis_approved') . '</option>';
    }
}

if (!function_exists('showFeaturedFilter')) {
    function showFeaturedFilter()
    {
        return '<option value="">' . __('app.all') . '</option><option value="1">' . __('app.featured') . '</option><option value="0">' . __('app.not_featured') . '</option>';
    }
}

// TO TOGGLE SET FEATURED BUTTONS ACTION IN TABLES
if (!function_exists('toggleFeaturedActions')) {
    function toggleFeaturedActions($isFeatured, $id)
    {
        if ($isFeatured) {
            return '<span title="' . __('app.featured') . '"
            class="btn btn-sm bg-gradient-success btn-sm"  wire:loading.attr="disabled" wire:click.prevent="toggleFeatured(' . $id . ',0)">
            <i class="fas fa-check-circle"></i>
        </span>';
        } else {
            return '<span title="' . __('app.not_featured') . '"
               class="btn btn-sm bg-gradient-secondary btn-sm"  wire:loading.attr="disabled" wire:click.prevent="toggleFeatured(' . $id . ',1)"><i class="far fa-check-circle"></i></span>';
        }
    }
}
// VALUE OR DB NAME TO TO LOCALE
if (!function_exists('toLocale')) {
    function toLocale($value)
    {
        if ($value !== null) {
            return $value . '_' . app()->getLocale() ?? '';
        }
        return '';
    }
}

// SLUGIFIY THE TEXT
if (!function_exists('toSlug')) {
    function toSlug($string, $separator = '-')
    {
        $string1 = trim($string);
        $string2 = mb_strtolower($string1, 'UTF-8');
        $string3 = Str_replace(' ', '-', $string2);
        $string4 = Str_replace('  ', '-', $string3);
        return $string4;
    }
}

// CHECK KEY EXISTS IN STATE BEFORE UPLOAD IMAGE
if (!function_exists('toExists')) {
    function toExists($key,$stateArray)
    {
        if (array_key_exists($key, $stateArray)) {
            return true;
        }
        return false;
    }
}


if(!function_exists('sendSms')) {
    function sendSms($number,$message)
    {
        // dd($number);
        $number = str_replace('+965','',$number);
        $fields = [
            //"msg"       =>  urlencode($message),
            "msg"       =>  $message,
            "number"    =>  trim($number),
            "key"       =>  "f5c5e4f617fd39e577cb3382194e2e74",
            "dezsmsid"  =>  "60006411",
            "senderid"  =>  "SALAAM"
        ];
        $fields     =   http_build_query($fields);
        // dd("http://www.dezsms.com/dezsmsnewapi.php?".$fields);
        ///return file_get_contents("http://www.dezsms.com/dezsmsnewapi.php?".$fields);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://www.dezsms.com/dezsmsnewapi.php?'.$fields,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  $response;
    }
}


// NUMBER FORMAT VALIDATION
if (!function_exists('phoneNumberFormatKwit')) {
    function phoneNumberFormatKwit()
    {
        return 'regex:/^(\[569]\d{8})$/';
    }
}


// NUMBER FORMAT VALIDATION
if (!function_exists('phoneNumberFormat')) {
    function phoneNumberFormat()
    {
        return '/^([0-9]){8}$/';
    }
}
// DEFAULT IMAGE FOR ADS
if (!function_exists('toAdDefaultImage')) {
    function toAdDefaultImage($imageFile)
    {
        return $imageFile != null ? $imageFile : asset('images/ad_default.jpg') . '?v1';
    }
}
// DEFAULT IMAGE FOR PROFILES AND AGENCIES PAGE
if (!function_exists('toProfileDefaultImage')) {
    function toProfileDefaultImage($imageFile , $image = 'images/profile_default.jpg')
    {
        return $imageFile != null ? $imageFile : asset($image);
    }
}

// CHECK APP LOCALE TO CAN ADD CLASSES TO HTML
if (!function_exists('chkLocale')) {
    function chkLocale($rtlClass, $ltrClass)
    {
        return App::isLocale('ar') ? $rtlClass : $ltrClass;
    }
}

// check text is arabic
if (!function_exists('isArabic')) {
    function isArabic($str)
    {
        if (mb_detect_encoding($str) !== 'UTF-8') {
            $str = mb_convert_encoding($str, mb_detect_encoding($str), 'UTF-8');
        }
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $str);
        $str = str_replace($arabic, $num, $convertedPersianNums);
        $str = preg_replace('/[0-9]+/', '', $str);
        preg_match_all('/.|\n/u', $str, $matches);
        $chars = $matches[0];
        $arabic_count = 0;
        $latin_count = 0;
        $total_count = 0;
        foreach ($chars as $char) {
            //$pos = ord($char); we cant use that, its not binary safe
            // i just copied this function fron the php.net comments, but it should work fine!
            $k = mb_convert_encoding($char, 'UCS-2LE', 'UTF-8');
            $k1 = ord(substr($k, 0, 1));
            $k2 = ord(substr($k, 1, 1));
            $pos = $k2 * 256 + $k1;
            if ($pos >= 1536 && $pos <= 1791) {
                $arabic_count++;
            } else if ($pos > 123 && $pos < 123) {
                $latin_count++;
            }
            $total_count++;
        }
        if ($total_count > 0 and ($arabic_count / $total_count) > 0.5) {
            return true;
        }
        return false;
    }
}
