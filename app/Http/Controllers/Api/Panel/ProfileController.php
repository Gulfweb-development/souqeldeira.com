<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updatePassword(Request $request){
        $request->validate([
            'oldPassword' => 'required|string|max:100',
            'newPassword' => 'required|string|max:100',
        ]);
        if (Hash::check($request->get('oldPassword'),user()->password)) {
            user()->update([
                'password' => $request->get('newPassword'),
            ]);
            return $this->success([] , __('app.data_updated') );
        }else{
            return $this->error(400 , __('app.old_password_invalid') );
        }
    }

    public function profile(Request $request){
        $user = $request->user();
        return $this->success([
            'id' => $user->id ,
            'name' => $user->name ,
            'email' => $user->email ,
            'phone' => $user->phone ,
            'is_approved' => $user->is_approved ,
            'is_featured' => $user->is_featured ,
            'type' => $user->type ,
            'field' => $user->field ,
            'adv_normal_count' => $user->adv_nurmal_count ,
            'adv_star_count' => $user->adv_star_count ,
            'description' => $user->translate('description') ,
            'governorates' => optional($user->governorates)->transform(function ($item){
                return [
                    'governorateId' => $item['id'],
                    'governorateName' => $value[toLocale('name')],
                ];
            }) ,
        ]);
    }

}
