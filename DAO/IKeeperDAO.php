<?php

namespace DAO;
use Models\Keeper as Keeper;

interface IKeeperDAO {
    function GetAll();
    function GetById($id);
    function Add(Keeper $keeper);
}
?>