<?php

namespace DAO;

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
        
        $this->RetrieveData();
    
        $keeper->setUser($_SESSION["loggedUser"]);
        $keeper->setKeeperId($this->GetNextId());
        $keeper->setStartDate(date('d-m-Y'));

        array_push($this->keeperList, $keeper);

        $this->SaveData();
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

    public function GetByUser($user) {
        $this->RetrieveData();

        $aux = array_filter($this->keeperList, function($keeper) use($user) {
            return $keeper->getUser() == $user;
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
               
                $keeper->setPetSize($value["petSize"]);
                $keeper->setRemuneration($value["remuneration"]);
                $keeper->setStartDate($value["startDate"]);

                $userDAO = new UserDAO;
                $user = $userDAO->GetById($value["user"]);
                $petSizeDAO = new PetSizeDAO;
                $petSize = $petSizeDAO->GetById($value["petSize"]);
                $keeper->setUser($user);
                $keeper->setPetSize($petSize);

                array_push($this->keeperList, $keeper);
            }
        }
    }
    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->keeperList as $keeper){

            $valueArray = array();
            $valueArray["keeperId"]=$keeper->getKeeperId();
            $valueArray["user"]=$keeper->getUser()->getUserId();
            $valueArray["petSize"]= $keeper->getPetSize()->getPetSizeId();
            $valueArray["remuneration"] = $keeper->getRemuneration();
            $valueArray["startDate"] = $keeper->getStartDate();

            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

}
?>