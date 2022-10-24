<?php

namespace DAO;

use Models\PetSize as PetSize;

interface iPetSizeDAO {
    function GetAll();
    function Add(PetSize $petSize);
}
?>