<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Order;
use App\Models\SubscriptionHistories;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Subscription extends Component
{

    public $countNormalAds;
    public $countFeaturedAds;
    public $error_message = "";
    public $success_message = "";
    public $user = null;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function package($id)
    {
        $this->error_message = "";
        $this->success_message = "";
        /** @var User $user */
        $user = $this->user ;
        $package = SubscriptionHistories::activePackage($this->user);
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

        $id = Order::query()->insertGetId([
            'user_id' => $this->user->id,
            'description_en' => trans('buy_package' , ['name' => $package->name_en , 'normal' => $package->adv_nurmal_count, 'featured' => $package->adv_star_count , 'expire' => $package->expire_time ] , 'en') . trans('buy_admin' , [] , 'en'),
            'description_ar' => trans('buy_package' , ['name' => $package->name_ar , 'normal' => $package->adv_nurmal_count, 'featured' => $package->adv_star_count , 'expire' => $package->expire_time ] , 'ar') . trans('buy_admin' , [] , 'ar'),
            'transaction_id' => 'Admin-'.auth('admin')->id(),
            'price' => 0,
            'status' => "success",
            'on_success' => null,
        ]);

        SubscriptionHistories::query()->insertGetId([
            'user_id' => $user->id,
            'subscription_id' => $package->id,
            'order_id' => $id,
            'is_payed' => true,
            'adv_count' => $package->adv_nurmal_count,
            'featured_count' => $package->adv_star_count,
            'adv_use' => 0,
            'featured_use' => 0,
            'expired_at' => Carbon::now()->addDays( $package->expire_time ?? 30),
        ]);


    }

    public function deletePackage()
    {
        $this->error_message = "";
        $this->success_message = "";
        $user = $this->user ;
        $package = \App\Models\SubscriptionHistories::activePackage($user);
        $package->update(['expired_at' => Carbon::now()->subSecond()]);
        $this->success_message = trans('app.data_deleted');
    }
    public function deletePayAsGo($type)
    {
        $this->error_message = "";
        $this->success_message = "";
        $user = $this->user ;
        $fieldDB = ($type == 'normal') ? 'adv_nurmal_count' : 'adv_star_count';
        $user->{$fieldDB} = 0 ;
        $user->save();
        $this->success_message = trans('app.data_deleted');
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

        $package = SubscriptionHistories::activePackage($this->user);
        if ( $package and (
            $package->featured_count - $package->featured_use > 0 or
            $package->adv_count - $package->adv_use > 0)
        ){
            $this->error_message = __('finish_package_first');
            return ;
        }


        $user = $this->user;
        $fieldDB = ($type == 'normal') ? 'adv_nurmal_count' : 'adv_star_count';
        $user->update([
            $fieldDB => $user->{$fieldDB} + $this->{$field}
        ]);

        Order::query()->create([
            'user_id' => $this->user->id,
            'description_en' => trans('buy_pay_as_go' , ['type' => trans($type) , 'count' => $this->{$field} ] , 'en') . trans('buy_admin' , [] , 'en'),
            'description_ar' => trans('buy_pay_as_go' , ['type' => trans($type) , 'count' => $this->{$field} ] , 'ar') . trans('buy_admin' , [] , 'ar'),
            'transaction_id' => 'Admin-'.auth('admin')->id(),
            'price' => 0,
            'status' => "success",
            'on_success' => null,
        ]);

        $this->countNormalAds = "";
        $this->countFeaturedAds = "";
        $this->error_message = "";
        return redirect()->back();
    }


    public function render()
    {
        $lists = Subscriptions::where('status',1)->get();
        return view('livewire.admin.user.subscription', [
            'lists' => $lists,
        ])->layout(ADMIN_LAYOUT);
    }

}
