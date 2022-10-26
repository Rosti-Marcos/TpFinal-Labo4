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
        $petSizeController = new PetSizeController();
        $petSizeList = $petSizeController->petSizeDAO->GetAll();
        require_once(VIEWS_PATH . "keeper-add.php");
        require_once(VIEWS_PATH."validate-session.php");
    }

    public function ShowListView(){
        $keeperList =$this->keeperDAO->GetAll();
        if ($_SESSION["loggedUser"]->getUserTypeId() == 2){
        $keeperLogged=$this->keeperDAO->GetByUser($_SESSION["loggedUser"]);
        }else{
            $keeperLogged=null;
        }
        require_once (VIEWS_PATH . "keeper-list.php");
        require_once(VIEWS_PATH."validate-session.php");
    }

    public function Add($petSizeId, $remuneration){
        $petSizeController = new PetSizeController;
        $petSize=$petSizeController->petSizeDAO->GetById($petSizeId);
        $keeper = new Keeper;
        $keeper->setPetSize($petSize);
        $keeper->setRemuneration($remuneration);
        $this->keeperDAO->Add($keeper);
        require_once(VIEWS_PATH."keeper-wellcome.php");
    }

}
?>