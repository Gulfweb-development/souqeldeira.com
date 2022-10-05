<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendLangController extends Controller
{
    public function lang($lang)
    {
        Session()->put('front-locale', $lang);
        return redirect()->back();
    }
}
