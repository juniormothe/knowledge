<?php

namespace Core;

class ConfigController
{
    private $url;
    private $urlArray;
    private $urlController;
    private $urlMetodo;
    private $urlIdentificador;

    public function __construct()
    {
        if (!empty(filter_input(INPUT_GET, 'route', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'route', FILTER_DEFAULT);
            $this->urlArray = explode('/', $this->url);

            if (!isset($this->urlArray[0])) {
                $this->urlArray[0] = "home";
            }
            if (!isset($this->urlArray[1])) {
                $this->urlArray[1] = "index";
            }
            if (!isset($this->urlArray[2])) {
                $this->urlArray[2] = "";
            }
            $this->urlController = $this->urlArray[0];
            $this->urlMetodo = $this->urlArray[1];
            $this->urlIdentificador = $this->urlArray[2];
        } else {
            $this->urlController = "home";
            $this->urlMetodo = "index";
            $this->urlIdentificador = "";
        }
        define('MENU', strtolower($this->urlController));
        define('MENU_CONTENT', strtolower($this->urlMetodo));
        define('VIEW', $this->urlIdentificador);
    }

    public function loadPage()
    {
        $slug = new \App\Models\Helpers\Slug();
        $urlController = ucwords($slug->nomeSlug($this->urlController));
        $urlMetodo = $slug->nomeSlug($this->urlMetodo);
        $classLoad = "\\App\Controllers\\" . $urlController;

        if (!class_exists($classLoad)) {
            $classLoad = "\\App\Controllers\Erro";
        }

        $classPag = new $classLoad;

        if (method_exists($classLoad, $urlMetodo)) {
            $classPag->$urlMetodo($this->urlIdentificador);
        } else {
            $classPag->index($this->urlIdentificador);
        }
    }
}
