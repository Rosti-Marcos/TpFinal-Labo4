<?php

    namespace DAO;

    use Models\Booking as Booking;
    use DAO\IBookingDAO as IBookingDAO;

    class BookingDAO implements IBookingDAO{

        public $bookingList = array();
        private $fileName = ROOT . "Data/booking.json";


        public function GetAll() {
            $this->RetrieveData();
            return $this->bookingList;
        }

        public function GetById($id)
        {
            $this->RetrieveData();

            $booking = array_filter($this->bookingList, function($booking) use($id){                
                return $booking->getId() == $id;
            });

            $booking = array_values($booking); //Reordering array indexes

            return (count($booking) > 0) ? $booking[0] : null;
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


        private function RetrieveData() {
            $this->bookingList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $booking = new booking();
                    $booking->setId($value["id"]);
                    $booking->setOwnerId($value["ownerId"]);
                    $booking->setKeeperId($value["keeperId"]);
                    $booking->setStartDate($value["startDate"]);
                    $booking->setEndDate($value["endDate"]);
                    $booking->setDescription($value["description"]);
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
                $valueArray["ownerId"] = $booking->getOwnerId();
                $valueArray["keeperId"] = $booking->getKeeperId();
                $valueArray["startDate"]= $booking->getStartDate();
                $valueArray["endDate"] = $booking->getEndDate();
                $valueArray["description"]= $booking->getDescription();
                $valueArray["price"] = $booking->getPrice();
                $valueArray["status"] = $booking->getStatus();


                array_push($arrayEncode, $valueArray);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }
    }
?>