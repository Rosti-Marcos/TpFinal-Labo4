<?php
    namespace Controllers;

    use DAO\ServiceDAO as ServiceDAO;
    use Models\Service as Service;

    class ServiceController
    {
        public $serviceDAO;

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
            require_once(VIEWS_PATH."example.php");
        }

        public function Add($startDate, $endDate, $status, $keeper = NULL){
            $userController = new UserController();
            $user = $keeper != null ? $userController->userDAO->GetById($keeper) : $_SESSION["loggedUser"];
            $serviceList = $this->serviceDAO->getAll();
            if($keeper == null && $endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                echo "<script>alert('$message');</script>";
            }else{
                $flag = 0; 
                foreach($serviceList as $service){
                    if($service->getUser() == $user && $startDate <= $service->getEndDate() && $endDate >= $service->getStartDate()){
                        $flag = 1; 
                    }
                }
                if(!$serviceList || $flag == 0){
                    $service = new service();
                    $service->setUser($user);
                    $service->setStartDate($startDate);
                    $service->setEndDate($endDate);
                    $service->setStatus($status);
                    $this->serviceDAO->Add($service);
                    
                    if($keeper == null){
                        $message = 'Your availability has been successfully set';
                        echo "<script>alert('$message');</script>";
                    }
                }else if($flag == 1){
                    $message = 'Some of the dates entered had already been loaded. Please enter different dates.'; 
                    echo "<script>alert('$message');</script>";
                } 
            } 
            if($keeper != NULL){
                $keeperController = new KeeperController();
                $keeperController->ShowListView();
            }else{
                $serviceList = $this->serviceDAO->getAll();
                $this->ShowAvailabilityView();
            }
            
        }

        public function ModifyService($service, $startDate, $endDate, $keeper){
            $serviceStartDate = $service->getStartDate();
            $serviceEndDate = $service->getEndDate();
            $this->Remove($service->getId());
            $this->Add($startDate, $endDate, 'pending', $keeper);
            if($serviceStartDate < $startDate){
                $date=date_create($startDate);
                date_add($date,date_interval_create_from_date_string("-1 days"));
                $date = date_format($date, "Y-m-d");
                $this->Add($serviceStartDate, $date, 'available', $keeper);
            }
            if($serviceEndDate > $endDate){
                $date=date_create($endDate);
                date_add($date,date_interval_create_from_date_string("+1 days"));
                $date = date_format($date, "Y-m-d");
                $this->Add($date, $serviceEndDate, 'available', $keeper);
            }
        }

        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->serviceDAO->Remove($id);

        }

        public function getServices(){
            $serviceList = $this->serviceDAO->getAll();
            return $serviceList;
        }
    }
?>