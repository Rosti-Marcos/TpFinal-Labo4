<?php
    namespace Controllers;

    use DAO\ServiceDAO as ServiceDAO;
    use Models\Service as Service;

    class ServiceController
    {
        private $serviceDAO;

        public function __construct()
        {
            $this->serviceDAO = new serviceDAO();
        }

        public function ShowAvailabilityView()
        {
    
            require_once(VIEWS_PATH."keeper-availability.php");
        }

        public function ShowListView()
        {
 
            $serviceList = $this->serviceDAO->getAll();

            require_once(VIEWS_PATH."example.php");
        }

        public function Add($startDate, $endDate, $status){
            $userId = $_SESSION["loggedUser"]->getUserId();
            $serviceList = $this->serviceDAO->getAll();
            if($endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                echo "<script>alert('$message');</script>";
            }else{
                $flag = 0; 
                foreach($serviceList as $service){
                    if($service->getUserId() == $userId && $startDate <= $service->getEndDate() && $endDate >= $service->getStartDate()){
                        $flag = 1; 
                    }
                }
                if(!$serviceList || $flag == 0){
                    $service = new service();
                    $service->setUserId($userId);
                    $service->setStartDate($startDate);
                    $service->setEndDate($endDate);
                    $service->setStatus($status);
                    $this->serviceDAO->Add($service);

                    $message = 'Your availability has been successfully set';
                    echo "<script>alert('$message');</script>";
                }else if($flag == 1){
                    $message = 'Some of the dates entered had already been loaded. Please enter different dates.'; 
                    echo "<script>alert('$message');</script>";
                } 
            }   
            $serviceList = $this->serviceDAO->getAll();
            $this->ShowAvailabilityView();
        }

        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->servicerDAO->Remove($id);

            $this->ShowAvailabilityView();
        }

        public function getServices(){
            $serviceList = $this->serviceDAO->getAll();
            return $serviceList;
        }
    }
?>