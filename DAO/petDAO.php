<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\Pet as Pet;
    use DAO\IPetDAO as IPetDAO;
    use Models\PetType as PetType;

    class PetDAO implements IPetDAO{
        private $connection;
        private $tableName = "pet";

        public function Add(Pet $pet)
        {
            $query = "INSERT INTO " . $this->tableName . " (id, pet_name, user_id, vaccine_cert, pet_size_id, pet_pics, pet_video, pet_breed, pet_specie_id, observation) 
                          VALUES (:id, :pet_name, :user_id, :vaccine_cert, :pet_size_id, :pet_pics, :pet_video, :pet_breed, :pet_specie_id, :observation);";
                
            $parameters["id"] = "";
            $parameters["pet_name"] = $pet->getPetName();
            $parameters["user_id"] = $pet->getUser()->getUserId();
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
            $petSize = new PetSize;
            $petSpecie = new PetSpecie;
            $user = new User;
            //CONTINUAR
            $query = "select p.id, p.pet_name, u.id, p.vaccine_cert, s.pet_size_id, p.pet_pics, p.pet_video, p.pet_breed, u.phone_number, u.birth_date 
            from ". $this->tableName . " u
            inner join Pet_type t
            on u.Pet_type_id = t.id
            WHERE Pet_name = '$petName'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $pet = new Pet();
                    $pet->setPetId($resultSet[0]["id"]);
                    $petType->setPetTypeId($resultSet[0]["id"]);
                    $petType->setPetType($resultSet[0]["type"]);
                    $pet->setPetType($petType);
                    $pet->setName($resultSet[0]["name"]);
                    $pet->setLastName($resultSet[0]["lastname"]);
                    $pet->setPetName($resultSet[0]["Pet_name"]);
                    $pet->setPassword($resultSet[0]["password"]);
                    $pet->setEMail($resultSet[0]["email"]);
                    $pet->setPhoneNumber($resultSet[0]["phone_number"]);
                    $pet->setBirthDate($resultSet[0]["birth_date"]);                    
                    
                    return $pet;   
                }
            }catch(Exeption $ex){
                throw $ex;
            }
        }     
            
        public function GetAll()
        {
            try
            {
                $petList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){

                    $petTypeDAO = new PetTypeDAO;
                    $petType = $petTypeDAO->GetById($row["Pet_type"]);                     

                    $pet = new Pet();
                    $pet->setPetId($row["id"]);
                    $pet->setPetType($petType);
                    $pet->setName($row["name"]);
                    $pet->setLastName($row["lastname"]);
                    $pet->setPetName($row["Pet_name"]);
                    $pet->setPassword($row["password"]);
                    $pet->setEMail($row["email"]);
                    $pet->setPhoneNumber($row["phone_number"]);
                    $pet->setBirthDate($row["birth_date"]);                    
                    $user = new User();
                    $user->setUserId($row["id"]);//check
                    $pet->setUser($user);//check
                    array_push($petList, $pet);
                }

                return $petList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }        

    }
?>