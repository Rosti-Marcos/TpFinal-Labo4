<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\PetSpecie as PetSpecie;
    use DAO\IPetSpecieDAO as IPetSpecieDAO;

    class PetSpecieDAO implements IPetSpecieDAO{
        private $connection;
        private $tableName = "pet_specie";

        public function Add(PetSpecie $petSpecie)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (id, pet_specie) VALUES (:id, :pet_specie);";
                
                $parameters["id"] = $petSpecie->getPetSpecieId();
                $parameters["pet_specie"] = $petSpecie->getPetSpecie();                

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
                $petSpecieList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                
                    $petSpecie= new PetSpecie();
                    $petSpecie->setPetSpecieId($row["id"]);
                    $petSpecie->setPetSpecie($row["pet_specie"]);                    

                    array_push($petSpecieList, $petSpecie);
                }

                return $petSpecieList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($id){
            try{
                $petSpecieList = array();

                $query = "SELECT * FROM ".$this->tableName."WHERE id = " . $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);                
                if(!empty($resultSet)){
                $petSpecie= new PetSpecie();
                $petSpecie->setPetSpecieId($resultSet["id"]);
                $petSpecie->setPetSpecie($resultSet["pet_specie"]);       

                return $petSpecieList;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>