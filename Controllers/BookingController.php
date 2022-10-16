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
            var_dump($id);
            $booking = $this->bookingDAO->GetById($id);
            require_once(VIEWS_PATH."keeper-reservation.php");
        }

        public function Add($startDate, $endDate)
        {
            if($endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                echo "<script>alert('$message');</script>";
            }else{

                $booking = new booking();
 
                $booking->setStartDate($startDate);
                $booking->setEndDate($endDate);
                $booking->setStatus($status);
                $this->bookingDAO->Add($booking);

                $message = 'Your availability has been successfully set';
                echo "<script>alert('$message');</script>";
            }    
            $bookingList = $this->bookingDAO->getAll();
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