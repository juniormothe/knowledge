<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Pagination
{
    public function paginationView($numPag)
    {
        $pg = $this->verificPg();
        $arrayUrl = GETT;
        unset($arrayUrl['route']);
        if (isset($arrayUrl['pg'])) {
            unset($arrayUrl['pg']);
        }
        if (!empty($arrayUrl)) {
            $searchUrl = "";
            foreach ($arrayUrl as $key => $value) {
                $searchUrl .= "&" . $key . "=" . $value;
            }
            $searchUrl = "?" . substr($searchUrl, 1) . "&pg=";
        } else {
            $searchUrl = "?pg=";
        }
        $pgStart = 1;
        $pgBack = ($pg - 1);
        if ($pgBack < 1) {
            $pgBack = 1;
        }
        $pgNext = ($pg + 1);
        if ($pgNext > $numPag) {
            $pgNext = $numPag;
        }
        $pgLast = $numPag;
        if ($numPag > 0) {
            return '
            <div class="col-lg-12 text-center">
            <ul class="pagination justify-content-center" style="margin: 0px">
            <li class="page-item"><a class="page-link pagination" href="' . $searchUrl . $pgStart . '">'.classGoogleIcon('eac3', 'xs').'</a></li>
            <li class="page-item"><a class="page-link pagination" href="' . $searchUrl . $pgBack . '">'.classGoogleIcon('e314', 'xs').'</a></li>
            <li class="page-item"><a class="page-link pagination" href="' . $searchUrl . $pg . '">' . $pg . ' de ' . $numPag . '</a></li>
            <li class="page-item"><a class="page-link pagination" href="' . $searchUrl . $pgNext . '">'.classGoogleIcon('e315', 'xs').'</a></li>
            <li class="page-item"><a class="page-link pagination" href="' . $searchUrl . $pgLast . '">'.classGoogleIcon('eac9', 'xs').'</a></li>
            </ul>
            </div>
            ';
        } else {
            return '
            <div class="col-lg-12 text-center">
            <ul class="pagination justify-content-center" style="margin: 0px;">
            <li class="page-item disabled"><a class="page-link" href="#">'.classGoogleIcon('eac3', 'xs').'</a></li>
            <li class="page-item disabled"><a class="page-link" href="#">'.classGoogleIcon('e314', 'xs').'</a></li>
            <li class="page-item disabled"><a class="page-link" href="#">0</a></li>
            <li class="page-item disabled"><a class="page-link" href="#">'.classGoogleIcon('e315', 'xs').'</a></li>
            <li class="page-item disabled"><a class="page-link" href="#">'.classGoogleIcon('eac9', 'xs').'</a></li>
            </ul>
            </div>
            ';
        }
    }

    public function verificPg()
    {
        $urlGet = GETT;
        if (!isset($urlGet['pg'])) {
            return 1;
        } else {
            if ($urlGet['pg'] < 1) {
                return 1;
            } else {
                return $urlGet['pg'];
            }
        }
    }
}