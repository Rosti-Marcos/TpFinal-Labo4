<?php

namespace Models;

class PetType{
    private $petTypeId;
    private $petType;


    public function getTypePetId(){
        return $this->petTypeId;
    }


    public function setPetTypeId($petTypeId){
        $this->petId = $petTypeId;
    }


    public function getPetType(){
        return $this->petType;
    }


    public function setPetType($petType){
        $this->petType = $petType;
    }


}
?>