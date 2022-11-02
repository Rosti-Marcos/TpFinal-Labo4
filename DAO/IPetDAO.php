<?php

namespace DAO;

    use Models\Pet as Pet;

    interface iPetDAO {
        function GetAll();
        function GetByPetId($petId);
        function Add(Pet $pet);
    }
?>
