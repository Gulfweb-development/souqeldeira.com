<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // +965 6672 7428
        $m = [
            'type' => ['required', 'string', 'in:USER,COMPANY'],
            'name' => ['required', 'string', 'max:50'],
            // 'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            // 'phone' => ['required', 'string','unique:users,phone', phoneNumberFormatKwit()],
            'v' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
        ];
        if (!filter_var($data['v'], FILTER_VALIDATE_EMAIL)) {
          $m['phone'] = ['required', 'unique:users,phone'];
        //   $data['phone'] = $data['v'];
          $data['phone'] = str_replace("+965",'',$data['v']);
        } else {
          $m['email'] = ['required', 'string', 'email', 'max:50', 'unique:users'];
          $data['email'] = $data['v'];
        }
        if(isset($data['v'])) {
            unset($data['v']);
        }
        if(isset($m['v'])) {
            unset($m['v']);
        }
        return Validator::make($data, $m,[
            // 'phone.regex' => 'Phone format: xxxxxxxx',
            'email.email' => 'The input must be a valid email address.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (!filter_var($data['v'], FILTER_VALIDATE_EMAIL)) {
          $data['email'] = null;
          $data['phone'] = str_replace("+965",'',$data['v']);
        } else {
          $data['email'] = $data['v'];
          $data['phone'] = null;
        }
        if(isset($data['v'])) {
            unset($data['v']);
        }
        $activated_code = rand(1000,9999);
        $user = User::create([
            'type' => $data['type'] == 'COMPNAY' ? 'COMPNAY' : 'USER',
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'password' => $data['password'],
            'activated_code' => $activated_code,
        ]);
        if (request()->has('image')) {
           $user->uploadFile($data['image']);
        }
        if(!is_null($user->phone)) {
            sendSms($user->phone,__('Your activated code is :CODE',['CODE'=>$activated_code]));
            session()->flash('success',__('app.registered_succefully_please_check_your_phone_to_active_account'));
            // \Session::put('authEmail', $user->phone);
            $this->redirectTo = "/auth/verified/mail";
        } else {
            session()->flash('success',__('app.registered_succefully_please_check_your_mail_to_active_account'));
            // \Session::put('authEmail', $user->email);
        }
        return $user;
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
    
    
    // public function redirectPath()
    // {
    //     if (method_exists($this, 'redirectTo')) {
    //         return $this->redirectTo();
    //     }
    //     if(\Auth::check()) {
    //         if(!is_null(\Auth::user()->phone)) {
    //             return property_exists($this, 'redirectTo') ? $this->redirectTo : '/auth/verified/mail';
    //         } 
    //     } else {
    //         return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    //     }
    // }
    
    
}
