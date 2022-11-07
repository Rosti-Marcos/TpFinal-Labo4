<?php

namespace Controllers;
require_once ("sendMail/PHPMailer/clsMail.php");
use clsMail as clsMail;

class EmailController{
    private $mailSend;
 
    public function __construct(){
        $this->mailSend = new clsMail();
    }

    public function EmailSender($booking){
        $name = $booking->getUser()->getName();
        $email = $booking->getUser()->getEMail();
        $id = $booking->getId();

        $title = 'Pet Hero!, Booking confirmation';
        $subject = 'Your Pet Hero reservation';

        $bodyHTML = '<h1>"Pet Hero!"</h1> <br> <h2>Ticket coupon</h2> <br> <h3>Hi .<?php echo $name ?>., Once you pay this 50% advance coupon, your booking will be confirmed</h3> <br> <br> <A HREF="http://localhost/TpFinal-Labo4/CreditCard/Payment?id=.<?php echo $id?>.>Acceda al cupon de Pago</A>';
    
    
        $sended = $this->mailSend->metSend($title, $name , $email ,$subject , $bodyHTML);
    
}
}
?>