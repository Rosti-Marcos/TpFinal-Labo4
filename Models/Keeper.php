<?php

namespace Models;

class Keeper{
    private $keeperId;
    private User $user;
    private PetSize $petSize;
    private $remuneration;
    private $startDate;


    public function getKeeperId(){
        return $this->keeperId;
    }

    public function setKeeperId($keeperId){
        $this->keeperId = $keeperId;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser(User $user){
        $this->user = $user;
    }

    public function getPetSize(){
        return $this->petSize;
    }

    public function setPetSize(PetSize $petSize){
        $this->petSize = $petSize;
    }

    public function getRemuneration(){
        return $this->remuneration;
    }

    public function setRemuneration($remuneration){
        $this->remuneration = $remuneration;
    }

    public function getStartDate(){
        return $this->startDate;
    }

    public function setStartDate($startDate){
        $this->startDate = $startDate;
    }

}
?>