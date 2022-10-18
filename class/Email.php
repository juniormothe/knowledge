<?php

namespace Classe;

/**
 * @copyright (c) 2022, Junior Silva
 */
class Email
{
    public function send($dataForm, $to)
    {
        $send = $this->treatSend($dataForm, $to);
        var_dump($send);

        //mail($send['to'], $send['subject'], $send['message'], $send['header']);
    }

    public function sendPhpMailer($dataForm, $to)
    {
    }

    private function treatSend($dataForm, $to)
    {
        $sender = $dataForm['email'];
        $treatSend['to'] = $to;
        $treatSend['subject'] = $dataForm['subject'];
        $treatSend['message'] = $dataForm['message'];
        $treatSend['header'][] = 'MIME-Version: 1.0';
        $treatSend['header'][] = 'Content-type: text/html; charset=iso-8859-1';
        $treatSend['header'][] = 'From: Name <' . $treatSend['to'] . '>';
        $treatSend['header'][] = 'Reply-To: ' . $sender;
        $treatSend['header'][] = 'X-Mailer: PHP/' . phpversion();
        $treatSend['header'] = implode("\r\n", $treatSend['header']);
        return $treatSend;
    }

    private function treatSendPhpMailer()
    {
    }

    private function treatMessage($message)
    {
    }
}
