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
        if ( $message == "success")
            $message = trans('success');
        return response()->json(['status' => true , 'message' => $message , 'data' => $data , 'errors' => []]);
    }

    /**
     * @param int $code
     * @param ?string $message
     * @param array $errors
     * @param mixed $data
     * @return JsonResponse
     */
    protected function error($code = 400, $message ="error" , $errors = [], $data = [] ){
        if ( $message == "error")
            $message = trans('failed');
        return response()->json(['status' => false , 'message' => $message , 'data' => $data , 'errors' => $errors] , $code);
    }

    protected function paginationFormat($paginateObject , $callback){
        $paginateObject->setCollection( $paginateObject->getCollection()->transform(function ($item) use($callback) {
            return $callback($item);
        }));
        $paginateObject = $paginateObject->toArray();
        unset($paginateObject['first_page_url'],$paginateObject['last_page_url'],$paginateObject['links'],$paginateObject['next_page_url'],$paginateObject['path'],$paginateObject['prev_page_url']);
        return $paginateObject;
    }
}
