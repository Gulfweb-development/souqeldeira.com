<?php

namespace App\Http\Controllers\Api\Advertise;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Favorite;
use App\Services\FavoritesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdvertiseController extends Controller
{
    private function formatAuthor($user)
    {
        $user = optional($user);
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => toProfileDefaultImage($user->getFile() , 'images/company_default.jpg'),
            'is_agency' => $user->is_approved and $user->type == "COMPANY" ,
            'agency_link' => $user->is_approved and $user->type == "COMPANY" ?  route('agency.ads',[toSlug($user->name),$user->id]) : null ,
        ];
    }
    private function formatAd($ad , $deleteUseless = false)
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
                        'author'=> $this->formatAuthor($comment->user),
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
            'author'=> $this->formatAuthor($ad->user),
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
                ->get()->transform(function ($item) { return $this->formatAd($item , true) ;} ) : [],
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
}
