<?php
    namespace Controllers;

    class HomeController{


        public function Index($message = "") {
            require_once(VIEWS_PATH . "home.php");

        }

        public function ShowWellcomeView() {
            if($_SESSION["loggedUser"]->getUserTypeId() == 1){
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH . "wellcome.php");
            }else{
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH . "keeper-wellcome.php");
            }

        }

        public function Login($userName, $password) {
            $userController = new UserController();
            $user= $userController->GetUserDAO()->GetByUserName($userName);
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

        public function Logout() {

            session_destroy();

            $this->Index();
        }
    }

?>