<?php

    namespace DAO;

    use Models\Service as Service;
    use DAO\IServiceDAO as IServiceDAO;

    class ServiceDAO implements IServiceDAO{

        public $serviceList = array();
        private $fileName = ROOT . "Data/services.json";


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
                    $service->setId($value["id"]);
                    $service->setStartDate($value["startDate"]);
                    $service->setEndDate($value["endDate"]);
                    $service->setStatus($value["status"]);
                    
                    $userDAO = new UserDAO;
                    $user = $userDAO->GetById($value["user"]);
                    $service->setUser($user);
                    array_push($this->serviceList, $service);
                }
            }
        }
        private function SaveData() {

            $arrayEncode = array();

            foreach ($this->serviceList as $service){

                $valueArray = array();
                $valueArray["id"] = $service->getId();
                $valueArray["user"] = $service->getUser()->getUserId();
                $valueArray["startDate"]= $service->getStartDate();
                $valueArray["endDate"] = $service->getEndDate();
                $valueArray["status"] = $service->getStatus();


                array_push($arrayEncode, $valueArray);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }


        public function GetByKeeperId($keeperId) {
            $this->RetrieveData();
            $aux = array_filter($this->serviceList, function($service) use($keeperId) {
                return $service->getUser()->getUserId() == $keeperId;
            });
            $aux = array_values($aux);
            return (count($aux) > 0) ? $aux : array();
    
        }

        public function GetById($id) {
            $this->RetrieveData();
    
            $aux = array_filter($this->serviceList, function($service) use($id) {
                return $service->getId() == $id;
            });
    
            $aux = array_values($aux);
    
            return (count($aux) > 0) ? $aux[0] : array();
        }

        public function modifyService($serviceId, $status){
            $this->RetrieveData();
            $newService = $this->GetById($serviceId);
            $newService->setStatus($status);
            $this->serviceList = array_filter($this->serviceList, function($service) use($newService) {
                return $service->getId() != $newService->getId();
            });

            array_push($this->serviceList, $newService);

            $this->SaveData();
        }

        public function Remove($id)
        {            
            $this->RetrieveData();
            
            $this->serviceList = array_filter($this->serviceList, function($service) use($id){                
                return $service->getId() != $id;
            });
            
            $this->SaveData();
        }
    }
?>