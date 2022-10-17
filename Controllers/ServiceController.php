<?php
    namespace Controllers;

    use DAO\ServiceDAO as ServiceDAO;
    use DAO\UserDAO as UserDao; 
    use Models\Service as Service;

    class ServiceController
    {
        private $serviceDAO;
        private $userDAO;

        public function __construct()
        {
            $this->serviceDAO = new serviceDAO();
            $this->userDAO = new userDAO();
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
            $serviceList = $this->serviceDAO->getAll();
            if($endDate < $startDate){
                $message = 'You cannot set the end date to before the start date';
                echo "<script>alert('$message');</script>";
            }else{
                $flag = 0; 
                foreach($serviceList as $service){
                    if($startDate <= $service->getEndDate()){ /// acordarme de poner como condicion que coincida el id del keeper
                        if($endDate >= $service->getStartDate()){
                            $flag = 1;
                        }
                    }
                }
                if(!$serviceList || $flag != 1){
                    $service = new service();
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
    }
?>