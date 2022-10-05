<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
// Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\Forget;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    
    
    // public function __construct(Request $request) {
    //     if($request->isMethod('post')) {
    //       $user = User::where(['email'=>$request->email])->first();
    //       if(!is_null($user)) {
    //           $activated_code = rand(1000,9999);
    //           $user->update([
    //               'activated_code' => $activated_code
    //               ]);
    //           sendSms($user->phone,__('Your activated code is :CODE',['CODE'=>$activated_code]));
    //       }
    //     }
    // }
    
    public function sendResetLinkEmail(Request $request)
    {
        $mees = [];
        if(filter_var(request('username','0'), FILTER_VALIDATE_EMAIL)) {
            $valid = [
                'username'     => ['required', 'string', 'email'],
                ];
        } else {
            $valid = [
                'username'     => ['required', 'string', 'min:8'],
                ];
            $mees = [
                'username.regex' => 'Phone format: +965xxxxxxxx',
                ];
        }
        $request->validate($valid,$mees);
        if(filter_var(request('username','0'), FILTER_VALIDATE_EMAIL)) {
            $data = [
                    'email'     => $request->username,
                ];
        } else {
            $dd = str_replace('+965','',$request->username);
            $data = [
                    'phone'     => "+965".$dd,
                ];
        }
        $user = User::where($data)->first();
        if(is_null($user)) {
            return back()
                ->withInput()
                ->withErrors(['user' => __('This user not found')]);
        }
        $activated_code = rand(1000,9999);
        $user->update([
            'activated_code' => $activated_code
        ]);
        \Session::put('authEmail', $user->email);
        if(!is_null($user->phone)) {
            sendSms($user->phone,__('Your activated code is :CODE',['CODE'=>$activated_code]));
        }
        // Send Mail
        Mail::to($user->email)->send(new Forget($user));
        return redirect()->route('auth.passwords.reset')->with('status', __('Your activated code send to email and phone'));
    }
    
    
    
    
}
