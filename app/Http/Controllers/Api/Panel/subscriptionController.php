<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SubscriptionHistories;
use App\Models\Subscriptions;
use App\Models\User;
use App\Payment\BookeeyService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function payAsGo(Request  $request){
        $request->validate([
            'count' => 'required|numeric|min:1',
            'type' => 'required|in:normal,premium'
        ]);

        $package = SubscriptionHistories::activePackage(auth()->user());
        if ( $package and (
                $package->featured_count - $package->featured_use > 0 or
                $package->adv_count - $package->adv_use > 0)
        ){
            return $this->error(400 ,  __('finish_package_first'));
        }
        $json['class'] = User::class;
        $json['method'] = 'updatePayAsYouGo';
        $json['params'] = ['count' => $request->get('count') , 'type' => ($request->get('type') == 'normal' ? 'adv_nurmal_count' : 'adv_star_count') , 'user_id' => auth()->id() ];


        $unitPrice = \App\Models\Setting::get('price_premium_adv', 15);
        if( $request->get('type') == 'normal' )
            $unitPrice = \App\Models\Setting::get('price_adv', 15);
        $price = $request->get('count') * $unitPrice;

        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'description_en' => trans('buy_pay_as_go' , ['type' => trans(($request->get('type') == 'normal' ?: 'featured'),[] ,'en') , 'count' => $request->get('count') ] , 'en'),
            'description_ar' => trans('buy_pay_as_go' , ['type' => trans(($request->get('type') == 'normal' ?: 'featured'),[] ,'ar') , 'count' => $request->get('count') ] , 'ar'),
            'transaction_id' => null,
            'price' => $price,
            'on_success' => $json,
        ]);
        try {
            $bookeeyPipe = new BookeeyService();
            $bookeeyPipe->setDescription($order->description_en);
            $bookeeyPipe->setOrderId($order->id);  // Set Order ID - This should be unique for each transaction.
            $bookeeyPipe->setAmount($price);  // Set amount in KWD
            $bookeeyPipe->setPayerName(\Auth::user()->name);  // Set Payer Name
            $bookeeyPipe->setPayerPhone(\Auth::user()->phone);  // Set Payer Phone Numner
            $bookeeyPipe->setSuccessUrl(route('bankCallback', ['id' => $order->id, "status" => "success", "is_api" => true]));
            $bookeeyPipe->setFailureUrl(route('bankCallback', ['id' => $order->id, "status" => "error", "is_api" => true]));
            $paymentUrl = $bookeeyPipe->initiatePayment();
        } catch (\Exception $exception) {
            return $this->error(500 , $exception->getMessage());
        }
        return $this->success(['redirect_gateway' => $paymentUrl]);
    }

    public function package(Request  $request){
        $request->validate([
            'id' => 'required|exists:subscriptions,id'
        ]);

        /** @var User $user */
        $user = auth()->user() ;
        $package = SubscriptionHistories::activePackage(auth()->user());
        if ( $package and (
                $package->featured_count - $package->featured_use > 0 or
                $package->adv_count - $package->adv_use > 0)
        ){
            return $this->error(400 ,  __('finish_package_first'));
        }
        if (  $user->adv_nurmal_count > 0 or  $user->adv_star_count > 0) {
            return $this->error(400 ,  __('finish_payasgo_first'));
        }
        $package = Subscriptions::query()->where('status',1)->where('id' , $request->get('id') )->first();
        if (  $package == null ) {
            return $this->error(400 ,  __('can_not_find_package'));
        }
        $id = SubscriptionHistories::query()->insertGetId([
            'user_id' => $user->id,
            'subscription_id' => $package->id,
            'order_id' => null,
            'is_payed' => false,
            'adv_count' => $package->adv_nurmal_count,
            'featured_count' => $package->adv_star_count,
            'adv_use' => 0,
            'featured_use' => 0,
            'expired_at' => Carbon::now()->addDays( $package->expire_time ?? 30),
        ]);
        $json['class'] = SubscriptionHistories::class;
        $json['method'] = 'buyPackage';
        $json['params'] = ['package_id' => $id ];
        $price = $package->price;

        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'description_en' => trans('buy_package' , ['name' => $package->name_en , 'normal' => $package->adv_nurmal_count, 'featured' => $package->adv_star_count , 'expire' => $package->expire_time ] , 'en'),
            'description_ar' => trans('buy_package' , ['name' => $package->name_ar , 'normal' => $package->adv_nurmal_count, 'featured' => $package->adv_star_count , 'expire' => $package->expire_time ] , 'ar'),
            'price' => $price,
            'on_success' => $json,
        ]);
        try {
            $bookeeyPipe = new BookeeyService();
            $bookeeyPipe->setDescription($order->description_en);
            $bookeeyPipe->setOrderId($order->id);  // Set Order ID - This should be unique for each transaction.
            $bookeeyPipe->setAmount($price);  // Set amount in KWD
            $bookeeyPipe->setPayerName(\Auth::user()->name);  // Set Payer Name
            $bookeeyPipe->setPayerPhone(\Auth::user()->phone);  // Set Payer Phone Numner
            $bookeeyPipe->setSuccessUrl(route('bankCallback', ['id' => $order->id, "status" => "success"]));
            $bookeeyPipe->setFailureUrl(route('bankCallback', ['id' => $order->id, "status" => "error"]));
            $paymentUrl = $bookeeyPipe->initiatePayment();
        } catch (\Exception $exception) {
            return $this->error(500 , $exception->getMessage());
        }
        return $this->success(['redirect_gateway' => $paymentUrl]);
    }

}
