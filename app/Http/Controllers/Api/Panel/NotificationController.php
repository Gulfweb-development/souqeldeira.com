<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Mail\Forget;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function notifications(Request $request){
        $messages = UserMessage::query()->where('user_id', user()->id)->latest()->paginate($request->get('per_page'));
        $messages = $this->paginationFormat($messages , function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->translate('title'),
                'created_at' => [
                    'system' => $item->created_at,
                    'human' => $item->created_at->diffForHumans(),
                ],
            ];
        });
        return $this->success(['messages' => $messages]);
    }
    public function notificationsDelete(Request $request){
        $userMessage = UserMessage::query()->where('user_id', user()->id)->where('id', $request->get('id'))->firstOrFail();
        $userMessage->delete();
        return $this->success([] , __('app.data_deleted'));
    }
}
