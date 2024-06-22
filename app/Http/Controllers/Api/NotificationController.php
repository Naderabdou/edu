<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendWebNotification;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NotificationRequest;
use App\Http\Resources\Api\NotificationResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class NotificationController extends Controller
{
    use ApiResponseTrait;
    public function __construct()
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {

            $this->middleware('auth:sanctum')->except('index', 'deleteNotification', 'deleteAllNotifications');
        }
    }


    public function index()
    {
        $user = auth()->user();

        $notifications = $user->notifications()->get();

        return $this->ApiResponse(NotificationResource::collection($notifications), 'success', 200);
    }


    public function deleteNotification($id)
    {

        $notify = auth()->user()->notifications()->find($id);
        if (!$notify) {
            return $this->notFoundResponse();
        }

        $notify->delete();

        return $this->ApiResponse(null, transWord('Delete Notification Successfully'), 200);
    }

    public function deleteAllNotifications()
    {
        $notifications = auth()->user()->notifications;

        if (!$notifications->isNotEmpty()) {
            return $this->ApiResponse(null, transWord('No Notifications'), 200);
        }

        auth()->user()->notifications()->delete();

        return $this->ApiResponse(null, transWord('Delete All Notifications Successfully'), 200);
    }

    public function countNotification()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $count = $user->unreadNotifications->count();
        } else {
            $count = 0;
        }


        return $this->ApiResponse(['count' => $count], 'success', 200);
    }

    public function sendNotification(NotificationRequest $request)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
            // 'photo'   => $request->photo,
        ];


        $users = User::role('student')
            ->whereHas('firebase_tokens')
            ->chunk(50, function ($users) use ($data) {

                SendWebNotification::dispatch($users, $data);
            });
            return $this->ApiResponse(
                null,
                transWord('Notification Sent Successfully'),
                200

            );
            //   Notification::send($users, new AppNotification($data));

        ;
    }

    // public function markAsRead()
    // {
    //     $user = auth()->user();
    //     $user->unreadNotifications->markAsRead();

    //     return $this->ApiResponse(null, 'success', 200);
    // }

    // public function markAsUnread()
    // {
    //     $user = auth()->user();
    //     $user->readNotifications->markAsUnread();

    //     return $this->ApiResponse(null, 'success', 200);
    // }

    // public function markAsReadNotification($id)
    // {
    //     $notify = auth()->user()->notifications()->find($id);
    //     if (!$notify) {
    //         return $this->notFoundResponse();
    //     }

    //     $notify->markAsRead();

    //     return $this->ApiResponse(null, transWord('Mark As Read Notification Successfully'), 200);
    // }


    public function user()
    {

        $user = auth()->user()->hasRole('instructor') ? auth()->user() : null;

        return $user;
    }

    private function getUserOrError()
    {
        $user = $this->user(); // Get the authenticated user
        if (empty($user)) {
            return $this->ApiResponse(null, transWord('هذا المستخدم ليس مدرب'), 401);
        }
        return $user;
    }
}
