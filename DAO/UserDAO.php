<?php

    namespace DAO;

    use Models\User as User;
    use DAO\IUserDAO as IUserDAO;


    class UserDAO implements IUserDAO {

        private $userList = array();
        private $fileName = ROOT . "Data/users.json";


        public function GetAll() {
            $this->RetrieveData();
            return $this->userList;
        }

        public function Add(User $user) {
            $userTypeDAO = new UserTypeDAO;
            $userType = $userTypeDAO->GetById(1);
           
            $this->RetrieveData();
            $user->setUserId($this->GetNextId());
            $user->setUserType($userType);
            array_push($this->userList, $user);

            $this->SaveData();
        }


        public function GetNextId() {
            $id = 0;
            foreach($this->userList as $user) {
                $id = ($user->getUserId() > $id) ? $user->getUserId() : $id;
            }
            return $id + 1;
        }

        public function GetById($userId) {
            $this->RetrieveData();
    
            $aux = array_filter($this->userList, function($user) use($userId) {
                return $user->getUserId() == $userId;
            });
    
            $aux = array_values($aux);
    
            return (count($aux) > 0) ? $aux[0] : array();
        }

        public function GetByUserName($userName) {
            $this->RetrieveData();

            $aux = array_filter($this->userList, function($user) use($userName) {
                return $user->getUserName() == $userName;
            });

            $aux = array_values($aux);

            return (count($aux) > 0) ? $aux[0] : array();
        }

        private function RetrieveData() {
            $this->userList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $user = new User();
                    $user->setUserId($value["userId"]);
                    $user->setName($value["name"]);
                    $user->setLastname($value["lastname"]);
                    $user->setUserName($value["userName"]);
                    $user->setPassword($value["password"]);
                    $user->setEMail($value["eMail"]);
                    $user->setPhoneNumber($value["phoneNumber"]);
                    $user->setBirthDate($value["birthDate"]);

                    $userTypeDAO = new UserTypeDAO;
                    $userType = $userTypeDAO->GetById($value["userType"]);
                    $user->setUserType($userType);

                    array_push($this->userList, $user);
                }
            }
        }
        private function SaveData() {

            $arrayEncode = array();

            foreach ($this->userList as $user){

                $valueArray = array();
                $valueArray["userId"]=$user->getUserId();
                $valueArray["userType"]=$user->getUserType()->getUserTypeId();
                $valueArray["name"]= $user->getName();
                $valueArray["lastname"] = $user->getLastname();
                $valueArray["userName"] = $user->getUserName();
                $valueArray["password"] = $user->getPassword();
                $valueArray["eMail"] = $user->getEMail();
                $valueArray["phoneNumber"] = $user->getPhoneNumber();
                $valueArray["birthDate"] = $user->getBirthDate();

                array_push($arrayEncode, $valueArray);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        public function Modify(User $newUser) {
            $this->RetrieveData();

            $this->userList = array_filter($this->userList, function($user) use($newUser) {
                return $user->getUserId() != $newUser->getUserId();
            });

            array_push($this->userList, $newUser);

            $this->SaveData();
        }

        public function TurnToKeeper (User $newUser) {
            $this->RetrieveData();
            $userTypeDAO = new UserTypeDAO;
            $userType = $userTypeDAO->GetById(2);
            $newUser->setUserType($userType);
            $this->userList = array_filter($this->userList, function($user) use($newUser) {
                return $user->getUserId() != $newUser->getUserId();
            });

            array_push($this->userList, $newUser);

            $this->SaveData();
        }

    }
?>