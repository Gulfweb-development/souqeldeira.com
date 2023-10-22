<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Forget;
use App\Models\BuildingType;
use App\Models\Governorate;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdvertiseController extends Controller
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

}
