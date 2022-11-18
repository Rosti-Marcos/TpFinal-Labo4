<?php
    namespace Models;

    class Review{
        private $id;
        private User $owner; 
        private keeper $keeper;
        private $comment;
        private $date;
        private $valoration;

        
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getOwner(){
            return $this->owner;
        }

        public function setOwner($owner){
            $this->owner = $owner;
        }

        public function getKeeper(){
            return $this->keeper;
        }

        public function setKeeper(keeper $keeper){
            $this->keeper = $keeper;
        }

        public function getComment(){
            return $this->comment;
        }

        public function setComment($comment){
            $this->comment = $comment;
        }

        public function getDate(){
            return $this->date;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function getValoration(){
            return $this->valoration;
        }

        public function setValoration($valoration){
            $this->valoration = $valoration;
        }
    }
?>
