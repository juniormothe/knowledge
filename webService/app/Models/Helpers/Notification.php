<?php

namespace App\Models\Helpers;

/**
 * @copyright (c) 2022, Junior Silva
 * position (top-left, top-center, top-right, bottom-left, bottom-center, bottom-right)
 */
class Notification
{
    private $location;

    public function setterLocation($location)
    {
        $this->location = $location;
    }

    public function notificacao($texto, $cont, $background = null, $redirect = null)
    {
        unset($_SESSION['notification']);
        unset($_SESSION['notificationCont']);

        $_SESSION['notification'] = "<script>
        const notification = new Notification({
          text: '{$texto}',
          showProgress: false,
          autoClose: 5000,
          position: 'top-{$this->treatLocation()}',
          style: {
            background: '{$this->background($background)}',
            color: '#FFFFFF',
          },
        });
        </script>";
        $_SESSION['notificationCont']   = $cont;

        if (!empty($redirect)) {
            header("Location:" . $redirect);
        }
    }

    public function notificacaoBottom()
    {
        if (isset($_SESSION['notification'])) {
            echo $_SESSION['notification'];
            $_SESSION['notificationCont'] = ($_SESSION['notificationCont'] - 1);
            if ($_SESSION['notificationCont'] < 1) {
                unset($_SESSION['notification']);
                unset($_SESSION['notificationCont']);
            }
        }
    }

    private function background($background = null)
    {
        if (empty($background)) {
            $background = "secondary";
        }
        switch ($background) {
            case 'primary':
                return '#007AFF';
                break;
            case 'secondary':
                return '#6C757E';
                break;
            case 'success':
                return '#27A844';
                break;
            case 'danger':
                return '#DC3546';
                break;
            case 'warning':
                return '#FEC107';
                break;
            case 'info':
                return '#17A2B7';
                break;
            default:
                return '#6C757E';
                break;
        }
    }

    private function treatLocation()
    {
        if (empty($this->location)) {
            return "center";
        } else {
            $this->location = strtolower($this->location);
            $this->location = str_replace(" ", "", $this->location);
            if (($this->location == "center") or ($this->location == "left") or ($this->location == "right")) {
                return $this->location;
            } else {
                return "center";
            }
        }
    }
}
