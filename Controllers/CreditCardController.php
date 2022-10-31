<?php
    namespace Controllers;

    use DAO\CreditCardDAO as CreditCardDAO;
    use Models\CreditCard as CreditCard;

    class CreditCardController
    {
        private $creditCardDAO;


        public function __construct()
        {
            $this->creditCardDAO = new CreditCardDAO;

        }

        public function ShowAddCard($booking){
            require_once(VIEWS_PATH."creditCard-add.php");
            require_once(VIEWS_PATH."validate-session.php");
        }

        public function Add()
        {
            require_once(VIEWS_PATH."creditCard-add.php");
            require_once(VIEWS_PATH."validate-session.php");
        }

        public function Red ($id){
            $bookingController = new BookingController;
            $booking= $bookingController->bookingDAO->GetById($id);
            $this->ShowAddCard($booking);
            require_once(VIEWS_PATH."validate-session.php");
        }
    
    }
    ?>