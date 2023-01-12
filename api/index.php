<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

require './core/Config.php';
require './core/Routers.php';
require './vendor/autoload.php';

$page = new Core\ConfigController();

$page->loadPage();

