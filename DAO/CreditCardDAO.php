<?php

namespace DAO;
use \Exception as Exception;        
use DAO\Connection as Connection; 
use Models\CreditCard as CreditCard;

class CreditCardDAO{
    private $connection;
    private $tableName = "credit_card";
    
    
    

    public function GetByCardNbr($cardNbr){
            $userDAO = new UserDAO();
            
            $query = "select * from ". $this->tableName . " 
            WHERE number = '$cardNbr'";
            
            try{
               $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 
            if(!empty($resultSet)){
                $creditCard = new CreditCard();
                $creditCard->setId($resultSet[0]["id"]); 
                $user = $userDAO->GetById($resultSet[0]["user_id"]);               
                $creditCard->setUser($user);
                $creditCard->setCardNrb($resultSet[0]["number"]);
                $creditCard->setCcv($resultSet[0]["ccv"]);  
            }
            }catch(Exception $ex){
                throw $ex;
            }
            if(!empty($creditCard)){
                return $creditCard;
            }
        } 
    }    
    ?>