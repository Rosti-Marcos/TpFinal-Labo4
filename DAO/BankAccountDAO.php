<?php

namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    
    namespace DAO;



class BankAccountDAO{
    private $connection;
    private $tableName = "bank_account";



public function GetByUserId($userId){
        
        $query = "select balance from ". $this->tableName . " 
        WHERE user_id = '$userId'";
        
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 
            if(!empty($resultSet)){
                $balance = ($resultSet[0]["balance"]);                              
            }
        }catch(Exception $ex){
            throw $ex;
        }
        if(!empty($balance)){
            return $balance;
        }
    } 

    public function AccountDebit($userId, $amount){
                        
        $query = "UPDATE ".$this->tableName." SET balance = balance - :amount              
        WHERE user_id =:user_id;";            
        $parameters['amount'] = $amount;                        
        $parameters['user_id'] = $userId;
        try{
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            
        }catch(Exception $ex){
            throw $ex;
        }

    }   

    public function AccountCredit($keeperId, $amount){
                        
        $query = "UPDATE ".$this->tableName." SET balance = balance + :amount              
        WHERE user_id =:user_id;";            
        $parameters['amount'] = $amount;                        
        $parameters['user_id'] = $keeperId;
        try{
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            
        }catch(Exception $ex){
            throw $ex;
        }

    }   
}    
?>