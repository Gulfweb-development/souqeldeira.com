<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\Ad;
use App\Models\Region;
use App\Models\BuildingType;
use App\Models\Image;
use Log;

class SyncController extends Controller
{
    public function syncimage($url,$id){
        if(!empty($url) && !empty($id)){
        $allowedExtensions = ['jpeg', 'png', 'jpg'];
        $path = public_path('uploads');

        $fileName  = basename($url);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        if(array_search($extension, $allowedExtensions) === false) {
            throw new \Exception($extension .' is not allowed');
        }
        if(file_exists($path . $fileName)) {
            throw new \Exception('File exists');
        }

        $ch = curl_init($url);
        $fp = fopen($path .'/'. $fileName, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $image = new Image;
        $image->imageable_type = 'App\Models\Ad';
        $image->imageable_id   = $id;
        $image->name           = $fileName;
        $image->url            = 'uploads/'.$fileName;
        $image->group_name     = 'default';
        $image->save();
        }
    }

    //collect data from hook
    public function sync(Request $request){
        Log::info("syn started 00");
     if(
        !empty($request->title) &&
        !empty($request->details) &&
        !empty($request->area) &&
        !empty($request->type) &&
        !empty($request->propertytype)
        ){
        Log::info("syn started 11");
        $explodearea = explode(",",$request->area);
        if(count($explodearea)>1){
        for($i=0;$i<count($explodearea);$i++){
        if(!empty($explodearea[$i])){
        $regionDetails = $this->getRegionId($explodearea[$i]);
        $propertyId    = $this->getBuildingTypeId($request->propertytype);

        $ad = new Ad;
        $ad->user_id          = 77; //default user
        $ad->governorate_id   = $regionDetails['governorate_id'];
        $ad->region_id        = $regionDetails['region_id'];
        $ad->building_type_id = $propertyId;
        $ad->type             = $this->TypeName($request->type);
        $ad->title            = $request->title;
        $ad->text             = $request->details;
        $ad->price            = $request->price??0;
        $ad->views            = 1;
        $ad->phone            = $request->phone;
        $ad->code             = Str::random(6);;
        $ad->archived_at      = Carbon::now('UTC')->addDays(config('app.ad_expire_day' , 15))->format('Y-m-d H:i:s');;
        $ad->is_featured      = 0;
        $ad->is_approved      = 1;
        $ad->save();
        if(!empty($request->url)){
        $this->syncimage($request->url,$ad->id);
        }

        }
        }
        }else{
            $regionDetails = $this->getRegionId($request->area);
            $propertyId    = $this->getBuildingTypeId($request->propertytype);

            $ad = new Ad;
            $ad->user_id          = 77; //default user
            $ad->governorate_id   = $regionDetails['governorate_id'];
            $ad->region_id        = $regionDetails['region_id'];
            $ad->building_type_id = $propertyId;
            $ad->type             = $this->TypeName($request->type);
            $ad->title            = $request->title;
            $ad->text             = $request->details;
            $ad->price            = $request->price??0;
            $ad->views            = 1;
            $ad->phone            = $request->phone;
            $ad->code             = Str::random(6);;
            $ad->archived_at      = Carbon::now('UTC')->addDays(config('app.ad_expire_day' , 15))->format('Y-m-d H:i:s');;
            $ad->is_featured      = 0;
            $ad->is_approved      = 1;
            $ad->save();
            if(!empty($request->url)){
            $this->syncimage($request->url,$ad->id);
            }

        }
        }
    }

    function getRegionId($regionName){
    $region = Region::where('name_ar','=',$regionName)->first();
    if(!empty($region->id)){
    Log::info("Region Id = ".$region->id."-".$regionName);
    return ["region_id"=>$region->id,"governorate_id"=>$region->governorate_id];
    }
    return ["region_id"=>0,"governorate_id"=>0];
    }

    function getBuildingTypeId($propertyname){
    $region = BuildingType::where('name_ar','=',$propertyname)->first();
    if(!empty($region->id)){
    return $region->id;
    }
    return 0;
    }

    function TypeName($id){
     $txt = '';
     if($id==1){
     $txt = 'RENT';
     }else if($id==2){
     $txt = 'EXCHANGE';
     }else if($id==3){
     $txt = 'SALE';
     }else if($id==4){
     $txt = 'BUY';
     }
     return $txt;
    }
}
