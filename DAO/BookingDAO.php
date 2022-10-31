<?php

    namespace DAO;

    use Models\Booking as Booking;
    use Models\Pet as Pet;
    use DAO\IBookingDAO as IBookingDAO;

    class BookingDAO implements IBookingDAO{

        public $bookingList = array();
        private $fileName = ROOT . "Data/bookings.json";


        public function GetAll() {
            $this->RetrieveData();
            return $this->bookingList;
        }

        public function GetByUser($user)
        {
            $this->RetrieveData();

            $booking = array_filter($this->bookingList, function($booking) use($user){                
                return $booking->getUser() == $user;
            });

            $booking = array_values($booking);
            

            return (count($booking) > 0) ? $booking : array();
        }

        public function GetByKeeper($keeper)
        {
            $this->RetrieveData();

            $booking = array_filter($this->bookingList, function($booking) use($keeper){                
                return $booking->getKeeper() == $keeper;
            });

            $booking = array_values($booking);
            

            return (count($booking) > 0) ? $booking : array();
        }

        public function GetByKeeperId($keeperId)
        {
            $this->RetrieveData();

            $booking = array_filter($this->bookingList, function($booking) use($keeperId){                
                return $booking->getKeeper()->getKeeperId() == $keeperId;
            });

            $booking = array_values($booking);
            

            return (count($booking) > 0) ? $booking : array();
        }

        public function GetById($id) {
            $this->RetrieveData();
    
            $aux = array_filter($this->bookingList, function($booking) use($id) {
                return $booking->getId() == $id;
            });
    
            $aux = array_values($aux);
    
            return (count($aux) > 0) ? $aux[0] : array();
        }

        public function GetByStatus($status) {
            $this->RetrieveData();
            $user = $_SESSION["loggedUser"];
            $aux = array_filter($this->bookingList, function($booking) use($status, $user) {
                return ($booking->getKeeper()->getUser() == $user && $booking->getStatus() == $status);
            });
            $aux = array_values($aux);
            return (count($aux) > 0) ? $aux : array();
        }

        public function Add(Booking $booking) {
            $this->RetrieveData();

            $booking->setId($this->GetNextId());

            array_push($this->bookingList, $booking);

            $this->SaveData();
        }


        private function GetNextId() {
            $id = 0;
            foreach($this->bookingList as $booking) {
                $id = ($booking->getId() > $id) ? $booking->getId() : $id;
            }
            return $id + 1;
        }

        public function modifyBooking($bookingId, $message, $status){
            $this->RetrieveData();
            $newBooking = $this->GetById($bookingId);
            $newBooking->setStatus($status);
            $newBooking->setMessage($message);
            $this->bookingList = array_filter($this->bookingList, function($booking) use($newBooking) {
                return $booking->getId() != $newBooking->getId();
            });

            array_push($this->bookingList, $newBooking);

            $this->SaveData();
        }

        private function RetrieveData() {
            $this->bookingList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $petDAO = new PetDAO;
                    $pet = $petDAO->GetByPetId($value["pet"]);
                    $userDAO = new UserDAO;
                    $user = $userDAO->GetById($value["user"]);
                    $keeperDAO = new KeeperDAO;
                    $keeper = $keeperDAO->getById($value["keeper"]);
                    
                    $booking = new booking();
                    $booking->setId($value["id"]);
                    $booking->setUser($user);
                    $booking->setKeeper($keeper);
                    $booking->setStartDate($value["startDate"]);
                    $booking->setEndDate($value["endDate"]);
                    $booking->setMessage($value["message"]);
                    $booking->setPet($pet);
                    $booking->setPrice($value["price"]);
                    $booking->setStatus($value["status"]);

                    array_push($this->bookingList, $booking);
                }
            }
        }
        
        private function SaveData() {

            $arrayEncode = array();

            foreach ($this->bookingList as $booking){

                $valueArray = array();
                $valueArray["id"] = $booking->getId();
                $valueArray["user"] = $booking->getUser()->getUserId();
                $valueArray["keeper"] = $booking->getKeeper()->getKeeperId();
                $valueArray["startDate"]= $booking->getStartDate();
                $valueArray["endDate"] = $booking->getEndDate();
                $valueArray["message"]= $booking->getMessage();
                $valueArray["pet"] = $booking->getPet()->getPetId();
                $valueArray["price"] = $booking->getPrice();
                $valueArray["status"] = $booking->getStatus();


                array_push($arrayEncode, $valueArray);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }
    }
?>