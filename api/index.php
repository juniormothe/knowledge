<?php
session_start();
ob_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

require './core/Config.php';
require './vendor/autoload.php';

$page = new Core\ConfigController();

$page->loadPage();

