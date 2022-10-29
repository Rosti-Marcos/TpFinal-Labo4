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
        $keeperList = null;
        require_once (VIEWS_PATH . "keeper-list.php");
        require_once(VIEWS_PATH."validate-session.php");
    }

    public function ShowListViewFiltered($startDate, $endDate){
        $keepers = $this->keeperDAO->GetAll();
        $serviceController = new ServiceController();
        $serviceList = $serviceController->serviceDAO->GetAvailables();
        $keeperList = array();
        foreach($serviceList as $service){
            if($startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                $keeper = $this->keeperDAO->GetByUser($service->getUser());
                array_push($keeperList, $keeper);
            }
        }
        require_once (VIEWS_PATH . "keeper-list.php");
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