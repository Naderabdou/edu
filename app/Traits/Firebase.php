<?php

namespace App\Traits;

trait Firebase
{

    public function sendFcmNotification($tokens, $data, $lang = 'ar')
    {

        $SERVER_API_KEY = 'AAAA7yNQoJA:APA91bEj3ct09UZCqQ3x1cUqAyM7_7cpnQ3h8-RaMhKJZKrQrTmpmptTNtCUAhhg9Tl4tUDZSMUOidKR56f4bw6FzS21OshzfIrq_sYWn9852WG1M_FjRI0M-VWsa5gisoU0iGxP1lI3';
      //  dd($data);

        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title"    => $this->getTitle($data,  $lang),
                "body"     => $this->getBody($data,  $lang),
                "mutable_content" => true,
                'sound'    => true,
            ],
            // 'data'  => isset($data->url) ? $data->url : ''
        ];
        $dataString = json_encode($data);


        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);

      //   dd($response);
    }

    public function getTitle(array $data, $local = 'ar')
    {
        return $data['name_' . $local];
    }

    public function getBody(array $data, $local = 'ar')
    {
        return  $data['body_' . $local];
    }
}
