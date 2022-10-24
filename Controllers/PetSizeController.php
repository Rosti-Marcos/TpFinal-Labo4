<?php

namespace Controllers;
use DAO\PetSizeDAO as PetSizeDAO;
use Models\PetSize as PetSize;

class PetSizeController
{
    public $petSizeDAO;

    public function __construct(){
        $this->petSizeDAO = new PetSizeDAO();
    }

    public function Add($petSize)
    {
        require_once(VIEWS_PATH . "validate-session.php");

        $petSize = new PetSize();
        $petSize->setPetSize($petSize);
        $this->petSizeDAO->Add($petSize);
    }


}
?>