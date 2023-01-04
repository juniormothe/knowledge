<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class SqlInjection
{
    public function treat($value, $type)
    {
        if ($type == 1) {
            return $this->alnum($value);
        } elseif ($type == 2) {
            return $this->alpha($value);
        } elseif ($type == 3) {
            return preg_replace('/[^0-9]/', '', $value);
        } else {
            return $this->alnum($value);
        }
    }

    private function alnum($value)
    {
        $format['a'] = '"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $format['b'] = '--------------------------------';
        $value = strtr($value, $format['a'], $format['b']);
        $value = str_replace(array('-----', '----', '---', '--'), '-', $value);
        $value = str_replace('-', ' ', $value);
        return $value;
    }

    private function alpha($value)
    {
        $format['a'] = '0123456789';
        $format['b'] = '----------';
        $value = strtr($this->alnum($value), $format['a'], $format['b']);
        $value = str_replace(array('-----', '----', '---', '--'), '-', $value);
        $value = str_replace('-', ' ', $value);
        return $value;
    }
}
