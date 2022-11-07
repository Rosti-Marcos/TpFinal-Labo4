<?php
    require_once ("../PHPMailer/clsMail.php");

    $mailSend = new clsMail();
    $bodyHTML = '<h1>"Pet Hero!"</h1> <br> <h2> Ticket coupon</h2> <br> <h3>Hi,  Once you pay this 50% advance coupon, your booking will be confirmed</h3>
                
                <A HREF="http://localhost/TpFinal-Labo4/CreditCard/Payment?id=1">Acceda al cupon de Pago</A>
                ';


    $enviado = $mailSend->metSend("confirmacion de reserva Pet Hero!","Victor", "rockandrost@gmail.com", "Tu reserva Pet Hero!", $bodyHTML);

    if($enviado){
        echo ("Enviado");
    }else{
        echo ("Error");
    }
?>

