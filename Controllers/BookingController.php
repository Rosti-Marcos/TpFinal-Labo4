<?php
    namespace Controllers;

    use DAO\BookingDAO as BookingDAO;
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
                                    if($pet->getPetSpecie()->getPetSpecieId() != $book->getPet()->getPetSpecie()->getPetSpecieId()){
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
                                $booking->setStatus('pending');
                                $booking->setPet($pet);
                                $this->bookingDAO->Add($booking);
                                $serviceController->Add($startDate, $endDate, 'pending', $keeper);
                                $cont++;
                                $message = 'Your booking has been successfully set';
                                $homeController = new HomeController;
                                $homeController->ShowWellcomeView("<script>alert('$message');</script>");

                            }else if($flag == 1){
                                $message = 'Some of the dates entered had already been booked with different species. Please enter different dates.'; 
                                $this->PreReservation($userId, null, $message);
                                break;
                            }else{
                                $this->PreReservation($userId, null, $message);
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
            $petController = new PetController();
            $petSizeController = new PetSizeController();
            $keeperController = new KeeperController();
            $calendarController = new CalendarController();
            $userController = new UserController();
            $petList = $petController->petDAO->GetByUser($_SESSION["loggedUser"]);
            $user = $userController->userDAO->GetById($userId);
            $keeper = $keeperController->keeperDAO->GetByUser($user);
            $petSize = $petSizeController->petSizeDAO->GetById($keeper->getPetSize()->getPetSizeId());
            $calendar = $calendarController->GetKeeperAvailabilityCalendar($month, $userId);
            require_once(VIEWS_PATH . "reservation.php");

        }

        public function ReplyBooking($bookingId, $message, $button){
            $serviceController = new ServiceController();
            $booking = $this->bookingDAO->GetById($bookingId);
            $serviceList = $serviceController->serviceDAO->GetByKeeperId($booking->getKeeper()->getKeeperId());
            if($button == 'Approve'){
                $this->bookingDAO->modifyBooking($bookingId, $message, 'approved');
                if(!empty($serviceList)){
                    foreach($serviceList as $service){
                        if($service->getUser()->getUserId() == $booking->getKeeper()->getKeeperId() && $service->getStatus() == 'pending' 
                            && $booking->getStartDate() == $service->getStartDate() && $booking->getEndDate() == $service->getEndDate()){
                            $serviceController->serviceDAO->modifyService($service->getId(), 'approved');
                        }       
                    } 
                }   
            }else{
                $this->bookingDAO->modifyBooking($bookingId, $message, 'rejected');
                foreach($serviceList as $service){
                    if($service->getUser()->getUserId() == $booking->getKeeper()->getKeeperId() && $service->getStatus() == 'pending' 
                        && $booking->getStartDate() == $service->getStartDate() && $booking->getEndDate() == $service->getEndDate()){
                        $serviceController->serviceDAO->modifyService($service->getId(), 'rejected');
                    }       
                }
            }
            $this->ShowBookingsKeeper();
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
                            case 'approved':
                                $this->bookingDAO->modifyBooking($booking->getId(), $booking->getMessage(), "finished");
                                break;
                            case 'pending':
                                $this->bookingDAO->modifyBooking($booking->getId(), $booking->getMessage(), "unanswered");
                        }
                        
                    }
                }
            }
        }
        
        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->bookingDAO->Remove($id);

        }
    }
?>