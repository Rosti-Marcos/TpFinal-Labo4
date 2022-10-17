<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use Models\Keeper as Keeper;


class KeeperController{
    private $keeperDAO;

    public function __construct(){
        $this->keeperDAO = new KeeperDAO();
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH . "keeper-add.php");
    }

    public function ShowHomeView(){
        require_once(VIEWS_PATH . "home.php");
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