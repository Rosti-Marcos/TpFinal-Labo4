<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use DAO\UserDAO as UserDAO;
use Models\Keeper as Keeper;
use Models\User as User;


class KeeperController{
    private $keeperDAO;

    public function __construct(){
        $this->keeperDAO = new KeeperDAO();
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH . "keeper-add.php");
    }

    public function ShowListView(){
        $userController = new UserController();
        $userList=$userController->userDAO->GetByUserType(2);
        $keeperList =$this->keeperDAO->GetAll();
        $keeperLogged=$this->keeperDAO->GetByUserId($_SESSION["loggedUser"]->getUserId());
        require_once (VIEWS_PATH . "keeper-list.php");
        require_once(VIEWS_PATH."validate-session.php");
    }

    public function Add($petTypeId, $remuneration){
        $keeper = new Keeper;

        $keeper->setPetTypeId($petTypeId);
        $keeper->setRemuneration($remuneration);
        $this->keeperDAO->Add($keeper);
        require_once(VIEWS_PATH."wellcome.php");
    }

}
?>