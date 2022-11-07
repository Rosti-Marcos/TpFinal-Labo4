<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\Service as Service;
    use DAO\IServiceDAO as IServiceDAO;    
    use DAO\UserDAO as UserDAO;

    class ServiceDAO implements IServiceDAO{

        private $connection;
        private $tableName = "service";

        public function Add(Service $service){            
            
            $query = "INSERT INTO " . $this->tableName . " (user_id, start_date, end_date, status) 
                          VALUES (:user_id, :start_date, :end_date, :status);";                
            
            $parameters["user_id"] = $service->getUser()->getUserId();
            $parameters["start_date"] = $service->getStartDate();
            $parameters["end_date"] = $service->getEndDate();
            $parameters["status"] = $service->getStatus();            

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex){
                throw $ex;
            }
        }
        
        public function GetAll()
        {
            $userDAO = new UserDAO();
            try
            {
                $serviceList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                                        

                    $service = new Service();
                    $service->setId($row["id"]);
                    $user = $userDAO->GetById($row["user_id"]);
                    $service->setUser($user);                    
                    $service->setStartDate($row["start_date"]);
                    $service->setEndDate($row["end_date"]);
                    $service->setStatus($row["status"]);                                        

                    array_push($serviceList, $service);
                }

                return $serviceList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAvailables() {
            $availableList = array();
            $available = 'available';
            $serviceList = $this->GetAll();
            foreach($serviceList as $service){
                if($service->getStatus() == $available){
                    array_push($availableList, $service);
                }
            }
            if(!empty($availableList)){
            return $availableList;
            }
        }

        public function GetAvailablesByKeeper($userId) {
            $availableList = array();
            $available = 'available';
            $serviceList = $this->GetAll();
            foreach($serviceList as $service){
                if($service->getUser()->getUserId() == $userId){
                    if($service->getStatus() == $available){
                        array_push($availableList, $service);
                    }
                }
            }
            if(!empty($availableList)){
            return $availableList;
            }
        }
        
        public function GetByKeeperId($keeperId){
            $userDAO = new UserDAO();
            
            $query = "select * from ". $this->tableName . " 
            WHERE user_id = '$keeperId'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $service = new Service();
                    $service->setId($resultSet[0]["id"]);       
                    $user = $userDAO->GetById($resultSet[0]["user_id"]);
                    $service->setUser($user);
                    $service->setStartDate($resultSet[0]["start_date"]);
                    $service->setEndDate($resultSet[0]['end_date']);                    
                    $service->setStatus($resultSet[0]["status"]);                                
                }

            }catch(Exception $ex){
                throw $ex;
            }
            if(!empty($service)){
                return $service;
            }
    
        }

        public function GetById($serviceId){
            
            $userDAO = new UserDAO();
            
            $query = "select * from ". $this->tableName . " 
            WHERE id = '$serviceId'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $service = new Service();
                    $service->setId($resultSet[0]["id"]);       
                    $user = $userDAO->GetById($resultSet[0]["user_id"]);
                    $service->setUser($user);
                    $service->setStartDate($resultSet[0]["start_date"]);
                    $service->setEndDate($resultSet[0]['end_date']);                    
                    $service->setStatus($resultSet[0]["status"]);
                                
                }
            }catch(Exception $ex){
                throw $ex;
            }
            if($service){
                return $service;
            }
        } 
        
        public function modifyService($serviceId, $status){
            $query = "UPDATE ".$this->tableName." SET status =:status               
            WHERE id =:service_id;"; 
            $parameters['status'] = $status;           
            $parameters['service_id'] = $serviceId;                        
            
            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function Remove($serviceId)
        {            
            $query = "DELETE FROM ".$this->tableName."                
            WHERE id =:service_id;"; 
                       
            $parameters['service_id'] = $serviceId;                        
            
            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex) {
                throw $ex;
            }
        }

    }
?>