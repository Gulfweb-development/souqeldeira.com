<?php

namespace App\Http\Controllers\AuthCompany;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Company;
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
    protected $redirectTo = RouteServiceProvider::HOME_COMPANY;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:company');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies','unique:users'],
            'phone' => ['nullable', 'numeric', 'digits_between:10,15', 'unique:companies','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
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
        // WILL DELETE IT
        $data['phone'] = 'phone number is here';
        $user = Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        if (request()->has('image')) {
           $user->uploadFile($data['image']);
        }
        return $user;
    }
    public function showRegistrationForm()
    {
        return view('authCompany.register');
    }

    protected function guard()
    {
        return Auth::guard('company');
    }
}
