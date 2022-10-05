<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest:web')->except('logout');
    }
    // OVERRIDE TO ADD APPROVED USERS CAN LOGIN
    // protected function credentials(Request $request)
    // {
    //     $credentialsNew =  $request->only($this->username(), 'password');
    //     $credentialsNew['is_approved'] = 1;
    //     return $credentialsNew;
    //     // return $request->only($this->username(), 'password');
    // }

    protected function guard()
    {
        return Auth::guard('web');
    }
    
    
    public function login(Request $request)
    {
        $mees = [];
        if(filter_var(request('username','0'), FILTER_VALIDATE_EMAIL)) {
            $valid = [
                'username'     => ['required', 'string', 'email'],
                'password'  => 'required|string',
                ];
        } else {
            $valid = [
                'username'     => ['required', 'string', 'min:8'],
                'password'  => 'required|string',
                ];
            $mees = [
                'username.regex' => 'Phone format: xxxxxxxx',
                ];
        }
        $request->validate($valid,$mees);
        if(filter_var(request('username','0'), FILTER_VALIDATE_EMAIL)) {
            $data = [
                    'email'     => $request->username,
                    // 'password'  => $request->password,
                ];
        } else {
            $dd = str_replace('+965','',$request->username);
            $data = [
                    // 'phone'     => "+965".$dd,
                    'phone'     => $dd,
                    // 'password'  => $request->password,
                ];
        }
        $remember_me = false;
        if(request()->has('remember_me')) {
            $remember_me = true;
        } 
        $user = \App\Models\User::where($data)->first();
    
        if(is_null($user)) {
             return back()
                ->withInput($request->only('email'))
                ->withErrors(['username' => __('This email or phone not found')]);
        }
        if(\Hash::check($request->password, $user->password)) {
            \Auth::login($user);
            return redirect('/')->with('success', __("Welcome back."));
        } else {
            return redirect()->route('login')->withInput()->withErrors(['username' => __('Error in data entry')]);
        }
        
        
    }
}
