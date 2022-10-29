<?php
    namespace Models;

    class Review{
        private $id;
        private User $owner; 
        private User $keeper;
        private $description;
        private $date;
        private $valoration;

        
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getOwner(){
            return $this->idOwner;
        }

        public function setOwner($owner){
            $this->owner = $owner;
        }

        public function getKeeper(){
            return $this->idKeeper;
        }

        public function setKeeper($keeper){
            $this->keeper = $keeper;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description){
            $this->description = $description;
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
