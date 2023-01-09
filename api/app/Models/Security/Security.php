<?php

namespace App\Models\Security;

if (!defined('URL')) {
    header("Location: ../../../Erro");
    exit();
}
/**
 * @copyright (c) 2022, Junior Silva
 */
class Security
{
    function __construct()
    {
        $this->checkSession();
        $this->hashLogin();
        $this->checkForm();
        $this->accessRelease();
    }

    private function checkSession()
    {
        if (!isset($_SESSION['logged'])) {
            $_SESSION['logged'] = NULL;
        }
        if (empty($_SESSION['logged'])) {
            if (MENU <> 'login') {
                header('Location: ' . URL . "login");
            }
        }
    }

    private function hashLogin()
    {
        if (MENU <> 'login') {
            if (!empty($_SESSION['logged'])) {
                $Read = new \App\Models\Helpers\Read();
                $Read->fullRead("SELECT id FROM users WHERE (id={$_SESSION['logged']['id']}) AND (hash_login={$_SESSION['logged']['hash_login']})");
                if (!$Read->getResultado()) {
                    $Notification = new \App\Models\Helpers\Notification();
                    $Notification->notificacao("Até logo! Outro acesso foi detectado", 2, "warning", URL . "login");
                }
            }
        }
    }

    private function checkForm()
    {
        if (MENU <> 'login') {
            if (!empty(POSTT)) {
                if (isset(POSTT['hash'])) {
                    if (!empty(POSTT['hash'])) {
                        if (POSTT['hash'] <> $_SESSION['logged']['hash']) {
                            $Notification = new \App\Models\Helpers\Notification();
                            $Notification->notificacao("Atenção! Violação no protocolo de segurança. invalid-hash", 2, "danger", URL_ATUAL);
                        }
                    } else {
                        $Notification = new \App\Models\Helpers\Notification();
                        $Notification->notificacao("Atenção! Violação no protocolo de segurança. empty-hash", 2, "danger", URL_ATUAL);;
                    }
                } else {
                    $Notification = new \App\Models\Helpers\Notification();
                    $Notification->notificacao("Atenção! Violação no protocolo de segurança. no-hash", 2, "danger", URL_ATUAL);
                }
            }
        }
    }

    private function accessRelease()
    {
        if (MENU <> 'login') {
            if ($_SESSION['logged']['type'] > 1) {
                $Read = new \App\Models\Helpers\Read();
                $Read->fullRead("SELECT access FROM users WHERE (id='{$_SESSION['logged']['id']}') LIMIT 1");
                $_SESSION['logged']['access'] = $Read->getResultado();
                $_SESSION['logged']['access'] = $_SESSION['logged']['access'][0]['access'];
                if (in_array(MENU, ['patients', 'professionals', 'company', 'procedures', 'scale', 'production', 'payroll', 'financial'])) {
                    if (!in_array(MENU, explode(',', $_SESSION['logged']['access']))) {
                        $Notification = new \App\Models\Helpers\Notification();
                        $Notification->notificacao("Usuário não possui permissão para acessar este módulo", 2, "warning", URL);
                    }
                }
            }
        }
    }
}
