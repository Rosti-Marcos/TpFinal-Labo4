<?php

namespace Models;

class Pet{
    private $petId;
    private $petName;
    private $ownerId;
    private $vaccineCertId;
    private $petSizeId;
    private $petPics;
    private $petVideo;
    private $petBreed;
    private $petSpecieId;
    private $observation;


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


    public function getPetSizeId(){
        return $this->petSizeId;
    }


    public function setPetSizeId($petSizeId){
        $this->petSizeId = $petSizeId;
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


    public function getPetBreed(){
        return $this->petBreed;
    }


    public function setPetBreed($petBreed){
        $this->petBreed = $petBreed;
    }

    public function getPetSpecieId(){
        return $this->petSpecieId;
    }


    public function setPetSpecieId($petSpecieId){
        $this->petSpecieId = $petSpecieId;
    }


    public function getObservation(){
        return $this->observation;
    }


    public function setObservation($observation){
        $this->observation = $observation;
    }




}
?>