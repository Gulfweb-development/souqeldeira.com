<?php

namespace App\Http\Livewire\Profile\Subscripts;

use App\Models\Subscriptions;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Index extends Component
{

    public $countNormalAds;
    public $countFeaturedAds;
    public function payAsGo($type)
    {
        $field = 'countFeaturedAds';
        if( $type == 'normal' )
            $field = 'countNormalAds';
        $this->validate([
            $field => 'required|numeric|min:1',
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


        session()->flash('success', __('app.data_updated'));
        return redirect()->back();
    }


    public function render()
    {
        $lists = Subscriptions::where('status',1)->get();
        return view('livewire.profile.subscriptions.index', [
            'lists' => $lists,
        ])->layout(PROFILE_LAYOUT);
    }

}
