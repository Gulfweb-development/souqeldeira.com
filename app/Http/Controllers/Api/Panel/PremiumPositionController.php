<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Position;
use App\Models\Setting;
use App\Models\User;
use App\Payment\BookeeyService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PremiumPositionController extends Controller
{
    public function list(Request $request){
        $allPositions = collect(Setting::get('special_position'));
        $positions = $allPositions->except(Position::getActivePositionForBuy())->transform(fn($item , $key) => [
            'id'=> $key,
            'expire_day'=> $item['expire'],
            'price'=> $item['price'],
            'title'=> trans('position') . ' ' . ($key +  1) ,
        ]);
        $myPositions = Position::getMyActivePosition()->transform(fn($item) => [
            'id'=> $item->id,
            'position'=> $item->position,
            'type'=> $item->image ? 'image' : 'text',
            'image'=> $item->image ? asset($item->image) : null,
            'title'=> $item->title ,
            'expired_at'=> $item->expired_at->diffForHumans() ,
        ]);
        return $this->success([
            'active_positions' => $positions,
            'my_reservation' => $myPositions
        ] );
    }
    public function buy(Request $request){
        $request->validate([
            'type' => 'required|in:image,text',
            'id' => 'required',
            'redirect_to' => 'required',
        ]);
        $allPositions = collect(Setting::get('special_position'));
        $positions = $allPositions->except(Position::getActivePositionForBuy());
        if ( ! $positions->has($request->id) )
            abort(404);
        $positionObject = $positions->get($request->id);
        if ($request->type == "image") {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);
            $request->merge(['text' => null , 'title' => null]);
        } else {
            $request->validate([
                'title' => 'required|string|max:75',
                'text' => 'required|string|max:255',
            ]);
            $request->merge(['image' => null]);
        }

        $url = null;
        if ($request->image != NULL) {
            $dateTime = date('Ymd_His');
            $fileName = $dateTime . '_' . Str::random(20) . '_' . $request->image->getClientOriginalName();
            $request->file('image')->storePubliclyAs(
                'uploads', $fileName,'uploads'
            );
            $url = 'uploads/' . $fileName;
        }
        $position = Position::query()->create([
            'user_id' => auth()->id(),
            'is_payed' => false,
            'position' => $request->id,
            'title' => $request->title,
            'description' => $request->text,
            'image' => $url,
            'link' => null,
            'expired_at' => Carbon::now()->addDays($positionObject['expire']),
        ]);


        $json['class'] = Position::class;
        $json['method'] = 'buyPackage';
        $json['params'] = ['position_id' => $position->id , 'user_id' => auth()->id() ];

        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'description_en' => trans('buy_premium_position' , ['position' => ( $request->id + 1 ) , 'expire' => $positionObject['expire'] ] , 'en'),
            'description_ar' => trans('buy_premium_position' , ['position' => ( $request->id + 1 ) , 'expire' => $positionObject['expire'] ] ,'ar'),
            'transaction_id' => null,
            'price' =>  $positionObject['price'] ,
            'on_success' => $json,
        ]);

        try {
            $bookeeyPipe = new BookeeyService();
            $bookeeyPipe->setDescription($order->description_en);
            $bookeeyPipe->setOrderId($order->id);  // Set Order ID - This should be unique for each transaction.
            $bookeeyPipe->setAmount($positionObject['price']);  // Set amount in KWD
            $bookeeyPipe->setPayerName(\Auth::user()->name);  // Set Payer Name
            $bookeeyPipe->setPayerPhone(\Auth::user()->phone);  // Set Payer Phone Numner
            $bookeeyPipe->setSuccessUrl(route('bankCallback', ['id' => $order->id, "status" => "success", "is_api" => true , 'redirect_to' => $request->get('redirect_to')]));
            $bookeeyPipe->setFailureUrl(route('bankCallback', ['id' => $order->id, "status" => "error", "is_api" => true , 'redirect_to' => $request->get('redirect_to')]));
            $paymentUrl = $bookeeyPipe->initiatePayment();
        } catch (\Exception $exception) {
            return $this->error(500 , $exception->getMessage());
        }
        return $this->success(['redirect_gateway' => $paymentUrl]);
    }

    public function show(Request $request) {
        $myPositions = Position::getMyActivePosition()
            ->where('id' , $request->id)
            ->transform(fn($item) => [
            'id'=> $item->id,
            'position'=> $item->position,
            'type'=> $item->image ? 'image' : 'text',
            'image'=> $item->image ? asset($item->image) : null,
            'title'=> $item->title ,
            'text'=> $item->description ,
            'expired_at'=> $item->expired_at->diffForHumans() ,
        ])->firstOrFail();
        return $this->success($myPositions);
    }

    public function edit(Request $request){
        $request->validate([
            'type' => 'required|in:image,text',
            'id' => 'required',
        ]);
        $position = Position::query()->where('user_id' , auth()->id() )->findOrFail($request->id);
        if ($request->type == "image") {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);
            $request->merge(['text' => null , 'title' => null]);
        } else {
            $request->validate([
                'title' => 'required|string|max:75',
                'text' => 'required|string|max:255',
            ]);
            $request->merge(['image' => null]);
        }

        $url = null;
        if ($request->image != NULL) {
            $dateTime = date('Ymd_His');
            $fileName = $dateTime . '_' . Str::random(20) . '_' . $request->image->getClientOriginalName();
            $request->file('image')->storePubliclyAs(
                'uploads', $fileName,'uploads'
            );
            $url = 'uploads/' . $fileName;
        }
        $position->update([
            'title' => $request->title,
            'description' => $request->text,
            'image' => $url,
        ]);
        return $this->success([] , __('app.data_updated'));
    }

    public function render(){
        return $this->success(Position::render(false,false)->transform(fn($item) => [
            'type'=> $item->image ? 'image' : 'text',
            'image'=> $item->image ? asset($item->image) : null,
            'title'=> $item->title ,
            'text'=> $item->description ,
        ]));
    }
}
