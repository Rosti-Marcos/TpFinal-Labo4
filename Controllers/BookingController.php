<?php
    namespace Controllers;

    use DAO\BookingDAO as BookingDAO;
    use Models\Booking as Booking;

    class BookingController
    {
        private $bookingDAO;


        public function __construct()
        {
            $this->bookingDAO = new bookingDAO();

        }

        public function ShowBookingsUser()
        {
            $userController = new UserController();
            $bookingList = $this->bookingDAO->getByUser($_SESSION['loggedUser']);
            $userList = $userController->userDAO->getAll();
            require_once(VIEWS_PATH."user-reservationList.php");
        }

        public function ShowBookingsKeeper()
        {
            $userController = new UserController();
            $keeperController = new KeeperController();
            $keeper = $keeperController->keeperDAO->GetByUser($_SESSION['loggedUser']);
            $bookingList = $this->bookingDAO->getByKeeper($keeper);
            $userList = $userController->userDAO->getAll();
            require_once(VIEWS_PATH."keeper-reservationList.php");
        }

        public function MakeReservation($startDate, $endDate, $petId, $petSizeId, $userId){
            $user = $_SESSION["loggedUser"];
            $keeperController = new KeeperController;
            $serviceController = new serviceController();
            $petController = new PetController();
            $serviceList = $serviceController->serviceDAO->GetByKeeperId($userId);
            $bookingList = $this->bookingDAO->GetByKeeperId($userId);
            $petUserList = $petController->petDAO->GetByUser($user);
            if($petUserList){
                $cont = 0;
                foreach($petUserList as $pet){
                    if($pet->getPetSize()->getPetSizeId() != $petSizeId){
                        $cont++;
                    }
                }
                if($cont == sizeof($petUserList)){
                    $message = 'You do not have any pet size that the keeper takes care of.';
                    echo "<script>alert('$message');</script>";
                    $keeperController->ShowListView();
                }else{
                    if($endDate < $startDate){
                        $message = 'You cannot set the end date to before the start date';
                        echo "<script>alert('$message');</script>";
                    }else{
                        $cont = 0;
                        $flag = 0;
                        foreach($serviceList as $service){
                            if($service->getStatus() == 'available' && $startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                                foreach($bookingList as $book){
                                    if(($startDate <= $book->getStartDate() && $endDate >= $book->getStartDate() || 
                                        $startDate <= $book->getEndDate() && $endDate >= $book->getEndDate()) && 
                                        $petSpecieId != $book->getPet()->getPetSpecie()->getPetSpecieId()){
                                            $flag = 1;
                                        }
                                    if(!$bookingList || $flag == 0){
                                        $keeper = $keeperController->keeperDAO->GetById($userId);
                                        $pet = $petController->petDAO->getByPetId($petId);
                                        $remuneration = $keeper->getRemuneration();
                                        $date1=date_create($startDate);
                                        $date2=date_create($endDate);
                                        $diff=$date2->diff($date1)->format("%a");
                                        $price = $remuneration * $diff;
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
                                        $message = 'Your booking has been successfully set';
                                        echo "<script>alert('$message');</script>";
                                        break;
                                    }else if($flag == 1){
                                        $message = 'Some of the dates entered had already been booked with different species. Please enter different dates.'; 
                                        echo "<script>alert('$message');</script>";
                                        $this->PreReservation($userId);
                                        break;
                                    }
                                    
                                }
                            }else{
                                $cont++;
                            }
                        }
                        
                    }
                    if($cont < sizeOf(serviceList)){
                        $message = 'Some of the dates introduced are not available, please check the availability calendar and enter a new one.'; 
                        echo "<script>alert('$message');</script>";
                        $this->PreReservation($userId);
                    }
                }
            }else{
                $message = 'You do not have any pet yet';
                echo "<script>alert('$message');</script>";
                $keeperController->ShowListView();
            }

        }


        public function PreReservation($userId, $month = NULL){
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
                foreach($serviceList as $service){
                    if($service->getUser()->getUserId() == $booking->getKeeper()->getKeeperId() && $service->getStatus() == 'pending' 
                        && $booking->getStartDate() == $service->getStartDate() && $booking->getEndDate() == $service->getEndDate()){
                        $serviceController->serviceDAO->modifyService($service->getId(), 'approved');
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
        
        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->bookingDAO->Remove($id);

        }
    }
?>