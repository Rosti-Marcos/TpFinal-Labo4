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

        public function ShowPayment($booking, $message=""){
            require_once(VIEWS_PATH."payment-add.php");
            require_once(VIEWS_PATH."validate-session.php");
        }

        public function Add()
        {
            require_once(VIEWS_PATH."creditCard-add.php");
            require_once(VIEWS_PATH."validate-session.php");
        }

        public function Payment ($id){
            $bookingController = new BookingController;
            $booking= $bookingController->bookingDAO->GetById($id);
            $user = $booking->getUser();
            $_SESSION['loggedUser'] = $user;
            $homeController = new HomeController();
            $homeController->PaymentLogin($user->getUserName(), $user->getPassword());
            if ($booking->getStatus() == 'Approved (Pending payment)') {
            $this->ShowPayment($booking);
            }else{
                $homeController = new HomeController();
                $message = "Your booking is already payed";
                $homeController->ShowWellcomeView($message);
            }
        }

        public function CheckCreditCard($cardNbr, $name, $ccv){
            $creditCard = $this->creditCardDAO->GetByCardNbr($cardNbr);
            if(!empty($creditCard)){
                $fullName = explode(' ', $name);  
                if ($fullName[0] == $creditCard->getUser()->getName() && $fullName[1]== $creditCard->getUser()->getLastname()){
                    if ($ccv == $creditCard->getCcv()){
                        return $creditCard;
                  }
                }
            }
            return false;
        }
    
        public function CheckPayment($number, $name, $ccv, $bookingId){
            $bookingController = new BookingController();
            $chatController = new ChatController();
            $booking = $bookingController->bookingDAO->GetById($bookingId);
            $userId = $booking->getUser()->getUserId();
            $amount = $booking->getPrice()/2;
            $keeperId = $booking->getKeeper()->getUser()->getUserId();
            $creditCard=$this->CheckCreditCard($number,$name,$ccv);
            if(!empty($creditCard)){
                $bankAccountController = new BankAccountController();
                $balance = $bankAccountController->bankAccountDAO->GetByUserId($userId);
                if(!empty($balance)) {
                   if($balance >= $amount){
                    $bankAccountController->bankAccountDAO->AccountDebit($userId, $amount);
                    $bankAccountController->bankAccountDAO->AccountCredit($keeperId, $amount);
                    $bookingController = new BookingController();
                    $bookingController->bookingDAO->modifyBooking($bookingId, $booking->getMessage(), 'approved(payed)');
                    $homeController = new HomeController();
                    $tableName = $chatController->TableNameGenerator($userId, $keeperId);
                    $chatController->CreateTable($tableName);
                    $message = "Transaction done";
                    $homeController->ShowWellcomeView($message);
                    $this->ReceiptEmail($booking);
                   }else{
                    $message = "Transaction not possible ";
                    $this->ShowPayment($booking, $message);
                   }
                }
            }else{
                $message = "The data entered does not match to an valid credit card";
                $this->ShowPayment($booking, $message);
            }
        }

        public function ReceiptEmail ($booking){
            $date = date('Y/m/d');
            $amount = $booking->getPrice()/2;
            $price = $booking->getPrice();
            $ownerName = $booking->getUser()->getName();
            $ownerEmail = $booking->getUser()->getEMail();
            $phoneNumber = $booking->getUser()->getPhoneNumber();
            $petName = $booking->getPet()->getPetName();
            $keeperName = $booking->getKeeper()->getUser()->getName();
            $keeperEmail = $booking->getKeeper()->getUser()->getEMail();
            $keeperDateSince = $booking->getKeeper()->getStartDate();
            $startDate = $booking->getStartDate();
            $endDate = $booking->getEndDate();
            $emailController = new EmailController();
            $title = "Pet-Hero! Payment receipt";
            $subject =  "Your advance payment receipt";
            $bodyHTML = "<html><body style='background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;'><table style='max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;'><thead>
            <tr><th style='text-align:left;'><img style='max-width: 150px;' src='https://i.postimg.cc/zvktcy8r/pet-Hero-Logo.png' alt='bachana tours'></th><th style='text-align:right;font-weight:400;'>$date</th></tr></thead><tbody><tr><td style='height:35px;'></td></tr><tr><td colspan='2' style='border: solid 1px #ddd; padding:10px 20px;'><p style='font-size:14px;margin:0 0 6px 0;'><span style='font-weight:bold;display:inline-block;min-width:150px'>Order status</span><b style='color:green;font-weight:normal;margin:0'>Success</b></p><p style='font-size:14px;margin:0 0 6px 0;'><span style='font-weight:bold;display:inline-block;min-width:146px'>Transaction ID</span> abcd1234567890</p>
            <p style='font-size:14px;margin:0 0 0 0;'><span style='font-weight:bold;display:inline-block;min-width:146px'>Advance amount</span> $amount </p></td></tr><tr><td style='height:35px;'></td></tr><tr><td style='width:50%;padding:20px;vertical-align:top'><p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px'>Client Name</span> $ownerName </p><p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Client Email</span> $ownerEmail </p><p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Client Phone number</span> $phoneNumber </p><p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Pet name</span> $petName </p></td><td style='width:50%;padding:20px;vertical-align:top'><p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Keeper name</span> $keeperName </p><p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Keeper Email</span> $keeperEmail </p><p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Keeper since</span> $keeperDateSince </p></td></tr><tr><td colspan='2' style='font-size:20px;padding:30px 15px 0 15px;'>Booking details</td>
            </tr><tr><td colspan='2' style='padding:15px;'><p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'><span style='display:block;font-size:13px;font-weight:normal;'>Booking start date</span> $startDate <b style='font-size:12px;font-weight:300;'></b></p><p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'><span style='display:block;font-size:13px;font-weight:normal;'>Booking end date</span> $endDate <b style='font-size:12px;font-weight:300;'> </b></p><p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'><span style='display:block;font-size:13px;font-weight:normal;'>Booking total price</span> $price <b style='font-size:12px;font-weight:300;'> </b></p><p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'><span style='display:block;font-size:13px;font-weight:normal;'>Payed in advance</span> $amount <b style='font-size:12px;font-weight:300;'> </b></p></td></tr></tbody><tfooter><tr>
            <td colspan='2' style='font-size:14px;padding:50px 15px 0 15px;'><strong style='display:block;margin:0 0 10px 0;'>Regards</strong> Pet Hero!<br> Somewhere<br><br><b>Email:</b> pet.hero.tpfinal@gmail.com</td></tr></tfooter>
            </table></body></html>";
            $sendCheck = $emailController->metSend($title, $ownerName, $ownerEmail, $subject, $bodyHTML); 
            $sendCheck = $emailController->metSend($title, $keeperName, $keeperEmail, $subject, $bodyHTML); 
        }
        
    }

    ?>