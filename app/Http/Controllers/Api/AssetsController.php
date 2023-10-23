<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Info;
use App\Models\Setting;
use Illuminate\Http\Request;

class AssetsController extends Controller
{

    public function contactUs(Request $request){
        $request->validate([
            'first_name' => 'required|string|min:3"max:50',
            'last_name' => 'required|string|min:3"max:50',
            'email' => 'required|email|min:10|max:50',
            'message' => 'required|string|min:20|max:300',
        ]);
        Contact::create($request->only(['first_name' , 'last_name' ,'email' ,'message']));
        return $this->success([] , trans('app.message_sent'));
    }

    public function settings(Request $request){
        $info = Info::query()->latest()->first();
        $setting = Setting::query()->latest()->first();
        return $this->success([
            'contact_us' => [
                'original' => $info->translate('text'),
                'htmlLess' => strip_tags($info->translate('text')),
            ],
            'title' => $setting->translate('title'),
            'description' => $setting->translate('description'),
            'home_details' => [
                'original' => $setting->translate('home_details'),
                'htmlLess' => strip_tags($setting->translate('home_details')),
            ],
            'terms_condition' => [
                'original' => $setting->translate('terms_condition'),
                'htmlLess' => strip_tags($setting->translate('terms_condition')),
            ],
            'social_media' => [
                'facebook' => $setting->facebook,
                'twitter' => $setting->twitter,
                'instagram' => $setting->instagram,
                'youtube' => $setting->youtube,
            ],
            'price' => [
                'normal' => $setting->price_adv,
                'premium' => $setting->price_premium_adv,
            ],
        ]);
    }
    public function terms(Request $request){
        $setting = Setting::query()->latest()->first();
        return $this->success([
            'terms_condition' => [
                'original' => $setting->translate('terms_condition'),
                'htmlLess' => strip_tags($setting->translate('terms_condition')),
            ]
        ]);
    }
}
