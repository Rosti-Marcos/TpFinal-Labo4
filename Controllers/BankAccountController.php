<?php
    namespace Controllers;

    use DAO\BankAccountDAO as BankAccountDAO;

    class BankAccountController
    {
        public $bankAccountDAO;


        public function __construct()
        {
            $this->bankAccountDAO = new BankAccountDAO();

        }

        public function CheckBalance ($amount, $userId){
            $balance = $this->bankAccountDAO->GetByUserId($userId);
            if(!empty($balance)){
                if($amount<= $balance){
                    return true;
                }
            }
            return false;
        }
    }
    ?>