<?php

namespace App\Http\Controllers\Api\Advertise;

use App\Http\Controllers\Controller;
use App\Jobs\SocialFacebookJob;
use App\Jobs\SocialMediaJob;
use App\Models\Ad;
use App\Models\BuildingType;
use App\Models\Favorite;
use App\Models\Governorate;
use App\Models\Region;
use App\Models\Report;
use App\Models\Setting;
use App\Models\SubscriptionHistories;
use App\Services\FavoritesService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdvertiseController extends Controller
{
    public static function formatAuthor($user)
    {
        $user = optional($user);
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
            'is_agency' => $user->is_approved and $user->type == "COMPANY" ,
            'agency_link' => $user->is_approved and $user->type == "COMPANY" ?  route('agency.ads',[toSlug($user->name),$user->id]) : null ,
            'socials' => $user->socials ?? [
                    'instagram' => null,
                    'youtube' => null,
                    'telegram' =>  null,
                    'website' => null,
                    'linkedin' =>  null,
                    'facebook' =>  null,
                    'twitter' => null,
                ]
        ];
    }
    public static function formatAd($ad , $deleteUseless = false)
    {
        /** @var Ad $ad */
        $comments = [
            'active' => false,
            'number' => 0,
            'comments' => [],
        ];
        if ( env('COMMENT_ACTIVE' , true) and !$deleteUseless) {
            $comments = [
                'active' => true,
                'number' => $ad->commentsCount(),
                'comments' => $ad->approvedComments()->latest()->get()->transform(function ($comment) {
                    return [
                        'author'=> self::formatAuthor($comment->user),
                        'stars'=> $comment->stars,
                        'text' =>[
                            'short' => Str::limit(strip_tags($comment->text), 100),
                            'htmlLess' => strip_tags($comment->text),
                            'isArabic' => isArabic(strip_tags($comment->text)),
                            'original' => $comment->text
                        ],
                        'created_at'=>[
                            'human' =>$comment->created_at->diffForHumans(),
                            'system' =>$comment->created_at,
                        ],
                    ];
                }),
            ];
        }
        $information =  [
            'id' => $ad->id ,
            'title' => $ad->title ,
            'description' =>[
                'short' => Str::limit(strip_tags($ad->text), 100),
                'htmlLess' => strip_tags($ad->text),
                'isArabic' => isArabic(strip_tags($ad->text)),
                'original' => $ad->text
            ],
            'phone'=>$ad->phone,
            'link' => route('ad.search', [toSlug($ad->title), $ad->id]),
            'author'=> self::formatAuthor($ad->user),
            'is_featured'=>$ad->is_featured == "1",
            'views'=>$ad->views,
            'comments'=>$comments,
            'price'=>$ad->price,
            'whatsapp' => 'https://api.whatsapp.com/send?phone=+965'.$ad->phone.'&text='. __('app.whatsapp_text' , ['url' => route('ad.search', [toSlug($ad->title), $ad->id])]),
            'is_favorite'=> request()->user() != null && $ad->favorites()->where('user_id', request()->user()->id)->count() > 0,
            'images'=> [
                'main' => toAdDefaultImage($ad->getFile()),
                'other' => []
            ],
            'created_at'=>[
                'human' =>$ad->created_at->diffForHumans(),
                'system' =>$ad->created_at,
            ],
            'type'=>[
                'human' => $ad->type == 'RENT' ? trans('app.rent') : ( $ad->type == "EXCHANGE" ? trans('app.exchange') : trans('app.sale') ) ,
                'system' => $ad->type,
            ],
            'buildingType'=>optional($ad->buildingType)->translate('name'),
            'location' => [
                'town_id' =>  optional($ad->region)->id,
                'town_title' =>  optional($ad->region)->translate('name'),
                'governorate_id' =>  optional($ad->governorate)->id,
                'governorate_title' =>  optional($ad->governorate)->translate('name'),
            ],
            'similarAds' => !$deleteUseless ? Ad::where('is_approved', 1)
                ->where('region_id', $ad->region_id)
                ->inRandomOrder()
                ->take(3)
                ->get()->transform(function ($item) { return self::formatAd($item , true) ;} ) : [],
        ];
        if ( $deleteUseless ) {
            unset($information['description']['htmlLess'],
                $information['description']['original'],
                $information['author']['id'],
                $information['author']['avatar'],
                $information['comments'],
                $information['whatsapp'],
                $information['similarAds'],
                $information['images']['other'],
            );
        }
        return $information;
    }
    public function search(Request $request){
        $ads = Ad::query()
            ->when(($request->get('saleId') and in_array(strtoupper($request->get('saleId')) , ['EXCHANGE' , 'SALE','RENT'] )) , function ($query) use ($request) {
                $query->where('type' , strtoupper($request->get('saleId')));
            })
            ->when(($request->get('agency_id') and $request->get('agency_id') > 0 ) , function ($query) use ($request) {
                $query->where('user_id' , $request->get('agency_id'));
            })
            ->when($request->get('townId') , function ($query) use ($request) {
                if ( is_array($request->get('townId')) ){
                    $towns = collect($request->get('townId'))->filter(function ($item) {
                        return intval($item) > 0;
                    })->values();
                    $query->whereIn('region_id' , $towns);
                } elseif ( intval($request->get('townId')) > 0 )
                    $query->where('region_id' , intval($request->get('townId')));
            })
            ->when(($request->get('priceFrom') and $request->get('priceFrom') > 0 ) , function ($query) use ($request) {
                $query->where('price' , '>=', $request->get('priceFrom'));
            })
            ->when(($request->get('priceTo') and $request->get('priceTo') > 0 ) , function ($query) use ($request) {
                $query->where('price' , '<=', $request->get('priceTo'));
            })
            ->with('region', 'governorate', 'images', 'user', 'buildingType')
            ->where('is_approved', 1)
            ->orderByDesc('is_featured')
            ->latest()
            ->when(($request->get('sortBy') and in_array(strtoupper($request->get('sortBy')) , ['MOST_VIEWED' , 'LOW_TO_HIGH','HIGH_TO_LOW'] )) , function ($query) use ($request) {
                if ( strtoupper($request->get('sortBy')) == "MOST_VIEWED" )
                    $query->orderBy('views','DESC');
                elseif ( strtoupper($request->get('sortBy')) == "LOW_TO_HIGH" )
                    $query->orderBy('price','ASC');
                else
                    $query->orderBy('price','DESC');
            })
            ->paginate($request->get('per_page'));
        $ads = $this->paginationFormat($ads , function ($ad) {
            return $this->formatAd($ad , true);
        });
        return $this->success($ads);
    }

    public function adDetails(Request $request){
        $id= $request->get('adId');
        $ad = Ad::where('id', $id)->where('is_approved', 1)->firstOrFail();
        $ad->increment('views');
        $recentAds = Ad::where('is_approved', 1)->latest()->take(3)
            ->get()->transform(function ($ad) {
                return $this->formatAd($ad , true);
            });
        $featuredAds = Ad::where('is_approved', 1)
            ->where('is_featured', 1)
            ->inRandomOrder()->take(5)
            ->get()->transform(function ($ad) {
                return $this->formatAd($ad , true);
            });
        $ad = $this->formatAd($ad);
        $ad = array_merge($ad , ['recentAds' => $recentAds , 'featuredAds' => $featuredAds]);
        return $this->success($ad);
    }

    public function viewAdd(Request $request){
        $id= $request->get('adId');
        $ad = Ad::where('id', $id)->where('is_approved', 1)->firstOrFail();
        $ad->increment('views');
        return $this->success(['views' => $ad->views+1]);
    }

    public function reportAdd(Request $request){
        $request->validate([
            'id' => 'required|exists:ads,id',
            'description' => 'required|string',
        ]);
        $ad = Ad::query()->where('id', $request->id)->firstOrFail();
        Report::insert($ad,$request->description);
        return $this->success([] ,  __('app.reportSent'));
    }

    public function addToFavorite(Request $request){
        $id= $request->get('adId');
        $ad = Ad::where('id', $id)->firstOrFail();
        $favoriteCount = Favorite::where('ad_id', $ad->id)->where('user_id', $request->user()->id)->count();
        $service = new FavoritesService($ad);
        if ($favoriteCount > 0) {
            $service->deleteFromFavorite();
            return $this->success(['is_favorite' => false] ,__('app.data_deleted_favorite'));
        }
        $service->addToFavorite();
        return $this->success([ 'is_favorite' => true] ,__('app.data_added_favorite'));
    }

    public function favorites(Request $request){
        $favoriteAds = Favorite::with('user', 'ad')
            ->where('user_id', user()->id)
            ->whereHas('ad', function ($query){
                $query->where('is_approved', 1);
            })
            ->latest()
            ->paginate($request->get('per_page'));
        $favoriteAds = $this->paginationFormat($favoriteAds , function ($ad) {
            return $this->formatAd($ad->ad , true);
        });
        return $this->success([$favoriteAds] );
    }

    public function myAds(Request $request) {
        $myAds = Ad::query()
            ->with('region', 'governorate', 'images', 'user', 'buildingType')
            ->where('user_id', user()->id)
            ->latest()
            ->paginate($request->get('per_page'));
        $myAds = $this->paginationFormat($myAds , function ($ad) {
            return $this->formatAd($ad , true);
        });
        return $this->success([$myAds] );
    }
    public function myExpiredAds(Request $request) {
        $myAds = Ad::query()
            ->withTrashed()
            ->where('archived_at' , '<' , now())
            ->with('region', 'governorate', 'images', 'user', 'buildingType')
            ->where('user_id', user()->id)
            ->latest()
            ->paginate($request->get('per_page'));
        $myAds = $this->paginationFormat($myAds , function ($ad) {
            return $this->formatAd($ad , true);
        });
        return $this->success([$myAds] );
    }
    public function delete(Request $request) {
        $ad = Ad::query()->where('id', $request->get('id' , 0))->where('user_id', user()->id)->firstOrFail();
        $ad->delete();
        return $this->success([] , __('app.data_deleted') );
    }
    public function myAdDetails(Request $request)
    {
        $ad = Ad::query()->where('id', $request->get('id' , 0))->where('user_id', user()->id)->firstOrFail();
        $ad = $this->formatAd($ad);
        return $this->success($ad);
    }
    public function myAdEdit(Request $request)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'id' => 'required|exists:ads,id',
            //'governorate_id' => 'required|exists:governorates,id',
            'building_type_id' => 'required|exists:building_types,id',
            'text' => 'required|string',
            'price' => 'nullable|numeric',
            'type' => 'required|in:SALE,EXCHANGE,RENT',
            'phone' => 'required|string|regex:' . phoneNumberFormat(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $toRegId = Region::select('id', 'governorate_id' , toLocale('name'))->where('id', $request->get('region_id'))->firstOrFail();
        $toGovId = Governorate::select('id', toLocale('name'))->where('id', $toRegId->governorate_id )->firstOrFail();
        $toBuidingTypeId = buildingType::select('id', toLocale('name'))->where('id', $request->get('building_type_id'))->firstOrFail();
        $toType = $request->get('type') == 'SALE' ? __('app.sale') : ( $request->get('type') == 'EXCHANGE' ? __('app.exchange') : __('app.rent'));
        $ad =  Ad::query()->with('images')->where('user_id', user()->id)->where('id', $request->get('id'))->firstOrFail();
        $ad->update([
            'governorate_id' => $toGovId->id,
            'region_id' => $toRegId->id,
            'building_type_id' => $toBuidingTypeId->id,
            'title' => Ad::toTitle($toType, $toGovId->translate('name'), $toRegId->translate('name'), $toBuidingTypeId->translate('name')),
            'type' => $request->get('type'),
            'phone' => $request->get('phone'),
            'price' => $request->get('price'),
            'text' => $request->get('text'),
            'is_approved' => 1,
        ]);
        if ($request->file('image') != '') {
            $ad->deleteFile();
            $ad->uploadFile($request->file('image'));
        }
        return $this->success([] , __('app.data_updated') );
    }

    public function repost(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ads,id',
        ]);

        if (env('ADS_LIMIT') > 0 and env('ADS_LIMIT') <= user()->ads()->count()) {
            return $this->error(400 , __('app.you_got_ads_limit_please_remove_some_to_can_ad_more') );
        }
        $ad =  Ad::query()->with('images')->where('user_id', user()->id)->where('id', $request->get('id'))->firstOrFail();
        if ( ! SubscriptionHistories::canPostAd( $ad->is_featured , user())) {
            return $this->error(400 , __('increase_balance') );
        }
        SubscriptionHistories::postAd( $ad->is_featured , user());
        $newAd = clone $ad;
        $newAd->fill([
            'is_approved' => 1,
            'code' => Str::random(6),
            'created_at' => Carbon::now('UTC'),
            'updated_at' => Carbon::now('UTC'),
            'archived_at' => Carbon::now('UTC')->addDays(
                $ad->is_featured ? Setting::get('expire_time_premium_adv', 15) : Setting::get('expire_time_adv', 15)
            )->format('Y-m-d H:i:s')
        ]);
        $newAd->save();
        return $this->success([$this->formatAd($newAd)] , __('app.data_created') );
    }

    public function myAdDeleteImage(Request $request)
    {
        $ad =  Ad::query()->with('images')->where('user_id', user()->id)->where('id', $request->get('id'))->firstOrFail();
        $ad->deleteFile();
        return $this->success([] , __('app.data_updated') );
    }


    public function upgrade(Request $request)
    {
        $ad =  Ad::query()->where('user_id', user()->id)->where('id', $request->get('id'))->firstOrFail();
        if ( !  $ad->is_featured ) {
            if ( ! SubscriptionHistories::canPostAd( true , user())) {
                return $this->error(400 , __('increase_balance') );
            }
            $ad->update([
                'is_featured' => 1,
                'archived_at' => Carbon::now('UTC')->addDays(
                    Setting::get('expire_time_premium_adv', 15)
                )->format('Y-m-d H:i:s')
            ]);
            SubscriptionHistories::postAd( true , user());
        }
        return $this->success([] , __('upgraded') );
    }


    public function create(Request $request)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'is_featured' => 'required|boolean',
            //'governorate_id' => 'required|exists:governorates,id',
            'building_type_id' => 'required|exists:building_types,id',
            'type' => 'required|in:SALE,RENT,EXCHANGE',
            'text' => 'required|string',
            'price' => 'nullable|numeric',
            'phone' => 'required|string|regex:' . phoneNumberFormat(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        // CHECK IF USER GET THE LIMIT OF ADS
        if (env('ADS_LIMIT') > 0 and env('ADS_LIMIT') <= user()->ads()->count()) {
            return $this->error(400 , __('app.you_got_ads_limit_please_remove_some_to_can_ad_more') );
        }
        if ( ! SubscriptionHistories::canPostAd( $request->get('is_featured') == "1" , user())) {
            return $this->error(400 , __('increase_balance') );
        }
        //  TO PARSE COLLECTED DATA TO TITLE
        $toRegId = Region::select('id', 'governorate_id', toLocale('name'))->where('id', $request->get('region_id'))->firstOrFail();
        $toGovId = Governorate::select('id', toLocale('name'))->where('id', $toRegId->governorate_id)->firstOrFail();
        $toBuidingTypeId = buildingType::select('id', toLocale('name'))->where('id', $request->get('building_type_id'))->firstOrFail();
        $toType = $request->get('type') == 'SALE' ? __('app.sale') : ( $request->get('type') == 'EXCHANGE' ? __('app.exchange') : __('app.rent'));
        $ad = Ad::query()->create([
            'governorate_id' => $toGovId->id,
            'is_featured' => $request->get('is_featured'),
            'region_id' => $toRegId->id,
            'building_type_id' => $toBuidingTypeId->id,
            'type' => $request->get('type') ,
            'title' => Ad::toTitle($toType, $toGovId->translate('name'), $toRegId->translate('name'), $toBuidingTypeId->translate('name')),
            'phone' => $request->get('phone'),
            'price' => $request->get('price'),
            'text' => $request->get('text'),
            'user_id' => user()->id,
            'is_approved' => 1,
            'code' => Str::random(6),
            'archived_at' => Carbon::now('UTC')->addDays(
                $request->get('is_featured') == "1" ? Setting::get('expire_time_premium_adv', 15) : Setting::get('expire_time_adv', 15)
            )->format('Y-m-d H:i:s'),
        ]);
        SubscriptionHistories::postAd( $request->get('is_featured') == "1" , user());
        // RESIZE IMAGE TO PLACEC IT IN IMAGE
        if ($request->hasFile('image')) {
            $ad->uploadFile($request->file('image'));
        }
        try {
            if ( class_exists(\I18N_Arabic::class) ) {
                // PROGRAMMING IMAGES TO PUBLISH IT TO SOCIAL MEDIA
                $img = Image::make(public_path('images/facebook.png'));
                $Arabic = new \I18N_Arabic('Glyphs');
                // LOCALIZE TEXTS ON IMAGES
                if (app()->isLocale('ar')) {
                    $name = $Arabic->utf8Glyphs($ad->title);
                    $unknown = $Arabic->utf8Glyphs(__('app.unknown'));
                } else {
                    $name = $ad->title;
                    $unknown = __('app.unknown');
                }

                $denar = $Arabic->utf8Glyphs(__('app.denar'));
                $img->text('+965' . $ad->phone, 850, 573, function ($font) {
                    $font->file(public_path('Cairo.ttf'));
                    $font->size(30); // 24 best choose
                    $font->color('#000');
                });
                // 620 x 475
                if (intval($ad->price) > 0) {
                    $img->text($ad->price, 950, 430, function ($font) {
                        $font->file(public_path('Cairo.ttf'));
                        $font->size(50); // 24 best choose
                        $font->color('#fff');
                    });
                } else {
                    $img->text($unknown, 920, 430, function ($font) {
                        $font->file(public_path('DroidNaskh-Bold.ttf'));
                        $font->size(30); // 24 best choose
                        $font->color('#fff');
                    });
                }
                // 320
                $img->text($name, 100, 100, function ($font) {
                    if (app()->isLocale('ar')) {
                        $font->file(public_path('DroidNaskh-Bold.ttf'));
                    } else {
                        $font->file(public_path('Cairo.ttf'));
                    }
                    $font->size(24); // 24 best choose
                    $font->color('#000');
                });

                if ($request->hasFile('image')) {
                    $theAdImg = public_path('socialmedia/outputonimage.png');
                    $img->insert($theAdImg, 'bottom-left', 15, 19);
                } else {
                    $theAdImg = public_path('socialmedia/default.png');
                    $img->insert($theAdImg, 'bottom-left', 15, 19);
                }

                $img->save(public_path('images/output.png'));
                // RUN THE JOB
                if (!env('IS_PAYMANT_AVAILABLE')) {
                    $postToSocialMediaImagePath = public_path('images/output.png');
                    // PUBLISH TO TWITTER
                    $forJobPublishment = $Arabic->utf8Glyphs($ad->title);
                    if (app()->isLocale('ar')) {
                        // dd($ad->title, $postToSocialMediaImagePath);
                        SocialMediaJob::dispatch('', $postToSocialMediaImagePath);
                        // PUBLISH TO FACEBOOK
                        SocialFacebookJob::dispatch($forJobPublishment, $postToSocialMediaImagePath);
                    } else {
                        // dd($ad->title, $postToSocialMediaImagePath);
                        SocialMediaJob::dispatch($ad->title, $postToSocialMediaImagePath);
                        // PUBLISH TO FACEBOOK
                        SocialFacebookJob::dispatch($ad->title, $postToSocialMediaImagePath);
                    }

                }
            }
        } catch (\Exception $exception){}
        return $this->success([$this->formatAd($ad)] , __('app.data_created') );
    }
}
