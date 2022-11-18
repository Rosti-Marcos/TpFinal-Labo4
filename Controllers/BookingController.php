<?php
    namespace Controllers;

    use DAO\BookingDAO as BookingDAO;
    use Controllers\ReviewController as ReviewController;
    use Models\Booking as Booking;

    class BookingController
    {
        public $bookingDAO;


        public function __construct()
        {
            $this->bookingDAO = new bookingDAO();

        }

        public function ShowBookingsUser()
        {
            $this->CheckFinishedBookings();
            $keeperController = new KeeperController();
            $bookingList = $this->bookingDAO->getByUser($_SESSION['loggedUser']);
            $keeperList = $keeperController->keeperDAO->getAll();
            require_once(VIEWS_PATH."user-reservationList.php");
        }

        public function ShowBookingsUserByStatus($status)
        {
            if($status == 'Approved(Pendingpayment)'){
                $status = 'Approved (Pending payment)';
            }else if($status == 'Finishedreviewed'){
                $status = 'Finished & reviewed';
            }
            $keeperController = new KeeperController();
            $bookingList = $this->bookingDAO->getByStatus($status, $_SESSION["loggedUser"]);
            $keeperList = $keeperController->keeperDAO->getAll();
            require_once(VIEWS_PATH."user-reservationList.php");
        }

        public function ShowBookingsKeeper()
        {
            $this->CheckFinishedBookings();
            $userController = new UserController();
            $keeperController = new KeeperController();
            $keeper = $keeperController->keeperDAO->GetByUser($_SESSION['loggedUser']);
            $bookingList = $this->bookingDAO->getByKeeperId($keeper->getKeeperId());
            $userList = $userController->userDAO->getAll();
            require_once(VIEWS_PATH."keeper-reservationList.php");
        }

        public function ShowBookingsKeeperByStatus($status)
        {
            if($status == 'Approved(Pendingpayment)'){
                $status = 'Approved (Pending payment)';
            }else if($status == 'Finishedreviewed'){
                $status = 'Finished & reviewed';
            }
            
            $userController = new UserController();
            $keeperController = new KeeperController();
            $keeper = $keeperController->keeperDAO->GetByUser($_SESSION['loggedUser']);
            $bookingList = $this->bookingDAO->getByStatus($status);
            $userList = $userController->userDAO->getAll();
            require_once(VIEWS_PATH."keeper-reservationList.php");
        }

        public function MakeReservation($startDate, $endDate, $petId, $petSizeId, $userId){
            $user = $_SESSION["loggedUser"];
            $keeperController = new KeeperController();
            $userController = new UserController();
            $userKeeper = $userController->userDAO->GetById($userId);
            $keeper = $keeperController->keeperDAO->GetByUser($userKeeper);
            $serviceController = new serviceController();
            $petController = new PetController();
            $pet = $petController->petDAO->getByPetId($petId);
            $serviceList = $serviceController->serviceDAO->GetAvailablesByKeeper($userId);
            $bookingList = $this->bookingDAO->GetByKeeperId($keeper->getKeeperId());
            $petUserList = $petController->petDAO->GetByUser($user);
            if($endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                $this->PreReservation($userId, null, $message);
            }else{
                $cont = 0;
                $flag = 0;
                if(!empty($serviceList)){
                    foreach($serviceList as $service){
                        if($service->getStatus() == 'available' && $startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                            $cont++;
                            foreach($bookingList as $book){
                                if($startDate <= $book->getStartDate() && $endDate >= $book->getStartDate() || 
                                    $startDate <= $book->getEndDate() && $endDate >= $book->getEndDate()){
                                    if($book->getStatus() == 'Approved (Pending payment)' && $pet->getPetSpecie()->getPetSpecieId() != $book->getPet()->getPetSpecie()->getPetSpecieId()){
                                        $flag = 1;
                                    }
                                    if($book->getUser() == $_SESSION["loggedUser"] && $book->getPet() == $pet){
                                        switch ($book->getStatus()) {
                                            case 'pending':
                                                $message = 'You already have a pending reservation.';
                                                $this->PreReservation($userId, null, $message);
                                                break;
                                            case 'approved':
                                                $message = 'Your reservation is already approved.';
                                                $this->PreReservation($userId, null, $message);
                                                break;
                                            case 'rejected':
                                                $message = 'Your reservation was already rejected.';
                                                $this->PreReservation($userId, null, $message);
                                                break;
                                        }
                                        $flag = 2;     
                                        break;
                                    }   
                                        
                                }
                            }

                            if(!$bookingList || $flag == 0){
                                    
                                $remuneration = $keeper->getRemuneration();
                                $date1=date_create($startDate);
                                $date2=date_create($endDate);
                                $diff=$date2->diff($date1)->format("%a");
                                $price = $remuneration * ($diff + 1);
                                $booking = new booking();
                                $booking->setUser($user);
                                $booking->setKeeper($keeper);
                                $booking->setStartDate($startDate);
                                $booking->setEndDate($endDate);
                                $booking->setPrice($price);
                                $booking->setStatus('Pending');
                                $booking->setPet($pet);
                                $this->bookingDAO->Add($booking);
                                $cont++;
                                $message = 'Your booking has been successfully set';
                                $homeController = new HomeController;
                                $homeController->ShowWellcomeView("<script>alert('$message');</script>");

                            }else if($flag == 1){
                                $message = 'Some of the dates entered had already been booked with different species. Please enter different dates.'; 
                                $this->PreReservation($userId, null, $message);
                                break;
                            }else{
                                $this->PreReservation($userId, null);
                                break;
                            }
                        }
                    }
                    if($cont == 0){
                        $message = 'Some of the dates introduced are not available, please check the availability calendar and enter a new one.'; 
                        $this->PreReservation($userId, null, $message);  
                    }
                }else{
                    $message = "This keeper has no available dates";
                    $this->PreReservation($userId, null, $message); 
                }
            }
        }


        public function PreReservation($userId, $month = NULL, $message = ""){
            $reviewController = new ReviewController();
            $petController = new PetController();
            $petSizeController = new PetSizeController();
            $keeperController = new KeeperController();
            $calendarController = new CalendarController();
            $userController = new UserController();
            $petList = $petController->petDAO->GetByUser($_SESSION["loggedUser"]);
            $user = $userController->userDAO->GetById($userId);
            $keeper = $keeperController->keeperDAO->GetByUser($user);
            $reviewList = $reviewController->reviewDAO->GetReviewsByKeeper($keeper->getKeeperId());
            $avgReview = $reviewController->reviewDAO->GetAvgByKeeper($keeper->getKeeperId());
            $petSize = $petSizeController->petSizeDAO->GetById($keeper->getPetSize()->getPetSizeId());
            $calendar = $calendarController->GetKeeperAvailabilityCalendar($month, $userId);
            require_once(VIEWS_PATH . "reservation.php");

        }

        public function ReplyBooking($bookingId, $message, $button){
            $serviceController = new ServiceController();
            $booking = $this->bookingDAO->GetById($bookingId);
            $serviceList = $serviceController->serviceDAO->GetByKeeperId($booking->getKeeper()->getKeeperId());
            if($button == 'Approve'){
                $this->bookingDAO->modifyBooking($bookingId, $message, 'Approved (Pending payment)');
                $serviceController->Add($booking->getStartDate(), $booking->getEndDate(), $booking->getPet()->getPetSpecie()->getPetSpecie(), $booking->getKeeper());
                $this->CheckOtherSpeciesBookings($booking);
                $this->PaymentEmail($booking);
                if(!empty($serviceList)){
                    foreach($serviceList as $service){
                        if($service->getUser()->getUserId() == $booking->getKeeper()->getKeeperId() && $service->getStatus() == 'Pending' 
                            && $booking->getStartDate() == $service->getStartDate() && $booking->getEndDate() == $service->getEndDate()){
                            $serviceController->serviceDAO->modifyService($service->getId(), 'Approved (Pending payment)');
                        }       
                    } 
                }   
            }else{
                $this->bookingDAO->modifyBooking($bookingId, $message, 'Rejected');
                foreach($serviceList as $service){
                    if($service->getUser()->getUserId() == $booking->getKeeper()->getKeeperId() && $service->getStatus() == 'Pending' 
                        && $booking->getStartDate() == $service->getStartDate() && $booking->getEndDate() == $service->getEndDate()){
                        $serviceController->serviceDAO->modifyService($service->getId(), 'Rejected');
                    }       
                }
            }
            $this->ShowBookingsKeeper();
        }

        public function CheckOtherSpeciesBookings($booking){
            $bookingList = $this->bookingDAO->GetByKeeper($booking->getKeeper()->getUser());
            foreach($bookingList as $book){
                if($book->getStatus() == 'pending' && $book->getStartDate() <= $booking->getEndDate() && $book->getEndDate() >= $booking->getStartDate()){
                    $message = 'I will be taking care of another specie type.';
                    $this->bookingDAO->modifyBooking($book->getId(), $message, 'Rejected');
                }
            }
        }

        public function CheckFinishedBookings(){
            $bookingList = $this->bookingDAO->GetAll();
            $dateNow = date_create(date('y-m-d'));
            $dateNow = date_format($dateNow, 'y-m-d');
            if(!empty($bookingList)){
                foreach($bookingList as $booking){
                    $date = date_create($booking->getEndDate());
                    $date = date_format($date, 'y-m-d');
                    if($date < $dateNow){
                        switch($booking->getStatus()){
                            case 'approved(payed)':
                                $this->bookingDAO->modifyBooking($booking->getId(), $booking->getMessage(), "Finished");
                                break;
                            case 'pending':
                                $this->bookingDAO->modifyBooking($booking->getId(), $booking->getMessage(), "Unanswered");
                        }
                        
                    }
                }
            }
        }

        public function PaymentEmail($booking){
            $id = $booking->getId();
            $name = $booking->getUser()->getName();
            $email = $booking->getUser()->getEMail();
            $emailController = new EmailController();
            $title = "Pet-Hero! booking confirmation";
            $subject =  "Your advance payment coupon to confirm your booking";
            $bodyHTML = "<!DOCTYPE html><html lang='es' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width,initial-scale=1'><meta name='x-apple-disable-message-reformatting'><title></title><!--[if mso]><noscript>
            <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript><![endif]--><style>table, td, div, h1, p {font-family: Arial, sans-serif;}</style></head>
            <body style='margin:40px;padding:0;'><table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'><tr><td align='center' style='padding:0;'><table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'><tr><td align='center' style='padding:40px 0 30px 0;background:#ffffff;'><img src='https://i.postimg.cc/zvktcy8r/pet-Hero-Logo.png' alt='' width='300' style='height:auto;display:block;' /></td></tr><tr><td style='padding:36px 30px 42px 30px;'><table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'><tr><td style='padding:0 0 36px 0;color:#153643;'><h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'>Hello $name!!</h1><p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>We are delighted that you have chosen to trust us! We are sending you this link, so you can make the last step to confirm your booking.</p><p style='margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><a href='http://localhost/TpFinal-Labo4/CreditCard/Payment?id=$id' style='color:#ee4c50;text-decoration:underline;'>Let´s confirm my booking!</a></p></td></tr><tr><td style='padding:0;'><table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'><tr><td style='width:260px;padding:0;vertical-align:top;color:#153643;'><p style='margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><img src='https://i.postimg.cc/1XqQbc4q/parque-Mascotas.jpg' alt='' width='260' style='height:auto;display:block;' /></p><p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>Connecting people to brighten the days of our little friends is our mission! Our pets deserve quality time and there are always people willing to dedicate them.<br>You can trust us to meet some!</p></td><td style='width:20px;padding:0;font-size:0;line-height:0;'>&nbsp;</td><td style='width:260px;padding:0;vertical-align:top;color:#153643;'><p style='margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'><img src='https://i.postimg.cc/jdvbm5Sv/pet-Corazon.jpg' alt='' width='260' style='height:auto;display:block;' /></p><p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>All our keepers have veterinary care, for the peace of mind of the owners who trust in our service.</p></td></tr></table></td></tr></table></td>
            </tr><tr><td style='padding:30px;background:#ee4c50;'><table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'><tr><td style='padding:0;width:50%;' align='left'>
            <p style='margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;'>&reg; Pet Hero!, Somewhere 2022<br/></p></td><td style='padding:0;width:50%;' align='right'><table role='presentation' style='border-collapse:collapse;border:0;border-spacing:0;'><tr><td style='padding:0 0 0 10px;width:38px;'><a href='http://www.twitter.com/' style='color:#ffffff;'><img src='https://assets.codepen.io/210284/tw_1.png' alt='Twitter' width='38' style='height:auto;display:block;border:0;' /></a></td><td style='padding:0 0 0 10px;width:38px;'><a href='http://www.facebook.com/' style='color:#ffffff;'><img src='https://assets.codepen.io/210284/fb_1.png' alt='Facebook' width='38' style='height:auto;display:block;border:0;' /></a></td></tr>
            </table></td></tr></table></td></tr></table></td></tr></table></body></html>";

            $sendCheck = $emailController->metSend($title, $name, $email, $subject, $bodyHTML); 

        }



        

    }
?>