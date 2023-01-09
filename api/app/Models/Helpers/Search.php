<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Search
{
    public function linkSearch()
    {
        $linkSearch = $this->treatSearch();
        return $linkSearch['link'];
    }

    public function treatSearch()
    {
        $treatSearchArray = GETT;
        unset($treatSearchArray['route']);
        $treatSearchArray['link'] = $this->treatSearchLink($treatSearchArray);
        return $treatSearchArray;
    }

    public function activeButtonSearch($dataGet)
    {
        $activeButtonSearch = explode('&', $dataGet);
        $activeButtonSearchCont = 0;
        foreach ($activeButtonSearch as $valueactiveButtonSearch) {
            if (isset(GETT[$valueactiveButtonSearch])) {
                $activeButtonSearchCont++;
            }
        }
        if ($activeButtonSearchCont > 0) {
            return 'active';
        }
    }

    public function clearSearch($dataGet, $url)
    {
        if (!empty($this->activeButtonSearch($dataGet))) {
            return '<a title="Limpar busca" class="btn btn-outline-secondary micro-button" href="' . $url . '" role="button">' . classGoogleIcon('e760', 'xs') . '</a>';
        }
    }

    public function dispayInputText($name, $empty = null)
    {
        if (isset(GETT[$name])) {
            return GETT[$name];
        } elseif (!empty($empty)) {
            return $empty;
        }
    }

    public function dispaySelected($name, $value, $empty = null)
    {
        if (isset(GETT[$name])) {
            if ("" . strval(GETT[$name]) . "" == "" . strval($value) . "") {
                return "selected";
            }
        } else {
            if (strlen($empty) > 0) {
                if ("" . strval($value) . "" == "" . strval($empty) . "") {
                    return "selected";
                }
            }
        }
    }

    public function dispayChecked($name, $value, $empty = null)
    {
        if (isset(GETT[$name])) {
            if ("" . strval(GETT[$name]) . "" == "" . strval($value) . "") {
                return "checked";
            }
        } else {
            if (strlen($empty) > 0) {
                if ("" . strval($value) . "" == "" . strval($empty) . "") {
                    return "checked";
                }
            }
        }
    }

    public function linkSecondary($link)
    {
        if (empty($link)) {
            $linkSecondary = "?pg=1";
        } else {
            if (strpos($link, 'page=') == false) {
                if (strpos($link, 'pg=') == false) {
                    $linkSecondary = $link . "&pg=1";
                } else {
                    $linkSecondary = $link;
                }
            } else {
                $linkSecondary = $link;
            }
        }
        return str_replace("pg=", "page=", $linkSecondary);
    }

    public function linkSecondaryReturn($link)
    {
        if (!empty($link)) {
            if (strpos($link, 'page=') !== false) {
                $page = GETT['page'];
                if (strpos($link, '?page') !== false) {
                    $linkSecondaryReturn = "?pg=" . $page;
                } else {
                    if (strpos($link, '&page') !== false) {
                        $link = explode('&page', $link);
                        $linkSecondaryReturn = $link[0] . "&pg=" . $page;;
                    } else {
                        $linkSecondaryReturn = $link;
                    }
                }
            } else {
                $linkSecondaryReturn = $link;
            }
        } else {
            $linkSecondaryReturn = $link;
        }
        return $linkSecondaryReturn;
    }

    public function linkSecondaryAddClose($link, $term)
    {
        $term = explode("&", $term);
        foreach ($term as $valueTerm) {
            if (strpos($link, "&{$valueTerm}=") !== false) {
                $link = explode("&{$valueTerm}=", $link);
                $link = $link[0];
                break;
            }
        }
        return $link;
    }

    public function searchSecondary()
    {
        $searchSecondary = GETT;
        unset($searchSecondary['route']);
        $formInput = "";
        foreach ($searchSecondary as $keySearchSecondary => $valueSearchSecondary) {
            $formInput .= '<input type="hidden" name="' . $keySearchSecondary . '" value="' . $valueSearchSecondary . '">';
            if ($keySearchSecondary == "page") {
                break;
            }
        }
        return $formInput;
    }

    private function treatSearchLink($dataGet)
    {
        $treatSearchLink = "";
        if (!empty($dataGet)) {
            foreach ($dataGet as $key => $value) {
                $treatSearchLink .= "&" . $key . "=" . $value;
            }
            $treatSearchLink = "?" . substr($treatSearchLink, 1);
        }
        return $treatSearchLink;
    }
}
