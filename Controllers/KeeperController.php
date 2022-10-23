<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use Models\Keeper as Keeper;


class KeeperController{
    public $keeperDAO;

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
        if ($_SESSION["loggedUser"]->getUserTypeId() == 2){
        $keeperLogged=$this->keeperDAO->GetByUserId($_SESSION["loggedUser"]->getUserId());
        }else{
            $keeperLogged=null;
        }
        require_once (VIEWS_PATH . "keeper-list.php");
        require_once(VIEWS_PATH."validate-session.php");
    }

    public function Add($petTypeId, $remuneration){
        $keeper = new Keeper;
        $keeper->setPetTypeId($petTypeId);
        $keeper->setRemuneration($remuneration);
        $this->keeperDAO->Add($keeper);
        require_once(VIEWS_PATH."keeper-wellcome.php");
    }

}
?>