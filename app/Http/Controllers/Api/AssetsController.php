<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Info;
use App\Models\Policy as PolicyModel;
use App\Models\Setting;
use App\Models\WhyChooseUs;
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
                'email' => $info->email,
                'phone' => $info->phone,
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

    public function footerSetting(Request $request){
        $info = Info::query()->latest()->first();
        $setting = Setting::query()->latest()->first();
        return $this->success([
            'email' => $info->email,
            'phone' => $info->phone,
            'apple' => $setting->apple,
            'android' => $setting->android,
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
    public function policies(Request $request){
        $policies = PolicyModel::all()->transform(fn($item) => [
            'original' => $item->translate('name'),
            'htmlLess' => strip_tags($item->translate('name')),
            ]);
        return $this->success([
            'policies' => $policies
        ]);
    }
    public function faq(Request $request){
        $policies = Faq::all()->transform(fn($item) => [
            'question' => $item->translate('question'),
            'answer' => $item->translate('answer'),
            ]);
        return $this->success([
            'faqs' => $policies
        ]);
    }

    public function blogs(Request $request){
        $blogs = Blog::query()->paginate($request->get('per_page'));
        $blogs = $this->paginationFormat($blogs , function ($blog) {
            return [
                'id' => $blog->id,
                'link' => route('blog',[toSlug($blog->translate('title')),$blog->id]),
                'title' => $blog->translate('title'),
                'image' => $blog->getFile(),
            ];
        });
        return $this->success([
            'blogs' => $blogs
        ]);
    }

    public function blog(Request $request){
        $blog = Blog::query()->findOrFail($request->id);
        $recentBlogs = Blog::query()->latest()->take(3)->get()->transform(fn($item) => [
            'id' => $item->id,
            'link' => route('blog',[toSlug($item->translate('title')),$item->id]),
            'title' => $item->translate('title'),
            'image' => $item->getFile(),
        ]);
        return $this->success([
            'blog' => [
                'id' => $blog->id,
                'link' => route('blog',[toSlug($blog->translate('title')),$blog->id]),
                'title' => $blog->translate('title'),
                'text' =>  [
                    'original' => $blog->translate('text'),
                    'htmlLess' => strip_tags($blog->translate('text')),
                ],
                'image' => $blog->getFile(),
            ],
            'recentBlogs' => $recentBlogs
        ]);
    }

    public function aboutUs(Request $request){
        $about = About::query()->latest()->first();
        $whyChooseUs = WhyChooseUs::all()->transform(fn($item) => [
            'title' => $item->translate('name'),
            'image' => $item->getFile(),
            'text' =>  [
                'original' =>  $item->translate('text'),
                'htmlLess' => strip_tags($item->translate('text')),
            ]
        ]);
        return $this->success([
            'aboutUs' => [
                'original' =>  $about->translate('text'),
                'htmlLess' => strip_tags($about->translate('text')),
            ],
            'whyChooseUs' => $whyChooseUs
        ]);
    }
}
