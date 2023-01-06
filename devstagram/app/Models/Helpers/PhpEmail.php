<?php

namespace App\Models\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/**
 * @copyright (c) 2022, Junior Silva
 */
class PhpEmail
{
    private $Resultados;

    public function emailPhpMailer($dados)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Ativar saída de depuração detalhada
            $mail->isSMTP();                                            //Enviar usando SMTP
            $mail->Host       = 'smtp.example.com';                     //Defina o servidor SMTP para enviar
            $mail->SMTPAuth   = true;                                   //Ativar autenticação SMTP
            $mail->Username   = 'user@example.com';                     //Nome de usuário SMTP
            $mail->Password   = 'secret';                               //Senha SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Ativar criptografia TLS implícita
            $mail->Port       = 465;                                    //Porta TCP para se conectar; use 587 se você definiu `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     //Adicionar um destinatário
            $mail->addAddress('ellen@example.com');               //O nome é opcional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Adicionar Anexos
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Nome opcional

            //Content
            $mail->isHTML(true);                                  //Definir formato de e-mail para HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if($mail->send()){
                echo 'E-mail enviado com sucesso!';
            }else{
                echo 'Erro! e-mail não enviado.';
            }

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
