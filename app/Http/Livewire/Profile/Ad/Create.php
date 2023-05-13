<?php

namespace App\Http\Livewire\Profile\Ad;

use App\Models\Ad;
use App\Models\Setting;
use Carbon\Carbon;
use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use Illuminate\Support\Str;
use App\Jobs\SocialMediaJob;
use App\Models\BuildingType;
use Livewire\WithFileUploads;
use App\Models\BuildingStatus;
use App\Jobs\SocialFacebookJob;
use App\Services\SocialMediaService;
use Intervention\Image\Facades\Image;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriptions;

class Create extends Component
{
    use WithFileUploads;

    public $governorates = [];
    public $regions = [];
    public $buildingTypes = [];
    public $governorate_id;
    public $is_featured;
    public $region_id;
    public $building_type_id;
    public $image;
    public $type;
    public $phone;
    public $price;
    public $text;
    public $photo;
    public $uploadedImage;

    public function mount()
    {
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
        $this->buildingTypes = BuildingType::all();
    }


    public function updatedPhoto()
    {
        $this->image = $this->photo;
    }

    public function updatedGovernorateId($value)
    {
        $this->regions = Region::select('id', 'governorate_id', toLocale('name'))->where('governorate_id', $value)->get();
    }

    public function store()
    {

        // $img->text($name, 800, 220, function ($font) {
        //     $font->file('fonts/trado.ttf');
        //     $font->size(40);
        //     $font->align('right');
        // });
        // app()->setLocale('en');
        $validatedData = $this->validate([
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
        if (env('ADS_LIMIT') <= user()->ads()->count()) {
            $this->dispatchBrowserEvent('info', ['message' => __('app.you_got_ads_limit_please_remove_some_to_can_ad_more')]);
            return session()->flash('success', __('app.data_created'));
        }
        //  TO PARSE COLLECTED DATA TO TITLE
        $toRegId = Region::select('id', 'governorate_id', toLocale('name'))->where('id', $this->region_id)->firstOrFail();
        $toGovId = Governorate::select('id', toLocale('name'))->where('id', $toRegId->governorate_id)->firstOrFail();
        $this->governorate_id = $toGovId->id;
        $toBuidingTypeId = buildingType::select('id', toLocale('name'))->where('id', $this->building_type_id)->firstOrFail();
        $toType = $this->type == 'SALE' ? __('app.sale') : ($this->type == 'EXCHANGE' ? __('app.exchange') : __('app.rent'));
        // dd($this->text,'kw_phone');
        $ad = Ad::create([
            'governorate_id' => $this->governorate_id,
            'is_featured' => $this->is_featured,
            'region_id' => $this->region_id,
            'building_type_id' => $this->building_type_id,
            'type' => $this->type,
            'title' => Ad::toTitle($toType, $toGovId->translate('name'), $toRegId->translate('name'), $toBuidingTypeId->translate('name')),
            'phone' => $this->phone,
            'price' => $this->price,
            'text' => $this->text,
            'user_id' => user()->id,
            'is_approved' => 1,
            'code' => Str::random(6),
            'archived_at' => Carbon::now('UTC')->addDays(
                $this->is_featured == "1" ? Setting::get('expire_time_premium_adv', 15) : Setting::get('expire_time_adv', 15)
            )->format('Y-m-d H:i:s'),
        ]);

        // RESIZE IMAGE TO PLACEC IT IN IMAGE
        if ($this->image != NULL) {

            // IF USER UPLOADED FILES
            $this->uploadedImage = $ad->uploadFile($this->image);
            //$adImage = Image::make($this->image->path());
            // $adImage->resize(695, 433);
            //$destinationPath = public_path('/socialmedia');
            // $imageName = 'social_media' . '.' . '.png';
            //    $socialImgPath =  $adImage->move($destinationPath, $imageName);
            //$outputOnImage = $adImage->save(public_path('socialmedia/outputonimage.png'));

        } else {
            // DEFAULT IMAGE WITH LOGO
            //$adImage = Image::make('/home/bgnsrfbn/aldeiramarket.com/images/default.png');
            //$outputOnImage = $adImage->save('/home/bgnsrfbn/aldeiramarket.com/socialmedia/outputonimage.png');
        }
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
        if ($this->price != '') {
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

        if ($this->image != NULL) {
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
        // PUBLISH TO TWITTER AND FACEBOOK AND INSTRGRAM
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('profile.ad.index');
    }

    public function render()
    {
        $check = Subscriptions::where('status', 1)->get()->count();
        if ($check > 0) {
            if (\Auth::user()->adv_nurmal_count == 0 && \Auth::user()->adv_star_count == 0) {
                header('Location: ' . url('profile/subscripts'));
            }
        }
        return view('livewire.profile.ad.create')->layout(PROFILE_LAYOUT);
    }
}
