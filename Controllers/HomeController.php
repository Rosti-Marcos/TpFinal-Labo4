<?php
    namespace Controllers;

use DAO\UserDAO as UserDAO;


    class HomeController{
        private $userDAO;

        public function __construct() {
            $this->userDAO = new UserDAO();
        }

        public function Index($message = "") {
            require_once(VIEWS_PATH . "home.php");

        }

        public function ShowWellcomeView() {
            require_once(VIEWS_PATH . "wellcome.php");

        }

        public function Login($userName, $password) {
            $user = $this->userDAO->GetByUserName($userName);
            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;

                $this->ShowWellcomeView();
            } else {
                $message = 'User name or password incorrect';
                echo "<script>alert('$message');</script>";
                $this->Index();
            }

        }


        public function ShowUser(){
            $user = $this->userDAO->GetByUserName($_SESSION['userName']);
            require_once(VIEWS_PATH."user-perfil.php");
        }

        public function Logout() {

            session_destroy();

            $this->Index();
        }
    }

?>