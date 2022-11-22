<?php

namespace Controllers;

use DAO\KeeperDAO as KeeperDAO;
use Models\Keeper as Keeper;
use Models\UserType as UserType;
use Controllers\ReviewController as ReviewController;

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
        $keeperList = $this->keeperDAO->GetAll();
        $reviewController = new ReviewController();
        $avgList = $reviewController->reviewDAO->GetAVG();
        require_once (VIEWS_PATH . "keeper-list.php");
        require_once(VIEWS_PATH."validate-session.php");
    }

    public function ShowListViewFiltered($startDate, $endDate){
        $keepers = $this->keeperDAO->GetAll();
        $serviceController = new ServiceController();
        $serviceList = $serviceController->serviceDAO->GetAvailables();
        $keeperList = array();
        if(!empty($serviceList)){
            foreach($serviceList as $service){
                if($startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                    $keeper = $this->keeperDAO->GetByUser($service->getUser());
                    array_push($keeperList, $keeper);
                }
            }
        }
        require_once (VIEWS_PATH . "keeper-list.php");
    }

    public function Add($petSizeId, $remuneration){
        $userType = new UserType();
        $userType->setUserTypeId(2);
        $userType->setUserType("Keeper");
        $petSizeController = new PetSizeController;
        $petSize=$petSizeController->petSizeDAO->GetById($petSizeId);
        $keeper = new Keeper;
        $keeper->setPetSize($petSize);
        $keeper->setRemuneration($remuneration);
        $_SESSION["loggedUser"]->setUserType($userType);
        $this->keeperDAO->Add($keeper);
        require_once(VIEWS_PATH."keeper-wellcome.php");
    }

}
?>