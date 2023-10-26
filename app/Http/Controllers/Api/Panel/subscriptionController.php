<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class subscriptionController extends Controller
{
    public function list(Request $request){
        $packages = Subscriptions::query()->where('status',1)->get()->transform(function ($item) {
            return [
                'id' => $item->id,
                'image' =>  toAdDefaultImage($item->getFile()) ,
                'price' => $item->price ,
                'adv_normal_count' => $item->adv_nurmal_count ,
                'adv_premium_count' => $item->adv_star_count ,
                'expire_time' => $item->expire_time ,
            ];
        });
        return $this->success([
            'balance'=> [
                'normal' => \App\Models\SubscriptionHistories::getBalance()['normal'],
                'premium ' => \App\Models\SubscriptionHistories::getBalance()['featured'],
            ],
            'pay_as_go_price'=> [
                'normal' => \App\Models\Setting::get('price_adv', 15),
                'premium ' => \App\Models\Setting::get('price_premium_adv', 15),
            ],
            'packages'=>$packages
        ] );
    }


}
