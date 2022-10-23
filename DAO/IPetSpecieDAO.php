<?php

namespace DAO;

use Models\PetSpecie as PetSpecie;

interface iPetSpecieDAO {
    function GetAll();
    function Add(PetSpecie $petSpecie);
}
?>