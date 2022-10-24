<?php

namespace Controllers;
use DAO\PetSpecieDAO as PetSpecieDAO;
use Models\PetSpecie as PetSpecie;

class PetSpecieController
{
    public $petSpecieDAO;

    public function __construct(){
        $this->petSpecieDAO = new PetSpecieDAO();
    }

    public function Add($petSpecie)
    {
        require_once(VIEWS_PATH . "validate-session.php");

        $petSpecie = new PetSpecie();
        $petSpecie->setPetSpecie($petSpecie);
        $this->petSpecieDAO->Add($petSpecie);
    }


}
?>