<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLangController extends Controller
{
    public function lang($lang)
    {
        Session()->put('locale', $lang);
        return redirect()->back();
    }
}
