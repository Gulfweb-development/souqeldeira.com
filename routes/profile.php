<?php

Route::prefix('profile')->name('profile.')->group(function () {
    Route::middleware(['auth.approved', 'prevent.back.history'])->group(function () {
        // PROFILE PAGE
        Route::get('/profile', 'App\Http\Livewire\Profile\Profile\Profile')->name('profile');
        Route::get('/invoices', 'App\Http\Livewire\Profile\Invoices\Index')->name('invoices');
        // CHANGE PASSWORD
        Route::get('/change-password', 'App\Http\Livewire\Profile\Profile\ChangePassword')->name('change.password');
        // DASHBOARD
        Route::get('/dashboard', 'App\Http\Livewire\Profile\Profile\Dashboard')->name('dashboard');
        // ADS START
        Route::get('/ads', 'App\Http\Livewire\Profile\Ad\Index')->name('ad.index');
        Route::get('/expired-ads', 'App\Http\Livewire\Profile\Ad\Expired')->name('ad.expired');
        Route::get('/ad/create', 'App\Http\Livewire\Profile\Ad\Create')->name('ad.create');
        Route::get('/ad/{ad}', 'App\Http\Livewire\Profile\Ad\Show')->name('ad.show');
        Route::get('/ad/{ad}/edit', 'App\Http\Livewire\Profile\Ad\Edit')->name('ad.edit');
        // ADS END
        // SUB START
        Route::get('/subscripts', 'App\Http\Livewire\Profile\Subscripts\Index')->name('subscriptions.index');
            Route::get('/subscripts/{subscript}', function(\App\Models\Subscriptions $subscript){
                // dd($subscript);
                $history = \DB::table('subscription_history')->insertGetId([
                        'user_id' => \Auth::user()->id,
                        'subscription_id' => $subscript->id,
                        'order_id' => 0,
                    ]);
                $payment = new App\Payment\Payment;
                $payment = $payment->setCustomer([
                    'name' => \Auth::user()->name,
                    'code' => '+965',
                    'mobile' => str_replace('+965','',\Auth::user()->phone),
                    'email' => \Auth::user()->email,
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
                $payment = $payment->getInvoiceURL($history);
                // dd($payment);
                \DB::table('subscription_history')->where([
                        'id' => $history,
                    ])->update([
                    'order_id' => $payment['invoiceId']
                    ]);
                // return redirect()->url($payment['invoiceURL']);
                header('Location: ' . $payment['invoiceURL']);



            })->name('subscripts.store')->where('subscript','[0-9]+');
        // SUB END
        // AGENCIES START
        Route::get('/agencies', 'App\Http\Livewire\Profile\Agency\Index')->name('agency.index');
        Route::get('/agency/create', 'App\Http\Livewire\Profile\Agency\Create')->name('agency.create');
        Route::get('/agency/{agency}', 'App\Http\Livewire\Profile\Agency\Show')->name('agency.show');
        Route::get('/agency/{agency}/edit', 'App\Http\Livewire\Profile\Agency\Edit')->name('agency.edit');
        // AGENCIES END
        // CONTACT USER MESSAGES START
        Route::get('/contact-user', 'App\Http\Livewire\Profile\Contactuser\Index')->name('contact-user.index');
        Route::get('/contact-user/{contactUserId}', 'App\Http\Livewire\Profile\Contactuser\Show')->name('contact-user.show');
        // CONTACT USER MESSAGES END
        // FROM ADMIN TO USER MESSAGES START
        Route::get('/user-message', 'App\Http\Livewire\Profile\Usermessage\Index')->name('user-message.index');
        Route::get('/user-message/{userMessageId}', 'App\Http\Livewire\Profile\Usermessage\Show')->name('user-message.show');
        // FROM ADMIN TO USER MESSAGES END
        // FAVORITE START
        Route::get('/favorites', 'App\Http\Livewire\Profile\Profile\Favorites')->name('favorites');
        // FAVORITE END
        // Mark Review Notification As Read START
        Route::post('/mark-as-read',function(){
            return 'KOLO BEFADEL ALLH WA7DDO | الحمد لله رب العالمين';
        });
        // Mark Review Notification As Read END
    }); // END MIDDLEWARE


    Route::get('/test', function () {
        dd('test from profile');
    });
});
