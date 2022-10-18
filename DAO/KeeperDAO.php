<?php

namespace DAO;

use Controllers\UserController;
use Models\Keeper as Keeper;
use DAO\IKeeperDAO as IKeeperDAO;


class KeeperDAO implements IKeeperDAO {

    private $keeperList = array();
    private $fileName = ROOT . "Data/keepers.json";


    public function GetAll() {
        $this->RetrieveData();
        return $this->keeperList;
    }

    public function Add(Keeper $keeper) {
        $userController = new UserController();
        $this->RetrieveData();
        $keeper->setUserId($_SESSION["loggedUser"]->getUserId());
        $keeper->setKeeperId($this->GetNextId());
        $keeper->setStartDate(date('d-m-Y'));

        array_push($this->keeperList, $keeper);

        $this->SaveData();
        $_SESSION["loggedUser"]->setUserTypeId(2);
        $userController->GetUserDAO()->Modify( $_SESSION["loggedUser"]);
    }


    public function GetNextId() {
        $id = 0;
        foreach($this->keeperList as $keeper) {
            $id = ($keeper->getUserId() > $id) ? $keeper->getUserId() : $id;
        }
        return $id + 1;
    }

    public function GetById($id) {
        $this->RetrieveData();

        $aux = array_filter($this->keeperList, function($keeper) use($id) {
            return $keeper->getKeeperId() == $id;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }

    public function GetByUserId($userId) {
        $this->RetrieveData();

        $aux = array_filter($this->keeperList, function($keeper) use($userId) {
            return $keeper->getUserId() == $userId;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }

    private function RetrieveData() {
        $this->keeperList = array();

        if(file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayDecode as $value) {
                $keeper = new Keeper();
                $keeper->setKeeperId($value["keeperId"]);
                $keeper->setUserId($value["userId"]);
                $keeper->setPetTypeId($value["petTypeId"]);
                $keeper->setRemuneration($value["remuneration"]);
                $keeper->setStartDate($value["startDate"]);

                array_push($this->keeperList, $keeper);
            }
        }
    }
    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->keeperList as $keeper){

            $valueArray = array();
            $valueArray["keeperId"]=$keeper->getKeeperId();
            $valueArray["userId"]=$keeper->getUserId();
            $valueArray["petTypeId"]= $keeper->getPetTypeId();
            $valueArray["remuneration"] = $keeper->getRemuneration();
            $valueArray["startDate"] = $keeper->getStartDate();

            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

}
?>