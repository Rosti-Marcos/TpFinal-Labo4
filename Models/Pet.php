<?php

namespace Models;

class Pet{
    private $petId;
    private $petName;
    private $ownerId;
    private $vaccineCertId;
    private $PetTypeId;
    private $petPics;
    private $petVideo;


    public function getPetId(){
        return $this->petId;
    }


    public function setPetId($petId){
        $this->petId = $petId;
    }


    public function getPetName(){
        return $this->petName;
    }


    public function setPetName($petName){
        $this->petName = $petName;
    }


    public function getOwnerId(){
        return $this->ownerId;
    }


    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
    }


    public function getVaccineCertId(){
        return $this->vaccineCertId;
    }


    public function setVaccineCertId($vaccineCertId){
        $this->vaccineCertId = $vaccineCertId;
    }


    public function getPetTypeId(){
        return $this->PetTypeId;
    }


    public function setPetTypeId($PetTypeId){
        $this->PetTypeId = $PetTypeId;
    }


    public function getPetPics(){
        return $this->petPics;
    }


    public function setPetPics($petPics){
        $this->petPics = $petPics;
    }


    public function getPetVideo(){
        return $this->petVideo;
    }


    public function setPetVideo($petVideo){
        $this->petVideo = $petVideo;
    }


}
?>