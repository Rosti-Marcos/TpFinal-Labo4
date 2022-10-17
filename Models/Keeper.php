<?php

namespace Models;

class Keeper{
    private $keeperId;
    private $userId;
    private $petTypeId;
    private $remuneration;
    private $startDate;


    public function getKeeperId(){
        return $this->keeperId;
    }

    public function setKeeperId($keeperId){
        $this->keeperId = $keeperId;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getPetTypeId(){
        return $this->petTypeId;
    }

    public function setPetTypeId($petTypeId){
        $this->petTypeId = $petTypeId;
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