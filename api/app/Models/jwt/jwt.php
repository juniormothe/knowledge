<?php

namespace App\Models\jwt;

use App\Models\jwt\security\key;

class jwt extends key
{
    private $key;
    private $arrayKey;

    public function __construct()
    {
        $this->key = $this->securitykey(1);
        $this->arrayKey = $this->securitykey(2);
    }

    public function create(array $dataJson)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $dataJson['iss'] = $_SERVER['HTTP_HOST'];
        $dataJson['iat'] = strtotime(date('Y-m-d'));
        if (isset($dataJson['exp'])) {
            $dataJson['exp'] = strtotime($dataJson['exp']);
        }
        $dataJson['key_reference'] = count($this->arrayKey);
        $playload = json_encode($dataJson);
        $signature = hash_hmac(
            "sha256",
            $this->base64url_encode($header) . "." . $this->base64url_encode($playload),
            $this->key,
            TRUE
        );
        $jwt = $this->base64url_encode($header) . "." . $this->base64url_encode($playload) . "." . $this->base64url_encode($signature);
        return $jwt;
    }

    public function validate($jwt)
    {
        if ($this->checkSplit($jwt)) {
            $token = explode('.', $jwt);
            $dataJson = json_decode($this->base64url_decode($token[1]), true);
            if (isset($dataJson['key_reference'])) {
                $signatureValidate = hash_hmac(
                    "sha256",
                    $token[0] . "." . $token[1],
                    $this->arrayKey[$dataJson['key_reference']]['key'],
                    TRUE
                );
                if ($this->base64url_encode($signatureValidate) == $token[2]) {
                    unset($dataJson['key_reference']);
                    return $dataJson;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function validateArchive($jwt)
    {
    }

    private function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private  function base64url_decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/') . str_repeat('=', 3 - (3 + strlen($data)) % 4));
    }

    private function checkSplit($jwt)
    {
        if (count(explode('.', $jwt)) == 3) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
