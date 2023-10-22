<?php

namespace App\Http\Controllers\Api\Advertise;

use App\Http\Controllers\Controller;
use App\Models\BuildingType;
use App\Models\Governorate;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function home(Request $request){
        Setting::latest()->first()->increment('visits');
        $this->setting = Setting::select('id',toLocale('title'),toLocale('description'))->latest()->first();
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
            ->paginate(max(min($request->get('per_page' , 20) , 50) , 10));
        $offices->setCollection( $offices->getCollection()->transform(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
                'link' => route('agency.ads',[toSlug($user->name),$user->id]) ,
                'whatsapp' => 'https://api.whatsapp.com/send?phone='.$user->phone
            ];
        }));
        $offices = $offices->toArray();
        unset($offices['first_page_url'],$offices['last_page_url'],$offices['links'],$offices['next_page_url'],$offices['path'],$offices['prev_page_url']);
        return $this->success([ 'offices' => $offices ]);
    }

}
