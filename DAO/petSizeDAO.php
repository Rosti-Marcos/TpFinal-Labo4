<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\PetSize as PetSize;
    use DAO\IPetSizeDAO as IPetSizeDAO;

    class PetSizeDAO implements IPetSizeDAO{
        private $connection;
        private $tableName = "pet_size";

        public function Add(PetSize $petSize)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (id, pet_size) VALUES (:id, :pet_size);";
                
                $parameters["id"] = $userType->getPetSizeId();
                $parameters["pet_size"] = $userType->getPetSize();                

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $petSizeList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $petSize = new PetSize();
                    $petSize->setPetSizeId($row["id"]);
                    $petSize->setPetSize($row["pet_size"]);
                    

                    array_push($petSizeList, $petSize);
                }

                return $petSizeList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($id)
        {
            try
            {           

                $query = "SELECT * FROM ".$this->tableName." WHERE id = " . $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);                
                if(!empty($resultSet)){
                $petSize = new PetSize();
                $petSize->setPetSizeId($resultSet[0]["id"]);
                $petSize->setPetSize($resultSet[0]["pet_size"]);       

                return $petSize;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>