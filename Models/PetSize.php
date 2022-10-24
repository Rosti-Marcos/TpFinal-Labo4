<?php

namespace Models;

class PetSize{
    private $petSizeId;
    private $petSize;


    public function getPetSizeId(){
        return $this->petSizeId;
    }


    public function setPetSizeId($petSizeId){
        $this->petSizeId = $petSizeId;
    }


    public function getPetSize(){
        return $this->petSize;
    }


    public function setPetSize($petSize){
        $this->petSize = $petSize;
    }

}
?>