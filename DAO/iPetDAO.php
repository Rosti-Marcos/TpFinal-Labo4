<?php

namespace DAO;

    use Models\Pet as Pet;

    interface iPetDAO {
        function GetAll();
        function GetByPetId($petId);//reemplazar por Id
        function Add(Pet $pet);
    }
?>
