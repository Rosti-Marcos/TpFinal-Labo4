<?php

namespace DAO;

use Models\BankAccount as BankAccount;
use DAO\IBankAccountDAO as IBankAccountDAO;


class BankAccountDAO implements IBankAccountDAO{

    private $bankAccountList = array();
    private $fileName = ROOT . "Data/bankAccounts.json";

    function GetAll(){
        $this->RetrieveData();
        return $this->bankAccountList;
    }

    public function GetById($id) {
        $this->RetrieveData();

        $aux = array_filter($this->bankAccountList, function($bankAccount) use($id) {
            return $bankAccount->getId() == $id;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }

    function Add(BankAccount $bankAccount){

        $this->RetrieveData();

        $bankAccount->setId($this->GetNextId());

        array_push($this->bankAccountList, $bankAccount);

        $this->SaveData();

    }

    private function GetNextId() {
        $id = 0;
        foreach($this->bankAccountList as $bankAccount) {
            $id = ($bankAccount->getId() > $id) ? $bankAccount->getId() : $id;
        }
        return $id + 1;
    }

    public function RetrieveData() {
        $this->bankAccountList = array();

        if(file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayDecode as $value) {

                $userDAO = new UserDAO;
                $user = $userDAO->GetById($value["user"]);
               
                $bankAccount = new BankAccount();
                $bankAccount->setId($value["id"]);
                $bankAccount->setUser($user);
                $bankAccount->setAccountNbr($value["accountNbr"]);
                $bankAccount->setPrice($value["price"]);
                              
                array_push($this->bankAccountList, $bankAccount);
            }
        }
    }

    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->bankAccountList as $bankAccount){

            $valueArray = array();
            $valueArray["id"]= $bankAccount->getId();
            $valueArray["user"]= $bankAccount->getUser()->getUserId();
            $valueArray["accountNbr"] = $bankAccount->getAccountNbr();
            $valueArray["price"] = $bankAccount->getPrice();
            
            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

}
?>