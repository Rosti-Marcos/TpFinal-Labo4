<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\Keeper as Keeper;
    use DAO\IKeeperDAO as IKeeperDAO;
    

    class KeeperDAO implements IKeeperDAO{
        private $connection;
        private $tableName = "keeper";




        public function Add(Keeper $keeper){
            $userDAO = new UserDAO();
            $keeper->setUser($_SESSION['loggedUser']);
            $userDAO->TurnToKeeper($keeper->getUser()->getUserId());
            $query = "INSERT INTO ".$this->tableName." (user_id, pet_size_id, remuneration, start_date) 
                          VALUES (:user_id, :pet_size_id, :remuneration, :start_date);";                
            
            $parameters["user_id"] = $keeper->getUser()->getUserId();
            $parameters["pet_size_id"] = $keeper->getPetSize()->getPetSizeId();
            $parameters["remuneration"] = $keeper->getRemuneration();
            $parameters["start_date"] = date('Y-m-d');
            

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                    
            } catch(Exception $ex) {
                throw $ex;
            }
        }            
            
        public function GetAll(){

            $userDAO = new UserDAO();
            $petSizeDAO = new PetSizeDAO();
            $keeperList = array();

            try{
                
                $query = "SELECT * FROM ".$this->tableName;
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                    
                foreach ($resultSet as $row){

                    $keeper = new Keeper();                    
                    $keeper->setKeeperId($row["id"]);
                    $user = $userDAO->GetById($row['user_id']);
                    $keeper->setUser($user);
                    $petSize = $petSizeDAO->GetById($row['pet_size_id']);
                    $keeper->setPetSize($petSize);
                    $keeper->setRemuneration($row['remuneration']);                                           
                    $keeper->setStartDate($row['start_date']);  
                    array_push($keeperList, $keeper);
                }

                }
                catch(Exception $ex){
                    throw $ex;
                }
                if(!empty($keeperList)){
                    return $keeperList;
                }
            }
            
            public function GetById($keeperId){
                
                $userDAO = new UserDAO();
                $petSizeDAO = new PetSizeDAO();
                
                $query = "select * from ". $this->tableName . "            
                WHERE id = '$keeperId'";
                
                try{
                    $this->connection = Connection::GetInstance();
                    $resultSet = $this->connection->Execute($query); 
                    if(!empty($resultSet)){
                        $keeper = new Keeper();
                        $keeper->setKeeperId($resultSet[0]["id"]); 
                        $user = $userDAO->GetbyId($resultSet[0]['user_id']);                   
                        $keeper->setUser($user);
                        $petSize = $petSizeDAO->GetbyId($resultSet[0]['pet_size_id']);
                        $keeper->setPetSize($petSize);
                        $keeper->setRemuneration($resultSet[0]["remuneration"]);
                        $keeper->setStartDate($resultSet[0]["start_date"]);
                                               
                    }
                }catch(Exception $ex){
                    throw $ex;
                }           
                if(!empty($keeper)){
                    return $keeper;
                }
            }

            public function GetByUser($user) { 
                       
                $keeperList = $this->GetAll();
                foreach($keeperList as $keeper){
                    if($keeper->getUser()->getUserId() == $user->getUserId()){
                        return ($keeper);
                    }                
                }
                    
            }
            
              
    }