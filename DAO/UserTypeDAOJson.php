<?php

namespace DAO;

use Models\UserType as UserType;
use DAO\IUserTypeDAO as IUserTypeDAO;

class UserTypeDAOJson implements IUserTypeDAO {

    private $userTypeList = array();
    private $fileName = ROOT . "Data/userTypes.json";


    public function GetAll() {
        $this->RetrieveData();
        return $this->userTypeList;
    }

    public function Add(UserType $userType) {
        $this->RetrieveData();

        $userType->setUserTypeID($this->GetNextId());

        array_push($this->userTypeList, $userType);

        $this->SaveData();
    }


    private function GetNextId() {
        $id = 0;
        foreach($this->userTypeList as $userType) {
            $id = ($userType->getUserTypeId() > $id) ? $userType->getUserTypeID() : $id;
        }
        return $id + 1;
    }

    public function GetById($userTypeId) {
        $this->RetrieveData();

        $aux = array_filter($this->userTypeList, function($userType) use($userTypeId) {
            return $userType->getUserTypeId() == $userTypeId;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }

    private function RetrieveData() {
        $this->userTypeList = array();

        if(file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayDecode as $value) {
                $userType = new UserType();
                $userType->setUserTypeId($value["userTypeId"]);
                $userType->setUserType($value["userType"]);
                array_push($this->userTypeList, $userType);
            }
        }
    }

    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->userTypeList as $user){

            $valueArray = array();
            $valueArray["userTypeId"]=$user->getUserTypeId();
            $valueArray["userType"]= $user->getUserType();

            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

}
?>