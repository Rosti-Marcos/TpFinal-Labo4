<?php

    namespace DAO;

    use Models\Service as Service;
    use DAO\IServiceDAO as IServiceDAO;

    class ServiceDAO implements IServiceDAO{

        public $serviceList = array();
        private $fileName = ROOT . "Data/service.json";


        public function GetAll() {
            $this->RetrieveData();
            return $this->serviceList;
        }

        public function Add(Service $service) {
            $this->RetrieveData();

            $service->setId($this->GetNextId());

            array_push($this->serviceList, $service);

            $this->SaveData();
        }


        private function GetNextId() {
            $id = 0;
            foreach($this->serviceList as $service) {
                $id = ($service->getId() > $id) ? $service->getId() : $id;
            }
            return $id + 1;
        }


        private function RetrieveData() {
            $this->serviceList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $service = new service();
                    $service->setUserId($value["userId"]);
                    $service->setStartDate($value["startDate"]);
                    $service->setEndDate($value["endDate"]);
                    $service->setStatus($value["status"]);

                    array_push($this->serviceList, $service);
                }
            }
        }
        private function SaveData() {

            $arrayEncode = array();

            foreach ($this->serviceList as $service){

                $valueArray = array();
                $valueArray["id"] = $service->getId();
                $valueArray["userId"] = $service->getUserId();
                $valueArray["startDate"]= $service->getStartDate();
                $valueArray["endDate"] = $service->getEndDate();
                $valueArray["status"] = $service->getStatus();


                array_push($arrayEncode, $valueArray);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }
    }
?>