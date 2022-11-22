<?php

    namespace Controllers;
    use Models\Calendar as Calendar;

class CalendarController{
    public $calendar;

    public function ShowAvailabilityCalendar($month = null){
        $serviceController = new ServiceController();
        $serviceList = $serviceController->getServices();
        $this->calendar = new Calendar($month);
        foreach($serviceList as $service){
            if($service->getUser() == $_SESSION['loggedUser']){
                $startDate = $service->getStartDate();
                $endDate = $service->getEndDate();
                for($i = $startDate; $i <= $endDate; $i++){
                    $dateF = date_create($i);
                    $date = date_format($dateF, 'Y-m-d');
                    $dateT = date_create(date('Y-m-d'));
                    $dateToday = date_format($dateT, 'Y-m-d');
                    $m = date( 'y-m-t' );
                    if($date < $m){
                        switch ($service->getStatus()) {
                            case 'Available':
                                if($date < $dateToday){
                                    $this->add_event('Available', $i, 1, 'grey');
                                }else{
                                    $this->add_event('Available', $i, 1, 'green');
                                }
                                break;
                            case 'Unavailable':
                                if($date < $dateToday){
                                    $this->add_event('Unavailable', $i, 1, 'grey');
                                }else{
                                    $this->add_event('Unavailable', $i, 1, 'red');
                                }
                                break;
                            case 'Pending':
                                if($date < $dateToday){
                                    $this->add_event('Unanswered', $i, 1, 'grey');
                                }else{
                                    $this->add_event('Pending', $i, 1, 'yellow');
                                }
                                break;
                            case 'Reserved':
                                if($date < $dateToday){
                                    $this->add_event('Reserved', $i, 1, 'grey');
                                }else{
                                    $this->add_event('Reserved', $i, 1, 'blue');
                                }
                                break;
                            case 'Rejected':
                                $this->add_event('Rejected', $i, 1, 'grey');
                                break;
                            case 'Approved':
                                if($date < $dateToday){
                                    $this->add_event('Finished', $i, 1, 'grey');
                                }else{
                                    $this->add_event('Approved', $i, 1, 'blue');
                                }
                                break;  
                            default:
                                if($service->getStatus() != 'Pending' && $date < $dateToday){
                                    $this->add_event($service->getStatus(), $i, 1, 'grey');
                                }else{
                                    $this->add_event($service->getStatus(), $i, 1, 'bg-info');
                                }
                                break;
                        }
                    }
                    
                }
            }
    
        }
        $calendar = $this->__toString();
        require_once(VIEWS_PATH."keeper-calendar-availability.php");
        
    }

    public function GetKeeperAvailabilityCalendar($month = null, $userId){
        $serviceController = new ServiceController();
        $serviceList = $serviceController->getServices();
        $bookingController = new BookingController();
        $bookingList = $bookingController->bookingDAO->GetByUser($_SESSION['loggedUser']);
        $this->calendar = new Calendar($month);
        foreach($serviceList as $service){
            if($service->getUser()->getUserId() == $userId){
                $startDate = $service->getStartDate();
                $endDate = $service->getEndDate();
                for($i = $startDate; $i <= $endDate; $i++){
                    $dateF = date_create($i);
                    $date = date_format($dateF, 'Y-m-d');
                    $dateT = date_create(date('Y-m-d'));
                    $dateToday = date_format($dateT, 'Y-m-d');
                    $m = date( 'y-m-t' );
                    if($date < $m){
                        switch ($service->getStatus()) {
                            case 'Available':
                                if($date < $dateToday){
                                    $this->add_event('Available', $i, 1, 'grey');
                                }else{
                                    $this->add_event('Available', $i, 1, 'green');
                                }
                                break;
                            case 'Unavailable':
                                if($date < $dateToday){
                                    $this->add_event('Unavailable', $i, 1, 'grey');
                                }else{
                                    $this->add_event('Unavailable', $i, 1, 'red');
                                }
                                break;
                            default:
                                if($service->getStatus() != 'Pending' && $date < $dateToday){
                                    $this->add_event($service->getStatus(), $i, 1, 'grey');
                                }else{
                                    $this->add_event($service->getStatus(), $i, 1, 'bg-info');
                                }
                                break;
                        }
                    }
                    
                }
            }
    
        }
        if($bookingList){
            foreach($bookingList as $booking){
                if($booking->getKeeper()->getUser()->getUserId() == $userId){
                    $startDate = $booking->getStartDate();
                    $endDate = $booking->getEndDate();
                    $endDateB = date_create($booking->getEndDate());
                    $endDateB = date_format($endDateB, 'y-m-d');
                    for($i = $startDate; $i <= $endDate; $i++){
                        $dateF = date_create($i);
                        $date = date_format($dateF, 'Y-m-d');
                        $dateT = date_create(date('Y-m-d'));
                        $dateToday = date_format($dateT, 'Y-m-d');
                        $m = date( 'y-m-t' );
                        if($date < $m){
                            switch ($booking->getStatus()) {
                                case 'Pending':
                                    if($date < $dateToday){
                                        $this->add_event('Unanswered', $i, 1, 'grey');
                                    }else{
                                        $this->add_event('Pending', $i, 1, 'yellow');
                                    }
                                    break;
                                case 'Approved (Pending payment)':
                                    if($date < $dateToday){
                                        $this->add_event('Not payed', $i, 1, 'grey');
                                    }else{
                                        $this->add_event('Approved Pending Payment', $i, 1, 'yellow');
                                    }
                                    break; 
                                case 'Approved (Payed)':
                                    if($endDateB > $dateToday){
                                        $this->add_event('On going', $i, 1, 'blue');
                                    }
                                    break;
                                case 'Finished':
                                    $this->add_event('Finished', $i, 1, 'grey');
                                    break;
                                case 'Rejected':
                                    if($date < $dateToday){
                                        $this->add_event('Rejected', $i, 1, 'grey');
                                    }else{
                                        $this->add_event('Rejected', $i, 1, 'red');
                                    }
                                    break; 
                            }
                        }
                    }
                
                }
            }
        }
        return $this->__toString();
        
    }

    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->calendar->setEvents($txt, $date, $days, $color);
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->calendar->getActiveDay() . '-' . $this->calendar->getActiveMonth() . '-' . $this->calendar->getActiveYear()));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->calendar->getActiveDay() . '-' . $this->calendar->getActiveMonth() . '-' . $this->calendar->getActiveYear())));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->calendar->getActiveYear() . '-' . $this->calendar->getActiveMonth() . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';   
        $html .= date('M Y', strtotime($this->calendar->getActiveYear() . '-' . $this->calendar->getActiveMonth() . '-' . $this->calendar->getActiveDay()));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        $events = $this->calendar->getEvents();
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->calendar->getActiveDay()) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->calendar->getActiveYear() . '-' . $this->calendar->getActiveMonth() . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
?>