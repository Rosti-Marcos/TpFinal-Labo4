<?php

namespace Controllers;
use DAO\ChatDAO as ChatDAO;
class ChatController{
    public $chatDAO;

    public function __construct(){
        $this->chatDAO = new ChatDAO();
    }

    public function CreateTable($tableName){
        $name = $this->chatDAO->GetNameByChatIndex($tableName);
        if(empty($name)){

            $this->chatDAO->ChatCreate($tableName);
            $this->chatDAO->AddChatsIndex($tableName);
        }
    }

    public function ShowChatView($tableName){
        require_once(VIEWS_PATH."validate-session.php");
        $msgList = $this->chatDAO->GetAllByTableName($tableName);
        require_once(VIEWS_PATH . "chat-view.php");
    }

    public function SendMsg($msg, $tableName){

        $name = $_SESSION['loggedUser']->getName();
        $this->chatDAO->Add($name, $msg, $tableName);
        $this->ShowChatView($tableName);
    }

    public function TableNameGenerator($ownerId, $keeperId){
        $name = "chat_".$ownerId. "_".$keeperId;
        return $name;
    }

    public function GetChatByOwnerId($ownerId){
        $ownerChats = array();
        $userController = new UserController();
        $chatList = $this->chatDAO->GetAllFromChatIndex();
        if(!empty($chatList)) {
            foreach ($chatList as $chat) {
                $chatExplode = explode("_", $chat);
                if ($chatExplode[1] == $ownerId) {
                    $user = $userController->userDAO->GetById($chatExplode[2]);
                    $userName = $user->getName();
                    $result =['chat' => $chat, 'keeper' => $userName];
                    array_push($ownerChats, $result);
                }
            }
            if(!empty($ownerChats)){
            return $ownerChats;
            }
        }
    }

    public function GetChatByKeeperId($keeperId){
        $keeperChats = array();
        $userController = new UserController();
        $chatList = $this->chatDAO->GetAllFromChatIndex();
        if(!empty($chatList)) {
            foreach ($chatList as $chat) {
                $chatExplode = explode("_", $chat);
                if ($chatExplode[2] == $keeperId) {
                    $user = $userController->userDAO->GetById($chatExplode[1]);
                    $userName = $user->getName();
                    $result =['chat' => $chat, 'owner' => $userName];
                    array_push($keeperChats, $result);
                }
            }
            if(!empty($keeperChats)){
                return $keeperChats;
            }
        }
    }
}
?>