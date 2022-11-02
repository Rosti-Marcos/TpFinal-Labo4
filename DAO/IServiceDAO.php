<?php

    namespace DAO;
    use Models\Service as Service;

    interface IServiceDAO {
        //function GetAll();
        function Add(Service $service);
    }
?>