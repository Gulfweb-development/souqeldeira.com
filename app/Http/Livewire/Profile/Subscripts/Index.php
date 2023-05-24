<?php

namespace App\Http\Livewire\Profile\Subscripts;

use App\Models\Order;
use App\Models\SubscriptionHistories;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Index extends Component
{

    public $countNormalAds;
    public $countFeaturedAds;
    public $error_message = "";
    public $success_message = "";

    public function package($id)
    {
        $this->error_message = "";
        $this->success_message = "";
        /** @var User $user */
        $user = auth()->user() ;
        $package = SubscriptionHistories::activePackage(auth()->user());
        if ( $package and (
                $package->featured_count - $package->featured_use > 0 or
                $package->adv_count - $package->adv_use > 0)
        ){
            $this->error_message = __('finish_package_first');
            return ;
        }
        if (  $user->adv_nurmal_count > 0 or  $user->adv_star_count > 0) {
            $this->error_message = __('finish_payasgo_first');
            return ;
        }
        $package = Subscriptions::query()->where('status',1)->where('id' , $id )->first();
        if (  $package == null ) {
            $this->error_message = __('can_not_find_package');
            return ;
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
            'transaction_id' => auth()->id(),
            'price' => $price,
            'on_success' => $json,
        ]);
        return redirect()->route('goSampleBank' , ['id' => $order->id] );
    }
    public function payAsGo($type)
    {
        $this->error_message = "";
        $this->success_message = "";
        $field = 'countFeaturedAds';
        if( $type == 'normal' )
            $field = 'countNormalAds';
        $this->validate([
            $field => 'required|numeric|min:1',
        ]);

        $package = SubscriptionHistories::activePackage(auth()->user());
        if ( $package and (
            $package->featured_count - $package->featured_use > 0 or
            $package->adv_count - $package->adv_use > 0)
        ){
            $this->error_message = __('finish_package_first');
            return ;
        }
        $json['class'] = User::class;
        $json['method'] = 'updatePayAsYouGo';
        $json['params'] = ['count' => $this->{$field} , 'type' => ($type == 'normal' ? 'adv_nurmal_count' : 'adv_star_count') , 'user_id' => auth()->id() ];
        $price = $this->{$field} * \App\Models\Setting::get('price_premium_adv', 15);
        if( $type == 'normal' )
            $price = $this->{$field} * \App\Models\Setting::get('price_adv', 15);

        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'description_en' => trans('buy_pay_as_go' , ['type' => trans($type) , 'count' => $this->{$field} ] , 'en'),
            'description_ar' => trans('buy_pay_as_go' , ['type' => trans($type) , 'count' => $this->{$field} ] , 'ar'),
            'transaction_id' => auth()->id(),
            'price' => $price,
            'on_success' => $json,
        ]);
//        $history = \DB::table('subscription_history')->insertGetId([
//            'user_id' => \Auth::user()->id,
//            'subscription_id' => $subscript->id,
//            'order_id' => 0,
//        ]);
//        $payment = new \App\Payment\Payment();
//        $payment = $payment->setCustomer([
//            'name' => \Auth::user()->name,
//            'code' => '+965',
//            'mobile' => str_replace('+965','',\Auth::user()->phone),
//            'email' => \Auth::user()->email,
//        ])->setAddress([
//            'block' => 'defult',
//            'street' => 'defult',
//            'building' => 'defult',
//            'address' => 'Egypt,mansoura',
//            'instructions' => 'defult',
//        ])->setItems([
//            [
//                "ItemName"   => $subscript->name_ar,
//                "Quantity"   => 1,
//                "UnitPrice"  => $subscript->price,
//            ]
//        ])->setTotal($subscript->price)
//            ->setCallBackUrl("https://test.aldeiramarket.com/payment-redirect/success")
//            ->setErrorUrl("https://test.aldeiramarket.com/payment-redirect/error");
//        $payment = $payment->getInvoiceURL($history);
//        // dd($payment);
//        \DB::table('subscription_history')->where([
//            'id' => $history,
//        ])->update([
//            'order_id' => $payment['invoiceId']
//        ]);
//        // return redirect()->url($payment['invoiceURL']);
//        header('Location: ' . $payment['invoiceURL']);
//


        $this->countNormalAds = "";
        $this->countFeaturedAds = "";
        $this->error_message = "";
        return redirect()->route('goSampleBank' , ['id' => $order->id] );
    }


    public function render()
    {
        $lists = Subscriptions::where('status',1)->get();
        return view('livewire.profile.subscriptions.index', [
            'lists' => $lists,
        ])->layout(PROFILE_LAYOUT);
    }

}
