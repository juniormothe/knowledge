<?php

class JWT
{
    private $secret;

    public function __construct()
    {
        $this->secret = "ChaveSecreta123";
    }

    public function create()
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        $playload = json_encode(['id_user' => 123]);

        $signature = hash_hmac(
            "sha256",
            $this->base64url_encode($header) . "." . $this->base64url_encode($playload),
            $this->secret,
            TRUE
        );

        $jwt = $this->base64url_encode($header) . "." . $this->base64url_encode($playload) . "." . $this->base64url_encode($signature);

        return $jwt;
    }

    public function validate($jwt)
    {
        if ($this->checkSplit($jwt)) {

            $token = explode('.', $jwt);

            $signatureValidate = hash_hmac(
                "sha256",
                $token[0] . "." . $token[1],
                $this->secret,
                TRUE
            );

            if ($this->base64url_encode($signatureValidate) == $token[2]) {
                return json_decode($this->base64url_decode($token[1]));
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
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
