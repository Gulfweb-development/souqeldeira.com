<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Mail\Forget;
use App\Models\ContactUser;
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
    public function notificationsView(Request $request){
        $userMessage = UserMessage::query()->where('user_id', user()->id)->where('id', $request->get('id'))->firstOrFail();
        foreach (user()->unReadNotifications as $notification) {
            if ($notification->data['id'] == $request->get('id') && $notification->data['type'] == 'FROM_ADMIN') {
                $notification->markAsRead();
            }
        }
        return $this->success(['messages' =>[
                'id' => $userMessage->id,
                'title' => $userMessage->translate('title'),
                'message' => $userMessage->translate('message'),
                'created_at' => [
                    'system' => $userMessage->created_at,
                    'human' => $userMessage->created_at->diffForHumans(),
                ]
            ]
        ]);
    }
    public function messages(Request $request){
        $messages = ContactUser::query()->where('user_to', user()->id)->latest()->paginate($request->get('per_page'));
        $messages = $this->paginationFormat($messages , function ($item) {
            return [
                'id' => $item->id,
                'has_author' => optional($item->user)->id > 0 ,
                'author' => [
                    'id' => optional($item->user)->id,
                    'name' => optional($item->user)->name,
                    'avatar' => toProfileDefaultImage(optional($item->user)->getFile() , 'images/company_default.jpg'),
                    'is_agency' => optional($item->user)->is_approved and optional($item->user)->type == "COMPANY" ,
                    'agency_link' => optional($item->user)->is_approved and optional($item->user)->type == "COMPANY" ?  route('agency.ads',[toSlug(optional($item->user)->name),optional($item->user)->id]) : null ,
                ],
                'created_at' => [
                    'system' => $item->created_at,
                    'human' => $item->created_at->diffForHumans(),
                ],
            ];
        });
        return $this->success(['messages' => $messages]);
    }
    public function messagesDelete(Request $request){
        $userMessage = ContactUser::query()->where('user_to', user()->id)->where('id', $request->get('id'))->firstOrFail();
        $userMessage->delete();
        return $this->success([] , __('app.data_deleted'));
    }
    public function messagesView(Request $request){
        $userMessage = ContactUser::query()->where('user_to', user()->id)->where('id', $request->get('id'))->firstOrFail();
        foreach (user()->unReadNotifications as $notification) {
            if ($notification->data['id'] == $request->get('id') && $notification->data['type'] == 'FROM_USER_AD') {
                $notification->markAsRead();
            }
        }
        return $this->success(['messages' =>[
                'id' => $userMessage->id,
                'message' => $userMessage->text,
                'has_author' => optional($userMessage->user)->id > 0 ,
                'author' => [
                    'id' => optional($userMessage->user)->id,
                    'name' => optional($userMessage->user)->name,
                    'avatar' => toProfileDefaultImage(optional($userMessage->user)->getFile() , 'images/company_default.jpg'),
                    'is_agency' => optional($userMessage->user)->is_approved and optional($userMessage->user)->type == "COMPANY" ,
                    'agency_link' => optional($userMessage->user)->is_approved and optional($userMessage->user)->type == "COMPANY" ?  route('agency.ads',[toSlug(optional($userMessage->user)->name),optional($userMessage->user)->id]) : null ,
                ],
                'created_at' => [
                    'system' => $userMessage->created_at,
                    'human' => $userMessage->created_at->diffForHumans(),
                ]
            ]
        ]);
    }
}
