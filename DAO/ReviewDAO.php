<?php

    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\Review as Review;
    use DAO\IReviewDAO as IReviewDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\KeeperDAO as KeeperDAO;


    class ReviewDAO implements IReviewDAO{

        private $connection;
        private $tableName = "review";

        public function Add(Review $review){
            $query = "INSERT INTO " . $this->tableName . " (owner_id, keeper_id, comment, valoration, date) 
                            VALUES (:owner_id, :keeper_id, :comment, :valoration, :date);";                
                
                $parameters["owner_id"] = $review->getOwner()->getUserId();
                $parameters["keeper_id"] = $review->getKeeper()->getKeeperId();
                $parameters["comment"] = $review->getComment();
                $parameters["valoration"] = $review->getValoration(); 
                $date = date_create(date('y-m-d'));
                $date = date_format($date, 'y-m-d');           
                $parameters["date"] = $date;  
                

                try{
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    
                } catch(Exception $ex){
                    throw $ex;
                }
        }

        public function GetAll()
        {
            $userDAO = new UserDAO();
            $keeperDAO = new KeeperDAO();
            try
            {
                $reviewList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                                        

                    $review = new Review();
                    $review->setId($row["id"]);
                    $user = $userDAO->GetById($row["owner_id"]);
                    $review->setOwner($user);
                    $keeper = $keeperDAO->GetById($row["keeper_id"]);                    
                    $review->setKeeper($keeper);
                    $review->setComment($row["comment"]);
                    $review->setValoration($row["valoration"]);                                        
                    $review->setDate($row["date"]);

                    array_push($reviewList, $review);
                }

                return $reviewList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAVG(){
            try
            {
                $reviewList = array();

                $query = "SELECT keeper_id, avg(valoration) as avgValoration FROM " .$this->tableName. " GROUP BY keeper_id";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                                        

                    $review = new Review();
                    $keeperDAO = new KeeperDAO();
                    $keeper = $keeperDAO->GetById($row["keeper_id"]);                    
                    $review->setKeeper($keeper);
                    $review->setValoration($row["avgValoration"]);                                        

                    array_push($reviewList, $review);
                }

                return $reviewList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAvgByKeeper($keeperId){
            try
            {
                $reviewList = array();

                $query = "SELECT keeper_id, avg(valoration) as avgValoration FROM " .$this->tableName. " WHERE keeper_id = ".$keeperId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                                        
                    if($row["keeper_id"] != null){
                        $review = new Review();
                        $keeperDAO = new KeeperDAO();
                        $keeper = $keeperDAO->GetById($row["keeper_id"]);                    
                        $review->setKeeper($keeper);
                        $review->setValoration($row["avgValoration"]);                                        
    
                        array_push($reviewList, $review);
                    }
                }

                return $reviewList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetReviewsByKeeper($keeperId){
            $userDAO = new UserDAO();
            $keeperDAO = new KeeperDAO();
            try
            {
                $reviewList = array();

                $query = "SELECT id, owner_id, keeper_id, comment, valoration, date, keeper_id FROM " .$this->tableName. " WHERE keeper_id = ".$keeperId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                                        

                    $review = new Review();
                    $review->setId($row["id"]);
                    $user = $userDAO->GetById($row["owner_id"]);
                    $review->setOwner($user);
                    $keeper = $keeperDAO->GetById($row["keeper_id"]);                    
                    $review->setKeeper($keeper);
                    $review->setComment($row["comment"]);
                    $review->setValoration($row["valoration"]);                                        
                    $review->setDate($row["date"]);

                    array_push($reviewList, $review);
                }

                return $reviewList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>