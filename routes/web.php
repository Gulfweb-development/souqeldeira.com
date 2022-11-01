<?php

use Facebook\Facebook;
use App\Services\SocialMediaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Abraham\TwitterOAuth\TwitterOAuth;
use Facebook\Exceptions\FacebookSDKException;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\FrontendLangController;
use Illuminate\Http\Request;

Route::get('/test-send-sms/{phone}', function ($phone = "+201025261808") {
    $activated_code = rand(1000,9999);
    $phone = "+201025261808";
    return sendSms($phone,__('Your activated code is :CODE',['CODE'=>$activated_code]));
});
// ADMIN CHANGE LANG
Route::get('/','App\Http\Livewire\Frontend\Welcome')->name('welcome');
Route::get('/lang/{lang}', [FrontendLangController::class, 'lang'])->name('lang');
Route::get('/sitemap.xml', [\App\Http\Controllers\Frontend\SiteMapController::class, 'index'])->name('sitemap');
Route::get('/abouts','App\Http\Livewire\Frontend\About\Abouts')->name('abouts');
Route::get('/contacts','App\Http\Livewire\Frontend\Contact\Contacts')->name('contacts');
Route::get('/ads/search/{type?}','App\Http\Livewire\Frontend\Ads\AdsSearch')->name('ads.search');
Route::get('/agency/{slug}/{agency_id}/ads/search/{type?}','App\Http\Livewire\Frontend\Ads\AdsSearch')->name('agency.ads');
Route::get('/adasdsasad/{slug}/{id}', 'App\Http\Livewire\Frontend\Ads\AdSearch')->name('ad.search');
Route::get('/agencies', 'App\Http\Livewire\Frontend\Agency\Agencies')->name('agencies');
Route::get('/agency/{slug}/{id}', 'App\Http\Livewire\Frontend\Agency\Agency')->name('agency');
Route::get('/blogs', 'App\Http\Livewire\Frontend\Blog\Blogs')->name('blogs');
Route::get('/blog/{slug}/{id}', 'App\Http\Livewire\Frontend\Blog\Blog')->name('blog');
Route::get('/policies', 'App\Http\Livewire\Frontend\Policy\Policy')->name('policy');
Route::get('/scools', 'App\Http\Livewire\Frontend\School\Schools')->name('schools');
Route::get('/scool/{slug}/{id}', 'App\Http\Livewire\Frontend\School\School')->name('school');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/auth/passwords/reset',function(Request $request){
    $email = \Session::get('authEmail');
    if(is_null($email)) {
        return redirect()->route('login');
    }
    return view('auth.passwords.reset2');
})->name('auth.passwords.reset');

Route::post('/auth/passwords/reset',function(Request $request){
    $email = \Session::get('authEmail');
    if(is_null($email)) {
        return redirect()->route('login');
    }
    $request->validate([
        'activated_code' => 'required',
        'password'  => 'required|confirmed|min:8',
    ]);

    $user = \App\Models\User::where(['email'=>$email])->first();

    if($user->activated_code != $request->activated_code) {
         return back()
            ->withInput($request->only('email'))
            ->withErrors(['activated_code' => __('activated code id rong')]);
    }
    \DB::table('users')->where('id',$user->id)->update([
            'password' => Hash::make(request('password')),
        ]);
    \Session::forget('authEmail');
    return redirect()->route('login');
})->name('auth.passwords.reset.post');

Route::middleware(['auth'])->group(function () {



    // Start new routes

    Route::get('/get_subscript',function(Request $request){
        return view('new.index',[
            'lists' => \App\Models\Subscriptions::all()
            ]);
    });

    Route::get('/get_subscript/{subscript}/payment',function(\App\Models\Subscriptions $subscript){
        // dd($subscript);
        $user = \Auth::user();
        if($subscript->price == 0) {
            $user->update([
                    'adv_nurmal_count'  => $user->adv_nurmal_count + $subscript->adv_nurmal_count,
                    'adv_star_count'    => $user->adv_star_count + $subscript->adv_star_count
                ]);
            return redirect()->route('home');
        }
        $payment = new App\Payment\Payment;
        $payment = $payment->setCustomer([
            'name' => $user->name,
            'code' => '+965',
            'mobile' => str_replace('+965','',$user->phone),
            'email' => $user->email,
        ])->setAddress([
            'block' => 'defult',
            'street' => 'defult',
            'building' => 'defult',
            'address' => 'Egypt,mansoura',
            'instructions' => 'defult',
        ])->setItems([
            [
                "ItemName"   => $subscript->name_ar,
                "Quantity"   => 1,
                "UnitPrice"  => $subscript->price,
            ]
        ])->setTotal($subscript->price)
            ->setCallBackUrl("https://test.aldeiramarket.com/payment-redirect/success")
            ->setErrorUrl("https://test.aldeiramarket.com/payment-redirect/error");
        // return view('new.index');
        $payment = $payment->getInvoiceURL(rand(10,100000));
        // return redirect()->url($payment['invoiceURL']);
        header('Location: ' . $payment['invoiceURL']);
    });

    Route::get('/payment-redirect/{status}',function(Request $request,$status){
        // dd($request->all(),$status);
        return redirect()->route('home');
    });


    // https://demo.MyFatoorah.com/KWT/ie/01072114934341



    // End new routes







    Route::get('/auth/verified/mail',function(Request $request){
        return view('auth.passwords.verified-mail');
    })->name('auth.passwords.verified.mail');

    Route::post('/auth/verified/mail',function(Request $request){
        $request->validate([
            'activated_code' => 'required',
        ]);
        if(\Auth::user()->activated_code != $request->activated_code) {
             return back()
                ->withInput($request->only('email'))
                ->withErrors(['activated_code' => __('activated code id rong')]);
        }
        \DB::table('users')->where('id',\Auth::user()->id)->update([
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        return redirect()->route('home');
    })->name('auth.passwords.verified.mail.post');

});




Route::get('/logout',[LoginController::class,'logout'])->name('auth.logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/sync', [App\Http\Controllers\SyncController::class, 'sync'])->name('sync');
Route::get('/test', function () {
    // Upload Photo

    // Auth::guard('web')->logout();
    // $connection = new TwitterOAuth(env('TWITTER_API_KEY'), env('TWITTER_API_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
    // $tweet = "One more post aldera befddal allah ";
    // $imageMedia = $connection->upload('media/upload', ['media' => public_path('uploads/0c1e7683578ee3daa764555689e16748.png')]);
    // $parameters = [
    //     "status" => $tweet,
    //     "media_ids" => $imageMedia->media_id_string
    // ];

    // $statuses = $connection->post("statuses/update", $parameters);
    // $connect = new SocialMediaService();
    // $result = $connect->publishToTwitter();
    // dd($result,'FINSH BEFDEL ALLAH');
    // return 'KOLO BEFADEL ALLH WA7DDO | الحمد لله رب العالمين';
    // FACEBOOK PUBLISHING
    $fb = new Facebook([
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'default_graph_version' => 'v12.0',
        'default_access_token' => env('FACEBOOK_PAGE_ACCESS_TOKEN'), // optional
    ]);
    try {
        $imageUrl = public_path('images/video_bg.jpg');
        // $imageUrl = url('/');
        $fb->post(env('FACEBOOK_APP_ID').'/media',[
            'image_url' => 'https//www.example.com/images/bronz-fonz.jpg',
            'caption' => '%23BronzFonz',
        ]);
        // dd($imageUrl.'/images/popup1.jpg');
        // $response = $fb->post('106808981764636/photos', [
        //     'message' => 'UUUUUUUUUUUUUU',
        //     'source' => $fb->fileToUpload($imageUrl),
        //     // 'link' => 'https://test.aldeiramarket.com',
        //     // 'url' => 'https://images.pexels.com/photos/931177/pexels-photo-931177.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //     // 'url' => "${imageUrl}",
        // ])->getGraphNode()->asArray();
        // $fb->fileToUpload($imageUrl);
        if ($response['id']) {
            // post created
            dd($response,'PHOTO PUBLISHED');
        }
    } catch (FacebookSDKException $e) {
        dd($e); // handle exception
    }
    // $fb->api( '/me/photos', 'POST', ['message' => 'My message', 'source' => $fb->fileToUpload('direct/path/to/image.jpg')] );

//$fb->api( '/' . $page_id . '/photos', 'POST', ['message' => 'My message', 'source' => $fb->fileToUpload('direct/path/to/image.jpg')] );

//$fb->api( '/me/feed', 'POST', ['picture' => "http://autostyl.frio.sk/images/facebook_share.jpg", 'link' => 'http://autostyl.frio.sk'] );

//->fileToUpload($path)

});
