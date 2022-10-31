<?php

    namespace DAO;

    use Models\CreditCard as CreditCard;
    use DAO\ICreditCardDAO as ICreditCardDAO;

    class CreditCardDAO implements ICreditCardDAO{

        public $creditCardList = array();
        private $fileName = ROOT . "Data/creditCards.json";


        public function GetAll() {
            $this->RetrieveData();
            return $this->creditCardList;
        }

        public function GetByUser($user)
        {
            $this->RetrieveData();

            $creditCard = array_filter($this->creditCardList, function($creditCard) use($user){                
                return $creditCard->getUser() == $user;
            });

            $creditCard = array_values($creditCard);
            

            return (count($creditCard) > 0) ? $creditCard : array();
        }

        public function GetById($id) {
            $this->RetrieveData();
    
            $aux = array_filter($this->creditCardList, function($creditCard) use($id) {
                return $creditCard->getId() == $id;
            });
    
            $aux = array_values($aux);
    
            return (count($aux) > 0) ? $aux[0] : array();
        }

        public function Add(CreditCard $creditCard) {
            $this->RetrieveData();

            $creditCard->setId($this->GetNextId());

            array_push($this->creditCardList, $creditCard);

            $this->SaveData();
        }


        private function GetNextId() {
            $id = 0;
            foreach($this->creditCardList as $creditCard) {
                $id = ($creditCard->getId() > $id) ? $creditCard->getId() : $id;
            }
            return $id + 1;
        }

        private function RetrieveData() {
            $this->creditCardList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $userDAO = new UserDAO;
                    $user = $userDAO->GetById($value["user"]);
                    
                    $creditCard = new CreditCard();
                    $creditCard->setId($value["id"]);
                    $creditCard->setUser($user);
                    $creditCard->setCardNrb($value["cardNbr"]);
                    $creditCard->setCcv($value["ccv"]);
                    $creditCard->setExpirationDate($value["expirationDate"]);

                    array_push($this->creditCardList, $creditCard);
                }
            }
        }
        
        private function SaveData() {

            $arrayEncode = array();

            foreach ($this->creditCardList as $creditCard){

                $valueArray = array();
                $valueArray["id"] = $creditCard->getId();
                $valueArray["user"] = $creditCard->getUser()->getUserId();
                $valueArray["cardNbr"] = $creditCard->getCardNbr();
                $valueArray["ccv"]= $creditCard->getCcv();
                $valueArray["expirationDate"] = $creditCard->getExpirationDate();


                array_push($arrayEncode, $valueArray);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }
    }
?>