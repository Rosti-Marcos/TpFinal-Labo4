<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\Service as Service;
    use DAO\IServiceDAO as IServiceDAO;
    use Models\User as User;
    use Models\UserType as UserType;

    class ServiceDAO implements IServiceDAO{
        private $connection;
        private $tableName = "service";

        public function Add(Service $service)
        {
            $query = "INSERT INTO " . $this->tableName . " (id, user_id, start_date, end_date, status) 
                          VALUES (:id, :user_id, :start_date, :end_date, :status);";
                
            $parameters["id"] = "";
            $parameters["user_id"] = $service->getUser()->getUserId();
            $parameters["start_date"] = $service->getStartDate();
            $parameters["end_date"] = $service->getEndDate();
            $parameters["status"] = $service->getStatus();            

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetById($serviceId){//PROBAR!!!!!!!
            $user = new User;
            $userType = new UserType;

            $query = "select s.id, u.id, u.name, u.lastname, u.user_name, u.password, u.email, u.phone_number, u.birth_date, s.strat_date, s-end_date, s.status 
            from ". $this->tableName . " s
            inner join user u
            on s.user_id = u.id
            where s.id = '$serviceId'
            UNION
            select t.id, t.type
            from user_type t
            inner join user u
            on u.user_type_id = t.id";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $service = new Service();
                    $service->setId($resultSet[0]["id"]);
                    $user->setUserId($resultSet[0]["id"]);
                    $user->setname($resultSet[0]["name"]);
                    $user->setLastname($resultSet[0]["lastname"]);
                    $user->setUserName($resultSet[0]["user_name"]);
                    $user->setPassword($resultSet[0]["password"]);
                    $user->setEMail($resultSet[0]["email"]);
                    $user->setPhoneNumber($resultSet[0]["phone_number"]);
                    $user->setBirthDate($resultSet[0]["birth_date"]);
                    $service->setStartDate($resultSet[0]["start_date"]);
                    $service->setEndDate($resultSet[0]["end_date"]);
                    $service->setStatus($resultSet[0]["status"]);
                    $userType->setUserTypeId($resultSet[0]["id"]);
                    $userType->setUserType($resultSet[0]["type"]);
                    $user->setUserType($userType);
                    $service->setUser($user);                     
                    
                    return $service;   
                }
            }catch(Exeption $ex){
                throw $ex;
            }
        }     
            
        public function GetAll()
        {
            try
            {
                $serviceList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){

                    $serviceTypeDAO = new ServiceTypeDAO;
                    $serviceType = $serviceTypeDAO->GetById($row["Service_type"]);                     

                    $service = new Service();
                    $service->setServiceId($row["id"]);
                    $service->setServiceType($serviceType);
                    $service->setName($row["name"]);
                    $service->setLastName($row["lastname"]);
                    $service->setServiceName($row["Service_name"]);
                    $service->setPassword($row["password"]);
                    $service->setEMail($row["email"]);
                    $service->setPhoneNumber($row["phone_number"]);
                    $service->setBirthDate($row["birth_date"]);                    

                    array_push($serviceList, $service);
                }

                return $serviceList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }        

    }
?>