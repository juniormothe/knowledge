<?php
spl_autoload_register(function ($class) {
    $load = explode('\\', $class);
    if ($load[0] == "Classe") {
        $load[0] = "class";
    }
    $load = implode('/', $load);
    require $load . ".php";
});
