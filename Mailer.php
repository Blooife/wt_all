<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

function send($fromemail, $fromname, $toemail, $toname, $subject, $message)
{
    require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require_once 'vendor/phpmailer/phpmailer/src/Exception.php';

    date_default_timezone_set("Europe/Minsk");
    $mail = new PHPMailer(true); // инициализируем класс
    $mail->Host = 'smtp.yandex.ru'; // SMTP сервер
    $mail->Username = $fromemail; // Логин на почте
    $mail->Password = 'soudwuxosquxvbcf'; // Пароль на почте
   // $mail->Password = 'spinyjvyzrzvkolj';
    $mail->SMTPAuth = true;
    $mail->isSMTP(); // указали, что работаем по протоколу смтп
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; // порт
    $mail->CharSet = "UTF-8";
    $mail->setFrom($fromemail, $fromname); // от кого
    $mail->addAddress($toemail, $toname); // добавляем получателя и отправляем
    $mail->addReplyTo($fromemail, $fromname);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    try {
        if($mail->send()){
            return true;
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
        }
}
?>
