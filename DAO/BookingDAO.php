<?php
    namespace DAO;

    use \Exception as Exception;        
    use DAO\Connection as Connection;
    use Models\Booking as Booking;
    use DAO\IBookingDAO as IBookingDAO;
    use Models\Keeper as Keeper;

    class BookingDAO implements IBookingDAO{
        private $connection;
        private $tableName = "booking";

        public function Add(Booking $booking)
        {
            $query = "INSERT INTO " . $this->tableName . " (owner_id, keeper_id, start_date, end_date, message, pet_id, price, status) 
            VALUES (:owner_id, :keeper_id, :start_date, :end_date, :message, :pet_id, :price, :status);";
                
            $parameters["owner_id"] = $booking->getUser()->getUserId();
            $parameters["keeper_id"] = $booking->getKeeper()->getKeeperId();
            $parameters["start_date"] = $booking->getStartDate();
            $parameters["end_date"] = $booking->getEndDate();
            $parameters["message"] = $booking->getMessage();
            $parameters["pet_id"] = $booking->getPet()->getPetId();
            $parameters["price"] = $booking->getPrice();
            $parameters["status"] = $booking->getStatus();

            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex) {
                throw $ex;
            }
        }            
            
        public function GetAll()
        {
            $userDAO = new UserDAO();
            $keeperDAO = new KeeperDAO();
            $petDAO = new PetDAO();
            $bookingList = array();
            try{
            
                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){

                    $booking = new Booking();
                    $booking->setId($row["id"]);
                    $user = $userDAO->GetById($row["owner_id"]);
                    $booking->setUser($user);
                    $keeper = $keeperDAO->GetById($row["keeper_id"]); 
                    $booking->setKeeper($keeper);
                    $booking->setStartDate($row["start_date"]);
                    $booking->setEndDate($row["end_date"]);
                    $booking->setMessage($row["message"]);
                    $pet = $petDAO->GetByPetId($row["pet_id"]);    
                    $booking->setPet($pet);
                    $booking->setPrice($row["price"]);
                    $booking->setStatus($row["status"]);                    

                    array_push($bookingList, $booking);
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            if(!empty($bookingList)){return $bookingList;}
        }
        
        public function GetById($bookingId){
            $userDAO = new UserDAO();
            $keeperDAO = new KeeperDAO();
            $petDAO = new PetDAO();
                
            $query = "SELECT * FROM ". $this->tableName . "            
            WHERE id = '$bookingId'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 

                if(!empty($resultSet)){

                    $booking = new Booking();
                    $booking->setId($resultSet[0]["id"]); 
                    $user = $userDAO->GetById($resultSet[0]["owner_id"]);
                    $booking->setUser($user);
                    $keeper = $keeperDAO->GetById($resultSet[0]["keeper_id"]); 
                    $booking->setKeeper($keeper);
                    $booking->setStartDate($resultSet[0]["start_date"]);
                    $booking->setEndDate($resultSet[0]["end_date"]);
                    $booking->setMessage($resultSet[0]["message"]);
                    $pet = $petDAO->GetByPetId($resultSet[0]["pet_id"]);
                    $booking->setPet($pet);
                    $booking->setPrice($resultSet[0]["price"]);                    
                    $booking->setStatus($resultSet[0]["status"]);                       
                }
            }catch(Exception $ex){
                throw $ex;
            }           
            if(!empty($booking)){return $booking;}
        }

        public function GetByUser($user) { 
            $bookingListByUser = array();       
            $bookingList = $this->GetAll();
            if(!empty($bookingList)){
                foreach($bookingList as $booking){
                    if($booking->getUser() == $user){
                        array_push($bookingListByUser, $booking);
                    }                
                }
            }
            if(!empty($bookingListByUser)){
            return $bookingListByUser;
            }    
        }
        
        public function GetByKeeper($keeper) { 
            $bookingListByKeeper = array();       
            $bookingList = $this->GetAll();
            foreach($bookingList as $booking){
                if($booking->getKeeper()->getUser() == $keeper){
                    array_push($bookingListByKeeper, $booking);
                }                
            }
            if(!empty($bookingListByKeeper)){
            return $bookingListByKeeper;
            }    
        }

    public function GetByKeeperId($keeperId)
    {

        $userDAO = new UserDAO();
        $keeperDAO = new KeeperDAO();
        $petDAO = new PetDAO();
        $bookingList = array();

        try {
            $query = "select * from " . $this->tableName . "            
            WHERE keeper_id = '$keeperId'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $user = $userDAO->GetById($row["owner_id"]);
                $keeper = $keeperDAO->GetById($row["keeper_id"]);
                $pet = $petDAO->GetByPetId($row["pet_id"]);

                $booking = new Booking();
                $booking->setId($row["id"]);
                $booking->setUser($user);
                $booking->setKeeper($keeper);
                $booking->setStartDate($row["start_date"]);
                $booking->setEndDate($row["end_date"]);
                $booking->setMessage($row["message"]);
                $booking->setPet($pet);
                $booking->setPrice($row["price"]);
                $booking->setStatus($row["status"]);

                array_push($bookingList, $booking);
            }

            return $bookingList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

        public function GetByStatus($status, $user = null) {
            $userBookingListByStatus = array();
            if($user == null){
                $userKeeper = $_SESSION["loggedUser"];
                $bookingListByKeeper = $this->GetByKeeper($userKeeper);
                if(!empty($bookingListByKeeper)){
                    foreach ($bookingListByKeeper as $booking){
                        if($booking->getStatus() == $status)
                        array_push($userBookingListByStatus, $booking);
                    }
                }
                if (!empty($userBookingListByStatus)){
                    return $userBookingListByStatus;
                }
            }else{
                $bookingListByUser = $this->GetByUser($user);
                if(!empty($bookingListByUser)){
                    foreach ($bookingListByUser as $booking){
                        if($booking->getStatus() == $status)
                        array_push($userBookingListByStatus, $booking);
                    }
                }
                if (!empty($userBookingListByStatus)){
                    return $userBookingListByStatus;
                }
            }
        }

        public function modifyBooking($bookingId, $message, $status){
            $query = "UPDATE ".$this->tableName." 
            SET status =:status, message=:message               
            WHERE id =:booking_id;"; 
            
            $parameters['status'] = $status; 
            $parameters['message'] = $message;           
            $parameters['booking_id'] = $bookingId;  
            
            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch(Exception $ex) {
                throw $ex;
            }
        }

    }    
?>