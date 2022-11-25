<?php

    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;



    class UserController{
        public $userDAO;


        public function __construct(){
            $this->userDAO = new UserDAO();
        }


        public function ShowAddView($message = ""){
            require_once(VIEWS_PATH . "user-add.php");
        }

        public function Add($name, $lastname, $userName, $password, $eMail, $phoneNumber, $birthDate){
        
            $user = new User;
            $user->setName($name);
            $user->setLastname($lastname);
            $user->setUserName($userName);
            $user->setPassword($password);
            $user->setEMail($eMail);
            $user->setPhoneNumber($phoneNumber);
            $user->setBirthDate($birthDate);
            if (!empty($this->userDAO->GetByUserName($userName))) {

                $message = 'User name already exists, please enter a new user name';
                $this->ShowAddView("$message");
            
            } else if (!empty($this->userDAO->GetByEmail($eMail))) {
                $message = 'The email already exists, please enter a new email';
                $this->ShowAddView("$message");
        
            } else {
                $row = $this->userDAO->Add($user);
                $message = "The record has been uploaded successfully, ' $row ' row is affected";
                $homeController = new HomeController();
                $homeController->Index("$message");

            }
        }

        public function ShowUserProfile(){
            $user = $_SESSION["loggedUser"];
            require_once(VIEWS_PATH."user-profile.php");
            require_once(VIEWS_PATH."validate-session.php");
        }


    }
