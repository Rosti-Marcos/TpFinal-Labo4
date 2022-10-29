<?php

namespace DAO;

use Models\Review as Review;
use DAO\IReviewDAO as IReviewDAO;


class ReviewDAO implements IReviewDAO{

    private $reviewList = array();
    private $fileName = ROOT . "Data/reviews.json";

    function GetAll(){
        $this->RetrieveData();
        return $this->reviewList;
    }

    public function GetById($id) {
        $this->RetrieveData();

        $aux = array_filter($this->reviewList, function($review) use($id) {
            return $review->getId() == $id;
        });

        $aux = array_values($aux);

        return (count($aux) > 0) ? $aux[0] : array();
    }

    function Add(Review $review){

        $this->RetrieveData();

        $review->setId($this->GetNextId());

        array_push($this->reviewList, $review);

        $this->SaveData();

    }

    private function GetNextId() {
        $id = 0;
        foreach($this->reviewList as $review) {
            $id = ($review->getId() > $id) ? $review->getId() : $id;
        }
        return $id + 1;
    }

    public function RetrieveData() {
        $this->reviewList = array();

        if(file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);
            $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayDecode as $value) {

                $userDAO = new UserDAO;
                $owner = $userDAO->GetById($value["owner"]);
                $keeper = $userDAO->GetById($value["keeper"]);
               
                $review = new Review();
                $review->setId($value["id"]);
                $review->setOwner($owner);
                $review->setKeeper($keeper);
                $review->setDescription($value["description"]);
                $review->setDate($value["date"]);
                $review->setValoration($value["valoration"]);
                
                array_push($this->reviewList, $review);
            }
        }
    }

    private function SaveData() {

        $arrayEncode = array();

        foreach ($this->reviewList as $review){

            $valueArray = array();
            $valueArray["id"]= $review->getId();
            $valueArray["owner"]= $review->getOwner()->getUserId();
            $valueArray["keeper"] = $review->getKeeper()->getUserId();
            $valueArray["description"] = $review->getDescription();
            $valueArray["valoration"] = $review->getValoration();
            
            array_push($arrayEncode, $valueArray);
        }
        $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

}
?>