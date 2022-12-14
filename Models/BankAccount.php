<?php
    namespace Models;

    class BankAccount{
        private $id;
        private User $user;
        private $accountNbr;
        private $balance;

        
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

        public function getAccountNbr(){
            return $this->accountNbr;
        }

        public function setAccountNbr($accountNbr){
            $this->accountNbr = $accountNbr;
        }

        public function getBalance(){
            return $this->balance;
        }

        public function setBalance($balance){
            $this->balance = $balance;
        }
    }

?>