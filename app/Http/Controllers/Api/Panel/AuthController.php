<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'phoneNumber', 'password');

        if (filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) and $credentials['email']) {
            $field = 'email';
            $value = $credentials['email'];
        } else {
            $field = 'phone';
            $value = $credentials['phoneNumber'];
        }

        if (Auth::attempt([$field => $value, 'password' => $credentials['password']])) {
            $user = Auth::user();
            $token = $user->createToken('application')->accessToken;
            return $this->success([
                'id' => $user->id ,
                'name' => $user->name ,
                'email' => $user->email ,
                'phone' => $user->phone ,
                'is_approved' => $user->is_approved ,
                'is_featured' => $user->is_featured ,
                'type' => $user->type ,
                'adv_normal_count' => $user->adv_nurmal_count ,
                'adv_star_count' => $user->adv_star_count ,
                'description_ar' => $user->description_ar ,
                'description_en' => $user->description_en ,
                'token' => $token->token
            ]);
        } else {
            return $this->error(401 , 'Unauthorized');
        }
    }
}
