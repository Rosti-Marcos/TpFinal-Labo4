<?php
    namespace Models;

    class Booking{
        private $id;
        private $idOwner;
        private $idKeeper;
        private $startDate;
        private $endDate;
        private $description;
        private $price;
        private $status;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getIdOwner(){
            return $this->idOwner;
        }

        public function getIdKeeper(){
            return $this->idKeeper;
        }

        public function setStartDate($startDate){
            $this->startDate = $startDate;
        }

        public function getStartDate(){
            return $this->startDate;
        }

        public function setEndDate($endDate){
            $this->endDate = $endDate;
        }

        public function getEndDate(){
            return $this->endDate;
        }

        public function setDescription($description){
            $this->description = $description;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setPrice($price){
            $this->price = $price;
        }

        public function getPrice(){
            return $this->price;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }
    }


?>