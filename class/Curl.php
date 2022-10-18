<?php

namespace Classe;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Curl
{
    public function test()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://swapi.dev/api/films/1/");
        //curl_setopt($curl, CURLOPT_POST, 1);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, "nome=Junior&sexo=1&idade=37");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $return = json_decode(curl_exec($curl));
        curl_close($curl);
        //
        echo "<pre>";
        var_dump($return);
        echo "</pre>";
    }
}
