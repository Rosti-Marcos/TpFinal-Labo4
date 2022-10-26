<?php

namespace DAO;

use Models\PetSpecie as PetSpecie;
use DAO\IPetSpecieDAO as IPetSpecieDAO;


class PetSpecieDAO implements iPetSpecieDAO{

    private $petSpecieList = array();
    private $fileName = ROOT . "Data/petSpecies.json";

    function GetAll(){
        $this->RetrieveData();
        return $this->petSpecieList;
    }

    function Add(PetSpecie $petSpecie){

        $this->RetrieveData();

        $petSpecie->setPetSpecieId($this->GetNextId());

        array_push($this->petSpecieList, $petSpecie);

        $this->SaveData();

    }

    private function GetNextId() {
        $id = 0;
        foreach($this->petSpecieList as $petSpecie) {
            $id = ($petSpecie->getPetSpecieId() > $id) ? $petSpecie->getPetSpecieId() : $id;
        }
        return $id + 1;
    }

    public function RetrieveData() {
        $this->petSpecieList = array();

        if(file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayDecode as $value) {
                $petSpecie = new PetSpecie();
                $petSpecie->setPetSpecieId($value["petSpecieId"]);
                $petSpecie->setPetSpecie($value["petSpecie"]);

                array_push($this->petSpecieList, $petSpecie);
            }
        }
    }

    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->petSpecieList as $petSpecie){

            $valueArray = array();
            $valueArray["petSpecieId"]= $petSpecie->getPetSpecieId();
            $valueArray["petSpecie"]= $petSpecie->getPetSpecie();

            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function GetById($petSpecie) {
        $this->RetrieveData();

        $aux = array_filter($this->userSpecieList, function($userType) use($userTypeId) {
            return $userType->getUserTypeId() == $userTypeId;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }


}
?>