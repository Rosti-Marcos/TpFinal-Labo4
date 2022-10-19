<?php
    namespace Models;

    class Booking{
        private $id;
        private $ownerId;
        private $keeperId;
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

        public function setOwnerId($ownerId){
            $this->ownerId = $ownerId;
        }

        public function getOwnerId(){
            return $this->ownerId;
        }

        public function setKeeperId($keeperId){
            $this->keeperId = $keeperId;
        }

        public function getKeeperId(){
            return $this->keeperId;
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