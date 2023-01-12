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

            $this->url = $this->checkRoutes($this->url);

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
        define('CONTROLLER', $this->urlController);
        define('METHOD', $this->urlMetodo);
        define('IDENTIFIER', $this->urlIdentificador);
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

    public function checkRoutes($url)
    {
        global $routes;
        foreach ($routes as $pt => $newurl) {
            // Identifica os argumentos e substitui por regex
            $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $pt);
            // Faz o match da URL
            if (preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1) {
                array_shift($matches);
                array_shift($matches);
                // Pega todos os argumentos para associar
                $itens = array();
                if (preg_match_all('(\{[a-z0-9]{1,}\})', $pt, $m)) {
                    $itens = preg_replace('(\{|\})', '', $m[0]);
                }
                // Faz a associação
                $arg = array();
                foreach ($matches as $key => $match) {
                    $arg[$itens[$key]] = $match;
                }
                // Monta a nova url
                foreach ($arg as $argkey => $argvalue) {
                    $newurl = str_replace(':' . $argkey, $argvalue, $newurl);
                }
                $url = $newurl;
                break;
            }
        }
        return $url;
    }
}
