<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\Pet as Pet;
    use DAO\IPetDAO as IPetDAO;


    class PetDAO implements IPetDAO{
        private $connection;
        private $tableName = "pet";

        public function Add(Pet $pet)
        {
            $query = "INSERT INTO " . $this->tableName . " (pet_name, user_id, vaccine_cert, pet_size_id, pet_pics, pet_video, pet_breed, pet_specie_id, observation) 
                          VALUES (:pet_name, :user_id, :vaccine_cert, :pet_size_id, :pet_pics, :pet_video, :pet_breed, :pet_specie_id, :observation);";
                
            
            $parameters["pet_name"] = $pet->getPetName();
            $parameters["user_id"] = $_SESSION['loggedUser']->getUserId();
            $parameters["vaccine_cert"] = $pet->getVaccineCert();
            $parameters["pet_size_id"] = $pet->getPetSize()->getPetSizeId();
            $parameters["pet_pics"] = $pet->getPetPics();
            $parameters["pet_video"] = $pet->getPetVideo();
            $parameters["pet_breed"] = $pet->getPetBreed();
            $parameters["pet_specie_id"] = $pet->getPetSpecie()->getPetSpecieId();
            $parameters["observation"] = $pet->getObservation();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetByPetId($petId){
            $petSizeDAO = new PetSizeDAO();
            $petSpecieDAO = new PetSpecieDAO();
            $userDAO = new UserDAO();
            
            $query = "select * from ". $this->tableName . " 
            WHERE id = '$petId'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $pet = new Pet();
                    $pet->setPetId($resultSet[0]["id"]);                    
                    $pet->setPetName($resultSet[0]["pet_name"]);
                    $user = $userDAO->GetById($resultSet[0]["user_id"]);
                    $pet->setUser($user);
                    $pet->setVaccineCert($resultSet[0]["vaccine_cert"]);
                    $petSize = $petSizeDAO->GetById($resultSet[0]['pet_size_id']);
                    $pet->setPetSize($petSize);
                    $pet->setPetPics($resultSet[0]["pet_pics"]);
                    $pet->setPetVideo($resultSet[0]["pet_video"]);
                    $pet->setPetBreed($resultSet[0]["pet_breed"]);
                    $petSpecie = $petSpecieDAO->GetById($resultSet[0]['pet_specie_id']);
                    $pet->setPetSpecie($petSpecie);
                    $pet->setObservation($resultSet[0]["observation"]);            
                }
            }catch(Exception $ex){
                throw $ex;
            }
            if($pet){
                return $pet;
            }
        }     
            
        public function GetAll(){
            $petSizeDAO = new PetSizeDAO();
            $petSpecieDAO = new PetSpecieDAO();
            $userDAO = new UserDAO();
            try
            {
                $petList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){

                    $pet = new Pet();
                    $pet->setPetId($row["id"]);                    
                    $pet->setPetName($row["pet_name"]);
                    $user = $userDAO->GetById($row["user_id"]);
                    $pet->setUser($user);
                    $pet->setVaccineCert($row["vaccine_cert"]);
                    $petSize = $petSizeDAO->GetById($row["pet_size_id"]);
                    $pet->setPetSize($petSize);
                    $pet->setPetPics($row["pet_pics"]);
                    $pet->setPetVideo($row["pet_video"]);                    
                    $pet->setPetBreed($row["pet_breed"]);
                    $petSpecie = $petSpecieDAO->GetById($row["pet_specie_id"]);
                    $pet->setPetSpecie($petSpecie);
                    $pet->setObservation($row["observation"]);
                    
                    array_push($petList, $pet);
                }

                return $petList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function GetByUser($user) { 
            $userPetList = array();       
            $petList = $this->GetAll();
            foreach($petList as $pet){
                if($pet->getUser()->getUserId() == $user->getUserId()){
                    array_push($userPetList, $pet);
                }                
            }
            if(!empty($userPetList)){
            return $userPetList;
            }    
        }

    }
?>