<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function notification(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'device_token'=>'required',
                'title'=>'required',
                'body'=>'required'
            ));
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token = $request->device_token;
        $notification = [
            'title' => $request->title,
            'body' => $request->desc,
            'sound' => true,
        ];
        $extraNotificationData = ["message" => 'Just Some EXTRAS'];
        $fcmNotification = [
            //'registration_ids' => $tokenList, //multiple token array
            'to' => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AIzaSyA6233uaQZxqFsTYgSjHZ_0QbRex-mOQ0g',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return response()->json(['data' => 'notification sent', 'action' => $result], 200);
    }
}
