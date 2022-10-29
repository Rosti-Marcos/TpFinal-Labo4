<?php

    namespace DAO;
    use Models\BankAccount as BankAccount;

    interface IBankAccountDAO {
        function GetAll();
        function Add(BankAccount $bankAccount);
    }
?>