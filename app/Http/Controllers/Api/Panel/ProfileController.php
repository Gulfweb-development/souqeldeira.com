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
            'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
            'adv_normal_count' => $user->adv_nurmal_count ,
            'adv_star_count' => $user->adv_star_count ,
            'description' => $user->translate('description') ,
            'governorates' => optional($user->governorates)->transform(function ($item){
                return [
                    'governorateId' => $item['id'],
                    'governorateName' => $item[toLocale('name')],
                ];
            }) ,
            'dashboard' => [
                'total_ads' => $user->ads()->count(),
                'total_reviews' => $user->comments()->count(),
            ],
        ]);
    }

    public function editProfile(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'nullable|email|unique:users,email,'.user()->id,
            'phone' => 'required|unique:users,phone,'.user()->id.'|regex:' . phoneNumberFormat(),
            'description' => 'required|string',
            'field' => 'required|in:ALL,RENT,SALE,EXCHANGE',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        user()->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'description_ar' => $request->description,
            'description_en' => $request->description,
            'field' => $request->field,
        ]);
        user()->governorates()->sync(collect($request->governorate_ids)->values());
        if ($request->image != '') {
            user()->deleteFile();
            user()->uploadFile($request->image);
        }
        return $this->success([$this->profile($request)->getOriginalContent()['data']] , __('app.data_updated'));
    }

}
