<?php

namespace App\Http\Livewire\Profile\Subscripts;

use App\Models\Order;
use App\Models\SubscriptionHistories;
use App\Models\Subscriptions;
use App\Models\User;
use App\Payment\BookeeyService;
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
            $this->dispatchBrowserEvent('info', ['message' => $exception->getMessage()]);
            session()->flash('info',  $exception->getMessage());
            return null;
        }
//        $order->update(['transaction_id' =>  $payment['invoiceId'] ]);
        return redirect()->to($paymentUrl);
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


        $unitPrice = \App\Models\Setting::get('price_premium_adv', 15);
        if( $type == 'normal' )
            $unitPrice = \App\Models\Setting::get('price_adv', 15);
         $price = $this->{$field} * $unitPrice;

        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'description_en' => trans('buy_pay_as_go' , ['type' => trans($type,[] ,'en') , 'count' => $this->{$field} ] , 'en'),
            'description_ar' => trans('buy_pay_as_go' , ['type' => trans($type,[] ,'ar') , 'count' => $this->{$field} ] , 'ar'),
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
            $bookeeyPipe->setSuccessUrl(route('bankCallback', ['id' => $order->id, "status" => "success"]));
            $bookeeyPipe->setFailureUrl(route('bankCallback', ['id' => $order->id, "status" => "error"]));
            $paymentUrl = $bookeeyPipe->initiatePayment();
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('info', ['message' => $exception->getMessage()]);
            session()->flash('info',  $exception->getMessage());
            return null;
        }
//        $order->update(['transaction_id' =>  $payment['invoiceId'] ]);
        return redirect()->to($paymentUrl);
    }


    public function render()
    {
        $lists = Subscriptions::where('status',1)->get();
        return view('livewire.profile.subscriptions.index', [
            'lists' => $lists,
        ])->layout(PROFILE_LAYOUT);
    }

}
