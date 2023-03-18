<?php

namespace Classe;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Curl
{
    public function whatsapp($number, $message)
    {
        $shippingData = json_encode([
            'number' => "55" . str_replace([' ', '(', ')', '-'], "", $number),
            'text' => $message
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://cluster.apigratis.com/api/v1/whatsapp/sendText',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '' . $shippingData . '',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'SecretKey: e3b0e4b8-7670-47b6-8543-47f869ccc90e',
                'PublicToken: e101ed3e-f52b-4214-9fd0-a755cbc1f733',
                'DeviceToken: b232b361-b114-4256-a768-a8e6c2dc12ab',
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3BsYXRhZm9ybWEuYXBpYnJhc2lsLmNvbS5ici9zb2NpYWwvZ2l0aHViL2NhbGxiYWNrIiwiaWF0IjoxNjc5MDc2NTU1LCJleHAiOjE3MTA2MTI1NTUsIm5iZiI6MTY3OTA3NjU1NSwianRpIjoiaHZZQ2V3d3V5MXpRUDR6YyIsInN1YiI6IjE2NTAiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.nJ4kuOdrMMrGwdEmIAWlYLB_0i6g9ZWnXbrsYWGKKvs'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, TRUE);

        if (!$result['error']) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
