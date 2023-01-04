<?php
session_start();
ob_start();
require './core/Config.php';
require './core/GlobalFunctions.php';
require './vendor/autoload.php';

$page = new Core\ConfigController();

$page->loadPage();

