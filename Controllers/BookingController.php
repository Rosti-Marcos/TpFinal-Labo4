<?php
    namespace Controllers;

    use DAO\BookingDAO as BookingDAO;

    use Models\Booking as Booking;

    class BookingController
    {
        private $BookingDAO;


        public function __construct()
        {
            $this->bookingDAO = new bookingDAO();

        }

        public function ShowBookings()
        {
            $bookingList = $this->bookingDAO->getAll();
            require_once(VIEWS_PATH."keeper-reservationList.php");
        }

        public function ModifyBookings($id)
        {
            $booking = $this->bookingDAO->GetById($id);
            require_once(VIEWS_PATH."keeper-reservation.php");
        }

        public function Add($keeperId, $startDate, $endDate, $price){
            $user = $_SESSION["loggedUser"];
            $serviceController = new serviceController();
            $serviceList = $serviceController->serviceDAO->GetByKeeperId($keeperId);
            if($endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                echo "<script>alert('$message');</script>";
            }else{
                $flag = 0;
                foreach($serviceList as $service){
                    if($service->getStatus() == 'available' && $startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                        $keeperController = new KeeperController;
                        $keeper = $keeperController->keeperDAO->GetById($keeperId);
                        $booking = new booking();
                        $booking->setUser($user);
                        $booking->setKeeper($keeper);
                        $booking->setStartDate($startDate);
                        $booking->setEndDate($endDate);
                        $booking->setPrice($price);
                        $booking->setStatus('pending');
                        $this->bookingDAO->Add($booking);
                        $serviceController->ModifyService($service, $startDate, $endDate);
                        $flag = 1;
                        break;
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