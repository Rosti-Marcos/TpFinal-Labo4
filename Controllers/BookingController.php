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

        public function modifyBookings($id)
        {
            $booking = $this->bookingDAO->GetById($id);
            require_once(VIEWS_PATH."keeper-reservation.php");
        }

        public function Add($keeperId, $startDate, $endDate, $price){
            $ownerId = $_SESSION["loggedUser"]->getUserId();
            $serviceController = new serviceController();
            $serviceList = $serviceController->serviceDAO->GetByKeeperId($keeperId)
            if($endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                echo "<script>alert('$message');</script>";
            }else{
                $flag = 0;
                foreach($serviceList as $service){
                    if($service->getStatus() == 'available' && $startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                        $booking = new booking();
                        $booking->setOwnerId($ownerId);
                        $booking->setKeeperId($keeperId);
                        $booking->setStartDate($startDate);
                        $booking->setEndDate($endDate);
                        $booking->setPrice($price);
                        $booking->setStatus('pending');
                        $this->bookingDAO->Add($booking);
                        $serviceController->modifyService($service, $startDate, $endDate);
                        $flag = 1;
                        break;
                    }
                }
                
            }


            $this->ShowAvailabilityView();
        }

        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->bookingDAO->Remove($id);

            $this->ShowAvailabilityView();
        }
    }
?>