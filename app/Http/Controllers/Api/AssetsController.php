<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AssetsController extends Controller
{

    public function contactUs(Request $request){
        $request->validate([
            'first_name' => 'required|string|min:3"max:50',
            'last_name' => 'required|string|min:3"max:50',
            'email' => 'required|email|min:10|max:50',
            'message' => 'required|string|min:20|max:300',
        ]);
        Contact::create($request->only(['first_name' , 'last_name' ,'email' ,'message']));
        return $this->success([] , trans('app.message_sent'));
    }
}
