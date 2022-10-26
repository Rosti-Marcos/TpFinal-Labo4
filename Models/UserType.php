<?php

namespace Models;

class UserType{
   private $userTypeId;
   private $userType;

    public function getUserTypeId(){
        return $this->userTypeId;
    }

    public function setUserTypeId($userTypeId){
        $this->userTypeId = $userTypeId;
    }

    public function getUserType(){
        return $this->userType;
    }

    public function setUserType($userType){
        $this->userType= $userType;
    }

}
?>