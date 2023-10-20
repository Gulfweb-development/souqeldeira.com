<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @param mixed $data
     * @param ?string $message
     * @return JsonResponse
     */
    protected function success($data = [] , $message ="success"){
        return response()->json(['status' => true , 'message' => $message , 'data' => $data]);
    }
    /**
     * @param mixed $data
     * @param ?string $message
     * @return JsonResponse
     */
    protected function error($code = 400, $message ="success" , $data = [] ){
        return response()->json(['status' => false , 'message' => $message , 'data' => $data] , $code);
    }
}
