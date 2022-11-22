<?php

namespace DAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use Models\Chat as Chat;


class ChatDAO{
    private $connection;
    private $tableName = "chat";
    private $tableName2 = "chats_index";

    public function ChatCreate($tableName){
        $query = "CREATE TABLE IF NOT EXISTS ".$tableName. "(
        id int auto_increment primary key, name varchar(100), message varchar (1000), active bool, msg_date date);";

        try{
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);

        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function GetNameByChatIndex($tableName){

    $query = "SELECT chat_name FROM ".$this->tableName2. " WHERE chat_name = '$tableName' ";
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            if(!empty($resultSet)){

                $returnedName = $resultSet[0]["chat_name"];

            }
        }catch(Exception $ex){
            throw $ex;
        }
        if(!empty($returnedName)){
            return $returnedName;
        }
    }

    public function Add($name, $msg, $tableName){
        $query="INSERT INTO ".$tableName. " (name, message, active, msg_date) VALUES (:name, :message, :active, :msg_date);";
        $parameters['name'] = $name;
        $parameters['message'] = $msg;
        $parameters['active'] = 1;
        $parameters['msg_date'] = date('Y-m-d');


        try{
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function AddChatsIndex($tableName){

        $query="INSERT INTO ".$this->tableName2. " (chat_name) VALUES (:chat_name);";
        $parameters['chat_name'] = $tableName;

        try{
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function chatHider($tableName){
        $query = "UPDATE ".$tableName." SET active = :active
        WHERE active = 1;";

        $parameters['active']=0;
        try{
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetAllByTableName($tableName){
        try
        {
            $msgList = array();

            $query = "SELECT name, message, active, msg_date FROM ".$tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row){

                $msg = new Chat();
                $msg->setName($row["name"]);
                $msg->setMessage($row["message"]);
                $msg->setActive($row["active"]);
                $msg->setDate($row["msg_date"]);

                array_push($msgList, $msg);
            }
            if(!empty($msgList)) {
                return $msgList;
            }

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetAllFromChatIndex(){
        try
        {
            $tableNameList = array();

            $query = "SELECT chat_name FROM ".$this->tableName2;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row){

                $name = $row['chat_name'];


                array_push($tableNameList, $name);
            }
            if(!empty($tableNameList)) {
                return $tableNameList;
            }
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }


}
?>
