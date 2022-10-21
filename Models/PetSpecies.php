<?php

namespace Models;

class PetSpecies{
    private $petSpecieId;
    private $petSpecie;


    public function getPetSpecieId(){
        return $this->petSpecieId;
    }


    public function setPetSpecieId($petSpecieId){
        $this->petSpecieId = $petSpecieId;
    }


    public function getPetSpecie(){
        return $this->petSpecie;
    }


    public function setPetSpecie($petSpecie){
        $this->petSpecie = $petSpecie;
    }

}
?>