<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\UserType as UserType;
    use DAO\IUserTypeDAO as IUserTypeDAO;

    class UserTypeDAO implements IUserTypeDAO{
        private $connection;
        private $tableName = "user_type";

        public function Add(UserType $userType)
        {
            try
            {
                $query = "INSERT INTO " . $this->tableName . " (id, type) VALUES (:id, :type);";
                
                $parameters["id"] = $userType->getUserTypeId();
                $parameters["type"] = $userType->getUserType();                

                //$this->connection = Connection::GetInstance();

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
                $userTypeList = array();

                $query = "SELECT * FROM ".$this->tableName;

                //$this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $userType = new UserType();
                    $userType->setUserTypeId($row["id"]);
                    $userType->setUserType($row["type"]);
                    

                    array_push($userTypeList, $userType);
                }

                return $userTypeList;
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
                $userType = new UserType();
                $userType->setUserTypeId($resultSet[0]["id"]);
                $userType->setUserType($resultSet[0]["type"]);       

                return $userType;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>