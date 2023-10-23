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

}
