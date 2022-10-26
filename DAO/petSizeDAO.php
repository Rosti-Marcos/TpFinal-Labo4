<?php

namespace DAO;

use Models\PetSize as PetSize;
use DAO\IPetSizeDAO as IPetSizeDAO;


class PetSizeDAO implements iPetSizeDAO{

    private $petSizeList = array();
    private $fileName = ROOT . "Data/petSizes.json";

    function GetAll(){
        $this->RetrieveData();
        return $this->petSizeList;
    }

    function Add(PetSize $petSize){

        $this->RetrieveData();

        $petSize->setPetSizeId($this->GetNextId());

        array_push($this->petSizeList, $petSize);

        $this->SaveData();

    }

    private function GetNextId() {
        $id = 0;
        foreach($this->petSizeList as $petSize) {
            $id = ($petSize->getPetSizeId() > $id) ? $petSize->getPetSizeId() : $id;
        }
        return $id + 1;
    }

    public function RetrieveData() {
        $this->petSizeList = array();

        if(file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayDecode as $value) {
                $petSize = new PetSize();
                $petSize->setPetSizeId($value["petSizeId"]);
                $petSize->setPetSize($value["petSize"]);

                array_push($this->petSizeList, $petSize);
            }
        }
    }

    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->petSizeList as $petSize){

            $valueArray = array();
            $valueArray["petSizeId"]= $petSize->getPetSizeId();
            $valueArray["petSize"]= $petSize->getPetSize();

            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }
    
    public function GetById($petSizeId) {
        $this->RetrieveData();

        $aux = array_filter($this->petSizeList, function($petSize) use($petSizeId) {
            return $petSize->getPetSizeId() == $petSizeId;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }
}
?>