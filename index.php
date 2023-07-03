<?php
require('config/Config.php');
require('function/GlobalFunctions.php');
require('config/Autoload.php');
//////////
require('views/include/header.php');
//////////

/*
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	$uri = 'https://';
} else {
	$uri = 'http://';
}



$Curl = new Classe\Curl();

if ($Curl->whatsapp('(21) 99251-6158', "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . PHP_EOL . "PLATFORM: " . $_SERVER['HTTP_SEC_CH_UA_PLATFORM'] . PHP_EOL . "DOCUMENT: " . $_SERVER['DOCUMENT_ROOT'] . PHP_EOL . "REQUEST TIME: " . $_SERVER['REQUEST_TIME'])) {
    echo "&#10004; Mensagem enviado com sucesso!";
} else {
    echo "&#10008; Erro ao enviar mensagem!";
}
*/

//////////
require('views/include/footer.php');
