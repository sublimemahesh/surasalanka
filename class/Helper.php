<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__FILE__) . '/PHPMailer/src/Exception.php';
require_once dirname(__FILE__) . '/PHPMailer/src/PHPMailer.php';
require_once dirname(__FILE__) . '/PHPMailer/src/SMTP.php';

class Helper
{

    public function randamId()
    {



        $today = time();

        $startDate = date('YmdHi', strtotime('1912-03-14 09:06:00'));

        $range = $today - $startDate;

        $rand = rand(0, $range);

        $randam = $rand . "_" . ($startDate + $rand) . '_' . $today . "_n";

        return $randam;
    }

    public function calImgResize($newHeight, $width, $height)
    {



        $percent = $newHeight / $height;

        $result1 = $percent * 100;



        $result2 = $width * $result1 / 100;



        return array($result2, $newHeight);
    }

    public function getSitePath()
    {

        //        return substr_replace(dirname(__FILE__), '', 26);

        $path = str_replace('class', '', dirname(__FILE__));

        return $path;
    }
    function PHPMailer($sent_from_email, $sent_from_name, $reply_email, $reply_email_name, $recipient_email, $recipient_name, $subject, $message)
    {

        $mail = new PHPMailer(true);
        // var_dump($subject);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                            // Enable verbose debug output
            $mail->isSMTP();                                 // Send using SMTP
            $mail->Host       = DefaultData::Host;           // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                        // Enable SMTP authentication
            $mail->Username   = DefaultData::Username;       // SMTP username
            $mail->Password   = DefaultData::Password;       // SMTP password
            $mail->SMTPSecure = "ssl";                       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = DefaultData::Port;           // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->SMTPOptions = array('ssl' => array(
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true
            ));
            //Recipients
            $mail->setFrom($sent_from_email, $sent_from_name);
            $mail->addAddress($recipient_email, $recipient_name);     // Add a recipient 
            $mail->addReplyTo($reply_email, $reply_email_name);

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    =  $message;

            if (!$mail->send()) {
                dd(!$mail->send());
                return FALSE;
            } else {
                return TRUE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }
}
