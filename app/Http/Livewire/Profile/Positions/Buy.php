<?php

namespace App\Http\Livewire\Profile\Positions;

use App\Models\Order;
use App\Models\Position;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Buy extends Component
{
    use WithFileUploads;
    public $position ;
    public $position_id ;
    public $type ;
    public $title ;
    public $text ;
    public $image ;
    public function mount($id)
    {
        $allPositions = collect(Setting::get('special_position'));
        $positions = $allPositions->except(Position::getActivePositionForBuy());
        if ( ! $positions->has($id) )
            abort(404);
        $this->position = $positions->get($id);
        $this->position_id = $id;
    }

    public function buy()
    {
        if ($this->type == "image") {
            $this->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);
            $this->text = null;
            $this->title = null;
        } else {
            $this->validate([
                'title' => 'required|string|max:75',
                'text' => 'required|string|max:255',
            ]);
            $this->image = null;
        }

        $url = null;
        if ($this->image != NULL) {
            $dateTime = date('Ymd_His');
            $fileName = $dateTime . '_' . Str::random(20) . '_' . $this->image->getClientOriginalName();
            $this->image->storeAs('uploads', $fileName);
            $url = 'uploads/' . $fileName;
        }



        $position = Position::query()->create([
            'user_id' => auth()->id(),
            'is_payed' => false,
            'position' => $this->position_id,
            'title' => $this->title,
            'description' => $this->text,
            'image' => $url,
            'link' => null,
            'expired_at' => Carbon::now()->addDays($this->position['expire']),
        ]);


        $json['class'] = Position::class;
        $json['method'] = 'buyPackage';
        $json['params'] = ['position_id' => $position->id , 'user_id' => auth()->id() ];

        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'description_en' => trans('buy_premium_position' , ['position' => ( $this->position_id + 1 ) , 'expire' => $this->position['expire'] ] , 'en'),
            'description_ar' => trans('buy_premium_position' , ['position' => ( $this->position_id + 1 ) , 'expire' => $this->position['expire'] ] ,'ar'),
            'transaction_id' => null,
            'price' =>  $this->position['price'] ,
            'on_success' => $json,
        ]);

        $payment = new \App\Payment\Payment();
        $payment = $payment->setCustomer([
            'name' => \Auth::user()->name,
            'code' => '+965',
            'mobile' => str_replace('+965','',\Auth::user()->phone),
            'email' => \Auth::user()->email,
        ])->setAddress([
            'block' => 'defult',
            'street' => 'defult',
            'building' => 'defult',
            'address' => 'Egypt,mansoura',
            'instructions' => 'defult',
        ])->setItems([
            [
                "ItemName"   => trans('buy_premium_position' , ['position' => ( $this->position_id + 1 ) , 'expire' => $this->position['expire'] ] , 'en'),
                "Quantity"   => 1,
                "UnitPrice"  => $this->position['price'],
            ]
        ])->setTotal($this->position['price'])
            ->setCallBackUrl(route('bankCallback' , ['id' => $order->id , "status" => "success"] ) )
            ->setErrorUrl(route('bankCallback' , ['id' => $order->id , "status" => "error"] ));
        $payment = $payment->getInvoiceURL($order->id);
        $order->update(['transaction_id' =>  $payment['invoiceId'] ]);
        return redirect()->to($payment['invoiceURL']);
    }

    public function render()
    {
        return view('livewire.profile.positions.buy')->layout(PROFILE_LAYOUT);
    }
}
