<?php

namespace Models;

class User{

    private $userId;
    private $userType;
    private $name;
    private $lastname;
    private $userName;
    private $password;
    private $eMail;
    private $phoneNumber;
    private $birthDate;


    public function getUserId(){
        return $this->userId;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getUserType(){
        return $this->userType;
    }

    public function setUserType(UserType $userType){
        $this->userType = $userType;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function setUserName($userName){
        $this->userName = $userName;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getEMail(){
        return $this->eMail;
    }

    public function setEMail($eMail){
        $this->eMail = $eMail;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }

    public function getBirthDate(){
        return $this->birthDate;
    }

    public function setBirthDate($birthDate){
        $this->birthDate = $birthDate;
    }

}
?>