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

        public function Add($startDate, $endDate, $status, $keeper = NULL, $specie = NULL){
            $userController = new UserController();
            $user = $keeper != null ? $userController->userDAO->GetById($keeper->getUser()->getUserID()) : $_SESSION["loggedUser"];
            $serviceList = $this->serviceDAO->getAll();
            if($keeper == null){
                if($endDate < $startDate){
                    $message = 'You cannot set the end date to before the start date';
                    $this->ShowAvailabilityView("<h4 class = 'alert alert-danger'> $message </h4>");

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
                        $this->ShowAvailabilityView("<h4 class = 'alert alert-success'> $message </h4>");                        
                    }else if($flag == 1){
                        $message = 'Some of the dates entered had already been loaded. Please enter different dates.'; 
                        $this->ShowAvailabilityView("<h4 class = 'alert alert-warning'> $message </h4>");
                    }
                $serviceList = $this->serviceDAO->getAll();
                $this->ShowAvailabilityView();
                }
            }else{
                $flag = 0;
                foreach($serviceList as $service){
                    if($service->getUser() == $user && $startDate <= $service->getEndDate() && $endDate >= $service->getStartDate() && $service->getStatus() == 'For '.$status.'s'){
                        $dateS = date_create($service->getStartDate());
                        $dateStart = date_format($dateS, 'Y-m-d');
                        $dateE = date_create($service->getEndDate());
                        $dateEnd = date_format($dateE, 'Y-m-d');
                        if($endDate > $service->getEndDate()){
                            $serviceBySpecie = new service();
                            $serviceBySpecie->setUser($user);
                            $serviceBySpecie->setStartDate(date('Y-m-d', strtotime($service->getEndDate() . '+1 day')));
                            $serviceBySpecie->setEndDate($endDate);
                            $serviceBySpecie->setStatus('For '.$status.'s');
                            $this->serviceDAO->Add($serviceBySpecie);
                            $flag = 1;
                        }
                        if($startDate < $service->getStartDate()){
                            $serviceBySpecie = new service();
                            $serviceBySpecie->setUser($user);
                            $serviceBySpecie->setStartDate($startDate);
                            $serviceBySpecie->setEndDate(date('Y-m-d', strtotime($dateStart . '-1 day')));
                            $serviceBySpecie->setStatus('For '.$status.'s');
                            $this->serviceDAO->Add($serviceBySpecie);
                            $flag = 1;
                        }
                        if($startDate >= $service->getStartDate() && $endDate <= $service->getEndDate()){
                            $flag = 1;
                        }
                    }
                }
                if($flag == 0){
                    $service = new service();
                    $service->setUser($user);
                    $service->setStartDate($startDate);
                    $service->setEndDate($endDate);
                    $service->setStatus('For '.$status.'s');
                    $this->serviceDAO->Add($service);
                }
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