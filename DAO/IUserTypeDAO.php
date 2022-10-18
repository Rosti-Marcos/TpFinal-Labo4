<?php

namespace DAO;
use Models\UserType as UserType;

interface IUserTypeDAO {
    function GetAll();
    function GetById($id);
    function Add(UserType $userType);
}
?>