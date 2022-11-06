<?php

use \PHPMailer\PHPMailer\PHPMailer.php;
use \PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

class clsMail{
    private $mail = null;
    function __construct(){
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;

        $this->mail->Username = "pet.hero.tpfinal@gmail.com";
        $this->mail->Password = "slagxhdqwbcxmrvl";
    }

    public function metSend($title, $name, $email, $subject, $bodyHTML){
        $this->mail->setFrom("pet.hero.tpfinal@gmail.com", $title);
        $this->mail->addAddress($email, $name);
        $this->mail->Subject = $subject;
        $this->mail->Body = $bodyHTML;
        $this->mail->isHTML(true);
        $this->mail->CharSet = "UTF-8";

        return $this->mail->send();
    }
}
?>