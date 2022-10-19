<?php

namespace Classe;

use SimpleXMLElement;

function arrayXml($data, &$dataXml)
{
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            if (is_numeric($key)) {
                $key = "item" . $key;
            }
            $subNode = $dataXml->addChild($key);
            arrayXml($value, $subNode);
        } else {
            if (is_numeric($key)) {
                $key = "item" . $key;
            }
            $dataXml->addChild($key, htmlspecialchars($value));
        }
    }
}

/**
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Xml
{
    public function arrayToXml($name, $array)
    {
        $xml = new SimpleXMLElement('<' . $name . '/>');
        arrayXml($array, $xml);
        return $xml->asXML();
    }

    public function xmlToArray(int $type, $xml)
    {
        if ($type < 1) {
            $type = 1; // string
        } elseif ($type > 2) {
            $type = 2; // file
        }
        if ($type == 1) {
            return simplexml_load_string($xml);
        } elseif ($type == 2) {
            return simplexml_load_file($xml);
        } else {
            return simplexml_load_string($xml);
        }
    }
}
