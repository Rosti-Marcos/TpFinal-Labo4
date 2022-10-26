<?php

namespace Models;

class Pet{
    private $petId;
    private $petName;
    private User $user;
    private $vaccineCert;
    private PetSize $petSize;
    private $petPics;
    private $petVideo;
    private $petBreed;
    private PetSpecie $petSpecie;
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


    public function getUser(){
        return $this->user;
    }


    public function setUser(User $user){
        $this->user = $user;
    }


    public function getVaccineCert(){
        return $this->vaccineCert;
    }


    public function setVaccineCert($vaccineCert){
        $this->vaccineCert = $vaccineCert;
    }


    public function getPetSize(){
        return $this->petSize;
    }


    public function setPetSize(PetSize $petSize){
        $this->petSize = $petSize;
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

    public function getPetSpecie(){
        return $this->petSpecie;
    }


    public function setPetSpecie(PetSpecie $petSpecie){
        $this->petSpecie = $petSpecie;
    }


    public function getObservation(){
        return $this->observation;
    }


    public function setObservation($observation){
        $this->observation = $observation;
    }




}
?>