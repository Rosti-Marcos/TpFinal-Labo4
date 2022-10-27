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

        public function MakeReservation($startDate, $endDate, $petSpecieId, $petSize, $userId){
            $user = $_SESSION["loggedUser"];
            $serviceController = new serviceController();
            $serviceList = $serviceController->serviceDAO->GetByKeeperId($userId);
            if($endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                echo "<script>alert('$message');</script>";
            }else{
                $flag = 0;
                foreach($serviceList as $service){
                    if($service->getStatus() == 'available' && $startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                        $keeperController = new KeeperController;
                        $keeper = $keeperController->keeperDAO->GetById($userId);
                        $petSpecieController = new PetSpecieController;
                        $petSpecie = $petSpecieController->petSpecieDAO->GetById($petSpecieId);
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
                        $booking->setPetSpecie($petSpecie);
                        $this->bookingDAO->Add($booking);
                        $serviceController->ModifyService($service, $startDate, $endDate, $userId);
                        $flag = 1;
                        break;
                    }
                }
                
            }

        }


        public function PreReservation($userId, $month = NULL){
            $petSpecieController = new PetSpecieController();
            $petSizeController = new PetSizeController();
            $keeperController = new KeeperController();
            $calendarController = new CalendarController();
            $userController = new UserController();
            $petSpecieList = $petSpecieController->petSpecieDAO->GetAll();
            $petSizeList = $petSizeController->petSizeDAO->GetAll();
            $user = $userController->userDAO->GetById($userId);
            $keeper = $keeperController->keeperDAO->GetByUser($user);
            $petSize = $petSizeController->petSizeDAO->GetById($keeper->getPetSize()->getPetSizeId());
            $calendar = $calendarController->GetKeeperAvailabilityCalendar($month, $userId);
            require_once(VIEWS_PATH . "reservation.php");

        }

        public function ReplyBooking($bookingId, $message, $button){
            if($button == 'Approve'){
                $this->bookingDAO->modifyBooking($bookingId, $message, 'approved');
            }else{
                $this->bookingDAO->modifyBooking($bookingId, $message, 'rejected');
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