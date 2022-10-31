<?php

    namespace DAO;
    use Models\CreditCard as CreditCard;

    interface ICreditCardDAO {
        function GetAll();
        function Add(CreditCard $creditCard);
    }
?>