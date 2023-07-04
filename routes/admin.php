<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLangController;

Route::prefix('admin')->name('admin.')->group(function () {
    // ADMIN CHANGE LANG
    Route::get('/lang/{lang}',[AdminLangController::class,'lang'])->name('lang');
    // GUEST MIDDLEWARE START
    Route::middleware(['guest:admin', 'prevent.back.history'])->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::post('/login/submit', [AdminController::class, 'loginSubmit'])->name('login.submit');
    });
    // GUEST MIDDLEWARE END

    // AUTH MIDDLEWARE START
    Route::middleware(['auth:admin', 'prevent.back.history'])->group(function () {
        // GOVERNORATES STRAT
        Route::get('/governorate', 'App\Http\Livewire\Admin\Governorate\Index')->name('governorate.index');
        Route::get('/governorate/create', 'App\Http\Livewire\Admin\Governorate\Create')->name('governorate.create');
        Route::get('/governorate/{governorate}/edit', 'App\Http\Livewire\Admin\Governorate\Edit')->name('governorate.edit');
        Route::get('/governorate/{governorate}', 'App\Http\Livewire\Admin\Governorate\Show')->name('governorate.show');
        // GOVERNORATES END
        // REGIONS STRAT
        Route::get('/region', 'App\Http\Livewire\Admin\Region\Index')->name('region.index');
        Route::get('/region/create', 'App\Http\Livewire\Admin\Region\Create')->name('region.create');
        Route::get('/region/{region}/edit', 'App\Http\Livewire\Admin\Region\Edit')->name('region.edit');
        Route::get('/region/{region}', 'App\Http\Livewire\Admin\Region\Show')->name('region.show');
        // REGIONS END
        // BUILDING TYPE STRAT
        Route::get('/buildingtype', 'App\Http\Livewire\Admin\Buildingtype\Index')->name('buildingtype.index');
        Route::get('/buildingtype/create', 'App\Http\Livewire\Admin\Buildingtype\Create')->name('buildingtype.create');
        Route::get('/buildingtype/{buildingtype}/edit', 'App\Http\Livewire\Admin\Buildingtype\Edit')->name('buildingtype.edit');
        Route::get('/buildingtype/{buildingtype}', 'App\Http\Livewire\Admin\Buildingtype\Show')->name('buildingtype.show');
        // BUILDING TYPE END
        // subscriptions STRAT
        Route::get('/invoices', 'App\Http\Livewire\Admin\Invoices\Index')->name('invoices.index');
        Route::get('/subscriptions', 'App\Http\Livewire\Admin\Subscriptions\Index')->name('subscriptions.index');
        Route::get('/subscriptions/create', 'App\Http\Livewire\Admin\Subscriptions\Create')->name('subscriptions.create');
        Route::get('/subscriptions/{subscription}/edit', 'App\Http\Livewire\Admin\Subscriptions\Edit')->name('subscriptions.edit');
        Route::get('/subscriptions/{subscription}/status', function(\App\Models\Subscriptions $subscription){
            // dd($subscription->status);
            $subscription->update([
                'status' => ($subscription->status == 1) ? 0 : 1,
                ]);
            return redirect()->route('admin.subscriptions.index');
        })->name('subscriptions.status')->where('subscription','[0-9]+');
        // subscriptions END

        // premium position START
        Route::get('/positions/list', 'App\Http\Livewire\Admin\Positions\Index')->name('positions.index');
        Route::get('/positions/{id}/edit', 'App\Http\Livewire\Admin\Positions\Edit')->name('positions.edit');
        // premium position END
        // SLIDERS STRAT
        Route::get('/slider', 'App\Http\Livewire\Admin\Slider\Index')->name('slider.index');
        Route::get('/slider/create', 'App\Http\Livewire\Admin\Slider\Create')->name('slider.create');
        Route::get('/slider/{slider}/edit', 'App\Http\Livewire\Admin\Slider\Edit')->name('slider.edit');
        Route::get('/slider/{slider}','App\Http\Livewire\Admin\Slider\Show')->name('slider.show');
        // SLIDERS END
        // BUILDING STATUS STRAT
        Route::get('/buildingstatus', 'App\Http\Livewire\Admin\Buildingstatus\Index')->name('buildingstatus.index');
        Route::get('/buildingstatus/create', 'App\Http\Livewire\Admin\Buildingstatus\Create')->name('buildingstatus.create');
        Route::get('/buildingstatus/{buildingstatus}/edit', 'App\Http\Livewire\Admin\Buildingstatus\Edit')->name('buildingstatus.edit');
        Route::get('/buildingstatus/{buildingstatus}', 'App\Http\Livewire\Admin\Buildingstatus\Show')->name('buildingstatus.show');
        // BUILDING STATUS END
        // FAQS STRAT
        Route::get('/faq', 'App\Http\Livewire\Admin\Faq\Index')->name('faq.index');
        Route::get('/faq/create', 'App\Http\Livewire\Admin\Faq\Create')->name('faq.create');
        Route::get('/faq/{faq}/edit', 'App\Http\Livewire\Admin\Faq\Edit')->name('faq.edit');
        Route::get('/faq/{faq}','App\Http\Livewire\Admin\Faq\Show')->name('faq.show');
        // FAQS END
        // POLICIES STRAT
        Route::get('/policy', 'App\Http\Livewire\Admin\Policy\Index')->name('policy.index');
        Route::get('/policy/create', 'App\Http\Livewire\Admin\Policy\Create')->name('policy.create');
        Route::get('/policy/{policy}/edit', 'App\Http\Livewire\Admin\Policy\Edit')->name('policy.edit');
        Route::get('/policy/{policy}','App\Http\Livewire\Admin\Policy\Show')->name('policy.show');
        // POLICIES END
        // ABOUTS STRAT
        Route::get('/about', 'App\Http\Livewire\Admin\About\Index')->name('about.index');
        Route::get('/about/create', 'App\Http\Livewire\Admin\About\Create')->name('about.create');
        Route::get('/about/{about}/edit', 'App\Http\Livewire\Admin\About\Edit')->name('about.edit');
        Route::get('/about/{about}','App\Http\Livewire\Admin\About\Show')->name('about.show');
        // ABOUTS END
        // BLOGS STRAT
        Route::get('/blog', 'App\Http\Livewire\Admin\Blog\Index')->name('blog.index');
        Route::get('/blog/create', 'App\Http\Livewire\Admin\Blog\Create')->name('blog.create');
        Route::get('/blog/{blog}/edit', 'App\Http\Livewire\Admin\Blog\Edit')->name('blog.edit');
        Route::get('/blog/{blog}','App\Http\Livewire\Admin\Blog\Show')->name('blog.show');
        // BLOGS END
        // USERS STRAT
        Route::get('/user', 'App\Http\Livewire\Admin\User\Index')->name('user.index');
        Route::get('/user/create', 'App\Http\Livewire\Admin\User\Create')->name('user.create');
        Route::get('/user/{user}/edit', 'App\Http\Livewire\Admin\User\Edit')->name('user.edit');
        Route::get('/user/{user}','App\Http\Livewire\Admin\User\Show')->name('user.show');
        Route::get('/user/{user}/analytics', 'App\Http\Livewire\Admin\User\Analytics')->name('user.analytics');
        Route::get('/user/subscription/{user}','App\Http\Livewire\Admin\User\Subscription')->name('user.subscription');
        // USERS END
        // COMPANIES STRAT
        Route::get('/company', 'App\Http\Livewire\Admin\Company\Index')->name('company.index');
        Route::get('/company/create', 'App\Http\Livewire\Admin\Company\Create')->name('company.create');
        Route::get('/company/{company}/edit', 'App\Http\Livewire\Admin\Company\Edit')->name('company.edit');
        Route::get('/company/{company}','App\Http\Livewire\Admin\Company\Show')->name('company.show');
        // COMPANIES END
        // AGENCIES STRAT
        Route::get('/agency', 'App\Http\Livewire\Admin\Agency\Index')->name('agency.index');
        Route::get('/agency/create', 'App\Http\Livewire\Admin\Agency\Create')->name('agency.create');
        Route::get('/agency/{agency}/edit', 'App\Http\Livewire\Admin\Agency\Edit')->name('agency.edit');
        Route::get('/agency/{agency}', 'App\Http\Livewire\Admin\Agency\Show')->name('agency.show');
        // AGENCIES END
        // ADS STRAT
        Route::get('/ad', 'App\Http\Livewire\Admin\Ad\Index')->name('ad.index');
        Route::get('/ad/create', 'App\Http\Livewire\Admin\Ad\Create')->name('ad.create');
        Route::get('/ad/{ad}/edit', 'App\Http\Livewire\Admin\Ad\Edit')->name('ad.edit');
        Route::get('/ad/{ad}', 'App\Http\Livewire\Admin\Ad\Show')->name('ad.show');
        Route::get('/ad/{ad}/featured', function(\App\Models\Ad $ad){
            $ad->update([
                    'is_featured'   => ($ad->is_featured == 1) ? 0 : 1
                ]);
            return redirect()->back();
            })->name('ad.featured')->where('ad','[0-9]+');
        // ADS END
        // SETTINGS STRAT
        Route::get('/setting', 'App\Http\Livewire\Admin\Setting\Index')->name('setting.index');
        // Route::get('/setting/create', 'App\Http\Livewire\Admin\Setting\Create')->name('setting.create');
        Route::get('/setting/{setting}/edit', 'App\Http\Livewire\Admin\Setting\Edit')->name('setting.edit');
        Route::get('/setting/{setting}', 'App\Http\Livewire\Admin\Setting\Show')->name('setting.show');
        // SETTINGS END
        // CLIENTS STRAT
        Route::get('/client', 'App\Http\Livewire\Admin\Client\Index')->name('client.index');
        Route::get('/client/create', 'App\Http\Livewire\Admin\Client\Create')->name('client.create');
        Route::get('/client/{client}/edit', 'App\Http\Livewire\Admin\Client\Edit')->name('client.edit');
        Route::get('/client/{client}', 'App\Http\Livewire\Admin\Client\Show')->name('client.show');
        // CLIENTS END
        // WHY CHOOSE US STRAT
        Route::get('/whychooseus', 'App\Http\Livewire\Admin\Whychooseus\Index')->name('whychooseus.index');
        Route::get('/whychooseus/create', 'App\Http\Livewire\Admin\Whychooseus\Create')->name('whychooseus.create');
        Route::get('/whychooseus/{whychooseus}/edit', 'App\Http\Livewire\Admin\Whychooseus\Edit')->name('whychooseus.edit');
        Route::get('/whychooseus/{whychooseus}', 'App\Http\Livewire\Admin\Whychooseus\Show')->name('whychooseus.show');
        // WHY CHOOSE US END
        // CONTACTS STRAT
        Route::get('/contact', 'App\Http\Livewire\Admin\Contact\Index')->name('contact.index');
        Route::get('/contact/{contact}', 'App\Http\Livewire\Admin\Contact\Show')->name('contact.show');
        // Reports
        Route::get('/reports', 'App\Http\Livewire\Admin\Report\Index')->name('reports.index');
        // CONTACTS END
        // CONTACT INFOS STRAT
        Route::get('/info', 'App\Http\Livewire\Admin\Info\Index')->name('info.index');
        Route::get('/info/{info}/edit', 'App\Http\Livewire\Admin\Info\Edit')->name('info.edit');
        Route::get('/info/{info}', 'App\Http\Livewire\Admin\Info\Show')->name('info.show');
        // CONTACT INFOS END
        // COMMENTS STRAT
        Route::get('/comment', 'App\Http\Livewire\Admin\Comment\Index')->name('comment.index');
        Route::get('/comment/{comment}', 'App\Http\Livewire\Admin\Comment\Show')->name('comment.show');
        // COMMENTS END
        // NOTIFICATIONS STRAT
        Route::get('/notification', 'App\Http\Livewire\Admin\Notification\Create')->name('notification.create');
        // NOTIFICATIONS END
        // SCHOOL STRAT
        Route::get('/school', 'App\Http\Livewire\Admin\School\Index')->name('school.index');
        Route::get('/school/create', 'App\Http\Livewire\Admin\School\Create')->name('school.create');
        Route::get('/school/{school}/edit', 'App\Http\Livewire\Admin\School\Edit')->name('school.edit');
        Route::get('/school/{school}', 'App\Http\Livewire\Admin\School\Show')->name('school.show');
        // SCHOOL END
        // ADMIN STRAT
        Route::get('/admin', 'App\Http\Livewire\Admin\Admin\Index')->name('admin.index');
        Route::get('/admin/create', 'App\Http\Livewire\Admin\Admin\Create')->name('admin.create');
        Route::get('/admin/{admin}/edit', 'App\Http\Livewire\Admin\Admin\Edit')->name('admin.edit');
        Route::get('/admin/{admin}', 'App\Http\Livewire\Admin\Admin\Show')->name('admin.show');
        // ADMIN END
        // ROLE STRAT
        Route::get('/role', 'App\Http\Livewire\Admin\Role\Index')->name('role.index');
        Route::get('/role/create', 'App\Http\Livewire\Admin\Role\Create')->name('role.create');
        Route::get('/role/{role}/edit', 'App\Http\Livewire\Admin\Role\Edit')->name('role.edit');
        Route::get('/role/{role}', 'App\Http\Livewire\Admin\Role\Show')->name('role.show');
        // ROLE END
        Route::get('/dashboard', 'App\Http\Livewire\Admin\Dashboard')->name('dashboard');
    });
    // AUTH MIDDLEWARE END
});
// END PREFIX MIDDLEWARE
