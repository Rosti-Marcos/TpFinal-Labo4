<?php

    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;


    class UserController{
        public $userDAO;


        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function GetUserDAO(){
            return $this->userDAO;
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH . "user-add.php");
        }

        public function GetByUserType($userType){
            return $this->userDAO->GetAll();
        }
        public function Add($name, $lastname, $userName, $password, $eMail, $phoneNumber, $birthDate){

            $user = new User;
            $user->setUserId($this->userDAO->GetNextId());
            $user->setName($name);
            $user->setUserTypeId(1);
            $user->setLastname($lastname);
            $user->setUserName($userName);
            $user->setPassword($password);
            $user->setEMail($eMail);
            $user->setPhoneNumber($phoneNumber);
            $user->setBirthDate($birthDate);
            if ($this->userDAO->GetByUserName($userName)) {

                $message = 'User name already exists, please enter a new user name';
                echo "<script>alert('$message');</script>";

                require_once(VIEWS_PATH."user-add.php");
            } else {
                $this->userDAO->Add($user);
                require_once(VIEWS_PATH."home.php");

            }
        }

        public function ShowUser(){
            require_once(VIEWS_PATH."user-profile.php");
            require_once(VIEWS_PATH."validate-session.php");
        }
    }
?>