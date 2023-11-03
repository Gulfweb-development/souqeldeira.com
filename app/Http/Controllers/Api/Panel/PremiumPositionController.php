<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'image'=> asset($item->image) ,
            'title'=> $item->title ,
            'expired_at'=> $item->expired_at->diffForHumans() ,
        ]);
        return $this->success([
            'active_positions' => $positions,
            'my_reservation' => $myPositions
        ] );
    }
}
