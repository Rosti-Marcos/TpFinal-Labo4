<?php
    namespace Controllers;

    use DAO\BankAccountDAO as BankAccountDAO;
    use Models\BankAccount as BankAccount;

    class BankAccountController
    {
        private $bankAccountDAO;


        public function __construct()
        {
            $this->bankAccountDAO = new BankAccountDAO;

        }
    }
    ?>