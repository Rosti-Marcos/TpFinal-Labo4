<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\User as User;
    use DAO\IUserDAO as IUserDAO;
    use Models\UserType as UserType;

    class UserDAOBD implements IUserDAO{
        private $connection;
        private $tableName = "user";

        public function Add(User $user)
        {
            $query = "INSERT INTO " . $this->tableName . " (user_type_id, name, lastname, user_name, password, email, phone_number, birth_date) 
                          VALUES (:user_type_id, :name, :lastname, :user_name, :password, :email, :phone_number, :birth_date);";
                
            $parameters["user_type_id"] = 1;
            $parameters["name"] = $user->getName();
            $parameters["lastname"] = $user->getLastname();
            $parameters["user_name"] = $user->getUserName();
            $parameters["password"] = $user->getPassword();
            $parameters["email"] = $user->geteMail();
            $parameters["phone_number"] = $user->getPhoneNumber();
            $parameters["birth_date"] = $user->getBirthDate();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetByUserName($userName){
            $userType = new UserType;
                    $userType->setUserTypeId(1);
                    $userType->setUserType("Owner");
                    
            $query = "SELECT * FROM ". $this->tableName . " WHERE user_name = '$userName'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 

                    $user = new User();
                    $user->setUserId($resultSet[0]["id"]);
                    $user->setUserType($userType);
                    $user->setName($resultSet[0]["name"]);
                    $user->setLastName($resultSet[0]["lastname"]);
                    $user->setUserName($resultSet[0]["user_name"]);
                    $user->setPassword($resultSet[0]["password"]);
                    $user->setEMail($resultSet[0]["email"]);
                    $user->setPhoneNumber($resultSet[0]["phone_number"]);
                    $user->setBirthDate($resultSet[0]["birth_date"]);                    
                    
                    return $user;   
            
             }catch(Exeption $ex){
                throw $ex;
            }
        }     
            
        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){

                    $userTypeDAO = new UserTypeDAO;
                    $userType = $userTypeDAO->GetById($row["user_type"]);                     

                    $user = new User();
                    $user->setUserId($row["id"]);
                    $user->setUserType($userType);
                    $user->setName($row["name"]);
                    $user->setLastName($row["lastname"]);
                    $user->setUserName($row["user_name"]);
                    $user->setPassword($row["password"]);
                    $user->setEMail($row["email"]);
                    $user->setPhoneNumber($row["phone_number"]);
                    $user->setBirthDate($row["birth_date"]);                    

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }        

    }
?>