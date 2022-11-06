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

        public function ShowAvailabilityView($message = "")
        {
    
            require_once(VIEWS_PATH."keeper-availability.php");
        }

        public function ShowListView()
        {
            require_once(VIEWS_PATH."example.php");
        }

        public function Add($startDate, $endDate, $status, $keeper = NULL){
            $userController = new UserController();
            $user = $keeper != null ? $userController->userDAO->GetById($keeper->getUser()->getUserID()) : $_SESSION["loggedUser"];
            $serviceList = $this->serviceDAO->getAll();
            if($keeper == null){
                if($endDate < $startDate){
                    $message = 'You cannot set the end date to before the start date';
                    $this->ShowAvailabilityView($message);
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
                        $message = 'Your availability has been successfully set';
                        $this->ShowAvailabilityView($message);
                    }else if($flag == 1){
                        $message = 'Some of the dates entered had already been loaded. Please enter different dates.'; 
                        $this->ShowAvailabilityView($message);
                    }
                $serviceList = $this->serviceDAO->getAll();
                $this->ShowAvailabilityView();
                }
            }else{
                $service = new service();
                $service->setUser($user);
                $service->setStartDate($startDate);
                $service->setEndDate($endDate);
                $service->setStatus($status);
                $this->serviceDAO->Add($service);
                $keeperController = new KeeperController();
                $keeperController->ShowListView();
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