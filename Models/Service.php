<?php
    namespace Models;

    class Service{
        private $id;
        private User $user;
        private $startDate;
        private $endDate;
        private $status;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function getUser(){
            return $this->user;
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

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

    }


?>