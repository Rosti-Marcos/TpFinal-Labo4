<?php

    namespace DAO;
    use Models\User as User;

    interface IUserDAO {
        function GetAll();
        function GetByUserName($userName);
        function Add(User $user);
    }
?>