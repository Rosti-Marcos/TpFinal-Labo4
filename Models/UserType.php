<?php

namespace Models;

class UserType{
   private $userTypeId;
   private $type;

    public function getUserTypeId(){
        return $this->userTypeId;
    }

    public function setUserTypeId($userTypeId){
        $this->userTypeId = $userTypeId;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
    }

}
?>