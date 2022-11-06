<?php
    namespace Controllers;

use DAO\UserDAO;

    class HomeController{


        public function Index($message = "") {
            require_once(VIEWS_PATH . "home.php");

        }

        public function ShowWellcomeView() {
            if($_SESSION["loggedUser"]->getUserType()->getUserTypeId() == 1){
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH . "wellcome.php");
            }else{
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH . "keeper-wellcome.php");
            }

        }

        public function Login($userName, $password) {
            $userDAO = new UserDAO;
            $user= $userDAO->GetByUserName($userName);
            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;

                $this->ShowWellcomeView();
            } else {
                $message = "User name or password incorrect";
                //echo ;
                $this->Index($message);
            }

        }

        
        public function PaymentLogin($userName, $password) {
            $userDAO = new UserDAO;
            $user= $userDAO->GetByUserName($userName);
            $_SESSION["loggedUser"] = $user;
        }

        public function Logout() {

            session_destroy();

            $this->Index();
        }
    }

?>