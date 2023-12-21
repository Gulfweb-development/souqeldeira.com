<?php

namespace App\Http\Controllers\Api\Advertise;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendLangController;
use App\Models\Ad;
use App\Models\BuildingType;
use App\Models\Client;
use App\Models\Governorate;
use App\Models\Report;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function home(Request $request){
        Setting::latest()->first()->increment('visits');
        $this->setting = Setting::select('id',toLocale('title'),toLocale('description'))->latest()->first();
        $rentAds = Ad::with('region', 'images','governorate', 'buildingType')
            ->select('id', 'type', 'is_approved', 'is_featured','region_id', 'price', 'title','phone','governorate_id', 'building_type_id' , 'created_at', 'views')
            ->where('is_approved', 1)
            ->where('type', 'RENT')
            ->orderByDesc('is_featured')
            ->inRandomOrder()
            ->take(6)
            ->get()->transform(function ($item) {
                return AdvertiseController::formatAd($item , true);
            });
        $saleAds = Ad::with('region','images','buildingType','governorate')
            ->select('id','type','is_approved','is_featured','region_id','price','title','building_type_id','phone','governorate_id', 'created_at', 'views')
            ->where('is_approved',1)
            ->where('type','SALE')
            ->orderByDesc('is_featured')
            ->inRandomOrder()
            ->take(6)
            ->get()->transform(function ($item) {
                return AdvertiseController::formatAd($item , true);
            });
        $exchangeAds = Ad::with('region','images','buildingType','governorate')
            ->select('id','type','is_approved','is_featured','region_id','price','title','building_type_id','phone','governorate_id', 'created_at', 'views')
            ->where('is_approved',1)
            ->where('type','EXCHANGE')
            ->orderByDesc('is_featured')
            ->inRandomOrder()
            ->take(6)
            ->get()->transform(function ($item) {
                return AdvertiseController::formatAd($item , true);
            });
        $requestAds = Ad::with('region','images','buildingType','governorate')
            ->select('id','type','is_approved','is_featured','region_id','price','title','building_type_id','phone','governorate_id', 'created_at', 'views')
            ->where('is_approved',1)
            ->where('type','REQUEST')
            ->orderByDesc('is_featured')
            ->inRandomOrder()
            ->take(6)
            ->get()->transform(function ($item) {
                return AdvertiseController::formatAd($item , true);
            });
        $clients = Client::with('images')->get()->transform(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item['name_'.app()->getLocale()],
                'images' => asset(optional(optional($item->images)[0])->url),
            ];
        });

        $homeDetails = [
            'original' => FrontendLangController::setting()['home_details_'.app()->getLocale()],
            'htmlLess' => strip_tags(FrontendLangController::setting()['home_details_'.app()->getLocale()]),
        ];
        return $this->success(compact('homeDetails' , 'clients', 'saleAds' , 'rentAds' , 'exchangeAds' , 'requestAds'));

    }

    public function governorates(Request $request){
        $Governorate = Governorate::query()->select('id', toLocale('name'))->get()->transform(function ($value) {
           return [
               'governorateId' => $value['id'],
               'governorateName' => $value[toLocale('name')],
               'towns' => optional($value->regions)->transform(function ($region){
                   return [
                       'townId'=> $region['id'],
                       'townName'=> $region[toLocale('name')],
                   ];
               }),
           ] ;
        });
        return $this->success(['governorates' => $Governorate]);
    }

    public function saleType(Request $request){
        return $this->success(['sales' =>[
            ['SaleName' => trans('app.sale') , 'saleId' => 'SALE'],
            ['SaleName' => trans('app.rent') , 'saleId' => 'RENT'],
            ['SaleName' => trans('app.exchange') , 'saleId' => 'EXCHANGE'],
            ['SaleName' => trans('app.REQUEST') , 'saleId' => 'REQUEST'],
        ]]);
    }

    public function buildingType(Request $request){
        return $this->success([ 'buildingType' => BuildingType::query()
            ->select('id', toLocale('name'))
            ->get()
            ->transform(function ($value) {
                return [
                    'typeId' => $value['id'],
                    'typeName' => $value[toLocale('name')],
                ];
            })
        ]);
    }

    public function offices(Request $request){
        $offices = User::companies()
            ->paginate($request->get('per_page'));
        $offices = $this->paginationFormat($offices , function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
                'link' => route('agency.ads',[toSlug($user->name),$user->id]) ,
                'whatsapp' => 'https://api.whatsapp.com/send?phone='.$user->phone,
                'socials' => $user->socials ?? [
                        'instagram' => null,
                        'youtube' => null,
                        'telegram' =>  null,
                        'website' => null,
                        'linkedin' =>  null,
                        'facebook' =>  null,
                        'twitter' => null,
                    ]
            ];
        });
        return $this->success([ 'offices' => $offices ]);
    }

    public function office(Request $request){
        $user = User::companies()->findOrFail($request->id);
        return $this->success([ 'office' => [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
            'link' => route('agency.ads',[toSlug($user->name),$user->id]) ,
            'whatsapp' => 'https://api.whatsapp.com/send?phone='.$user->phone,
            'socials' => $user->socials ?? [
                    'instagram' => null,
                    'youtube' => null,
                    'telegram' =>  null,
                    'website' => null,
                    'linkedin' =>  null,
                    'facebook' =>  null,
                    'twitter' => null,
                ]
        ] ]);
    }

    public function officeReport(Request $request){
        Report::insert(User::companies()->findOrFail($request->get('id' , 0)));
        return $this->success([] , __('app.reportSent'));
    }

}
