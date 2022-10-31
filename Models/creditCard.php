<?php
    namespace Models;

    class CreditCard{
        private $id;
        private User $user;
        private $cardNbr;
        private $ccv;
        private $expirationDate;

        
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getUser(){
            return $this->user;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function getCardNbr(){
            return $this->cardNbr;
        }

        public function setCardNrb($cardNbr){
            $this->cardNbr = $cardNbr;
        }

        public function getCcv(){
            return $this->ccv;
        }

        public function setCcv($ccv){
            $this->ccv = $ccv;
        }

        public function getExpirationDate(){
            return $this->expirationDate;
        }

        public function setExpirationDate($expirationDate){
            $this->expirationDate = $expirationDate;
        }
    }

?>