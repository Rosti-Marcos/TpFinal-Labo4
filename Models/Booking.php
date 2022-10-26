<?php
    namespace Models;

    class Booking{
        private $id;
        private User $user;
        private Keeper $keeper;
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

        public function setUser($user){
            $this->user = $user;
        }

        public function getUser(){
            return $this->user;
        }

        public function setKeeper($keeper){
            $this->keeper = $keeper;
        }

        public function getKeeper(){
            return $this->keeper;
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