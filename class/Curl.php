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
                'SecretKey: AVAILABLE_IN_API',
                'PublicToken: AVAILABLE_IN_API',
                'DeviceToken: AVAILABLE_IN_API',
                'Authorization: Bearer AVAILABLE_IN_API'
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
