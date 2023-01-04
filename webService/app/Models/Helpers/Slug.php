<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Slug
{
    private $Nome;
    private $Formato;

    public function nomeSlug($Nome)
    {
        $this->Nome = (string) $Nome;
        $this->Formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->Formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';

        $this->Nome = strtr(utf8_decode($this->Nome), utf8_decode($this->Formato['a']), $this->Formato['b']);
        $this->Nome = strip_tags($this->Nome);

        $this->Nome = str_replace(' ', '-', $this->Nome);

        $this->Nome = str_replace(array('-----', '----', '---', '--'), '-', $this->Nome);

        $this->Nome = strtolower($this->Nome);

        return $this->Nome;
    }

}
