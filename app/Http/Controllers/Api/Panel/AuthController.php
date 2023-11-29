<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Mail\Forget;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            $token = $user->createToken('application');
            return $this->success([
                'id' => $user->id ,
                'name' => $user->name ,
                'email' => $user->email ,
                'phone' => $user->phone ,
                'is_approved' => $user->is_approved ,
                'is_featured' => $user->is_featured ,
                'type' => $user->type ,
                'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
                'field' => $user->field ,
                'adv_normal_count' => $user->adv_nurmal_count ,
                'adv_star_count' => $user->adv_star_count ,
                'description' => $user->translate('description') ,
                'dashboard' => [
                    'total_ads' => $user->ads()->count(),
                    'total_reviews' => $user->comments()->count(),
                ],
                'token' => $token->plainTextToken
            ]);
        } else {
            return $this->error(401 ,  trans('Unauthorized') );
        }
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->success([] ,  __('Logout'));
    }

    public function register(Request $request){
        $request->validate( [
            'type' => ['required', 'string', 'in:USER,COMPANY'],
            'name' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:50', 'unique:users'],
            'phone' => ['nullable', 'string','unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
        ]);
        if ( ! filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) and ! $request->get('phone' , false)  )
            return $this->error(400 , trans('Email address or phone number is required!'));

        $request->merge(['phone' => str_replace("+965",'', $request->get('phone' ))]);

        $activated_code = rand(1000,9999);
        $user = User::create([
            'type' => $request->type == 'COMPANY' ? 'COMPANY' : 'USER',
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'password' => $request->password,
            'activated_code' => $activated_code,
            'email_verified_at' => \Carbon\Carbon::now(),
            'adv_nurmal_count' => Setting::get('gift_normal', 0),
            'adv_star_count' => Setting::get('gift_premium', 0),
        ]);
        $user = User::query()->find($user->id);
        if (request()->has('image')) {
            $user->uploadFile($request->image);
        }
        if(!is_null($user->phone)) {
            sendSms($user->phone,__("Hello\nYour OTP is :CODE\nSouqeldeira.com",['CODE'=>$activated_code]));
            $message = __('app.registered_succefully_please_check_your_phone_to_active_account');
        } else {
            $message = __('app.registered_succefully_please_check_your_mail_to_active_account');
        }
        $token = $user->createToken('application');
        return $this->success([
            'id' => $user->id ,
            'name' => $user->name ,
            'email' => $user->email ,
            'phone' => $user->phone ,
            'is_approved' => $user->is_approved ,
            'is_featured' => $user->is_featured ,
            'type' => $user->type ,
            'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
            'field' => $user->field ,
            'adv_normal_count' => $user->adv_nurmal_count ,
            'adv_star_count' => $user->adv_star_count ,
            'description' => $user->translate('description') ,
            'dashboard' => [
                'total_ads' => $user->ads()->count(),
                'total_reviews' => $user->comments()->count(),
            ],
            'token' => $token->plainTextToken
        ] , $message);
    }

    public function forgetPassword(Request $request){
        $request->validate( [
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'phone' => ['nullable', 'string'],
        ]);
        if ( ! filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) and ! $request->get('phone' , false)  )
            return $this->error(400 , trans('Email address or phone number is required!'));

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL) and $request->email) {
            $field = 'email';
            $value = $request->email;
        } else {
            $field = 'phone';
            $value = $request->phone;
        }

        $user = User::query()->where($field , $value)->first();
        if ( $user == null )
            return $this->error(400 ,trans('could not be found.'));

        $activated_code = rand(1000,9999);
        $user->update([
            'activated_code' => $activated_code
        ]);
        if(!is_null($user->phone)) {
            sendSms($user->phone,__("Hello\nYour OTP is :CODE\nSouqeldeira.com",['CODE'=>$activated_code]));
        }
        Mail::to($user->email)->send(new Forget($user));
        return $this->success(null ,__('Your activated code send to email and phone'));
    }

    public function resetPassword(Request $request){
        $request->validate( [
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'phone' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code' => ['required'],
        ]);
        if ( ! filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) and ! $request->get('phone' , false)  )
            return $this->error(400 , trans('Email address or phone number is required!'));

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL) and $request->email) {
            $field = 'email';
            $value = $request->email;
        } else {
            $field = 'phone';
            $value = $request->phone;
        }

        $user = User::query()->where($field , $value)->first();
        if ( $user == null )
            return $this->error(400 ,trans('could not be found.'));
        if ( $user->activated_code != $request->code )
            return $this->error(400 ,trans('OTP Code is incorrect.'));

        $user->update([
            'password' => $request->password
        ]);
        $token = $user->createToken('application');
        return $this->success([
            'id' => $user->id ,
            'name' => $user->name ,
            'email' => $user->email ,
            'phone' => $user->phone ,
            'is_approved' => $user->is_approved ,
            'is_featured' => $user->is_featured ,
            'type' => $user->type ,
            'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
            'field' => $user->field ,
            'adv_normal_count' => $user->adv_nurmal_count ,
            'adv_star_count' => $user->adv_star_count ,
            'description' => $user->translate('description') ,
            'dashboard' => [
                'total_ads' => $user->ads()->count(),
                'total_reviews' => $user->comments()->count(),
            ],
            'token' => $token->plainTextToken
        ]);
    }
}
