<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class CheckDataBase
{
    public function emptyDataBase($table, $nameColumn, $valueColumn, $url)
    {
        $Read = new \App\Models\Helpers\Read();
        $Read->fullRead("SELECT {$nameColumn} FROM {$table} WHERE ({$nameColumn}='{$valueColumn}')");
        if (empty($Read->getResultado())) {
            header('Location: ' . $url);
        }
    }
}
