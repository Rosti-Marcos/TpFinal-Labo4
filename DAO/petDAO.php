<?php

namespace DAO;

use Models\Pet as Pet;
use DAO\IPetDAO as IPetDAO;


class petDAO implements iPetDAO{

    private $petList = array();
    private $fileName = ROOT . "Data/pets.json";

    function GetAll(){
        $this->RetrieveData();
        return $this->petList;
    }

    public function GetByPetId($petId) {
        $this->RetrieveData();

        $aux = array_filter($this->petList, function($pet) use($petId) {
            return $pet->getPetId() == $petId;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }

    function Add(Pet $pet){

        $this->RetrieveData();

        $pet->setPetId($this->GetNextId());

        $pet->setOwnerId($_SESSION["loggedUser"]->getUserId());

        array_push($this->petList, $pet);

        $this->SaveData();

    }

    private function GetNextId() {
        $id = 0;
        foreach($this->petList as $pet) {
            $id = ($pet->getPetId() > $id) ? $pet->getPetId() : $id;
        }
        return $id + 1;
    }

    public function RetrieveData() {
        $this->petList = array();

        if(file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayDecode as $value) {
                $pet = new Pet();
                $pet->setPetId($value["petId"]);
                $pet->setPetName($value["petName"]);
                $pet->setOwnerId($value["ownerId"]);
                $pet->setVaccineCertId($value["vaccineCertId"]);
                $pet->setPetSize($value["petSize"]);
                $pet->setPetPics($value["petPics"]);
                $pet->setPetVideo($value["petVideo"]);
                $pet->setPetBreed($value["petBreed"]);
                $pet->setPetSpecieId($value["petSpecieId"]);
                $pet->setObservation($value["observation"]);
                array_push($this->petList, $pet);
            }
        }
    }

    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->petList as $pet){

            $valueArray = array();
            $valueArray["petId"]= $pet->getPetId();
            $valueArray["petName"]= $pet->getPetName();
            $valueArray["ownerId"] = $pet->getOwnerId();
            $valueArray["vaccineCertId"] = $pet->getVaccineCertId();
            $valueArray["petSize"] = $pet->getPetSize();
            $valueArray["petPics"] = $pet->getPetPics();
            $valueArray["petVideo"] = $pet->getPetVideo();
            $valueArray["petBreed"] = $pet->getPetBreed();
            $valueArray["petSpecieId"] = $pet->getPetSpecieId();
            $valueArray["observation"] = $pet->getObservation();
            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function GetByOwnerId($ownerId) {
        $this->RetrieveData();
        $aux = array_filter($this->petList, function($pet) use($ownerId) {
            return $pet->getOwnerId() == $ownerId;
        });
        $aux = array_values($aux);
        return (count($aux) > 0) ? $aux : array();

    }


}
?>