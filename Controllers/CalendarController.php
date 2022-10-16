<?php

    namespace Controllers;

    use DAO\ServiceDAO as ServiceDAO;
    use Models\Service as Service;


class CalendarController{

    private $active_year, $active_month, $active_day;
    private $events = [];
    private $serviceDAO;

    public function __construct($month = null) {
        $this->active_year = date('Y');
        $this->active_month = $month != null ? date($month) : date(11);
        $this->active_day = date('d');
        $this->serviceDAO = new serviceDAO();
    }

    public function showAvailabityCalendar($month = null){
        $serviceList = $this->serviceDAO->getAll();
        $calendar = new CalendarController($month);
        foreach($serviceList as $service){
            $startDate = $service->getStartDate();
            $endDate = $service->getEndDate();
            for($i = $startDate; $i <= $endDate; $i++){
                switch ($service->getStatus()) {
                    case 'available':
                        $calendar->add_event('Available', $i, 1, 'green');
                        break;
                    case 'unavailable':
                        $calendar->add_event('Unavailable', $i, 1, 'red');
                        break;
                    case 'pending':
                        $calendar->add_event('Pending', $i, 1, 'yellow');
                        break;
                    case 'reserved':
                        $calendar->add_event('Reserved', $i, 1, 'blue');
                        break;
                }
                
            }
    
        }
        require_once(VIEWS_PATH . "keeper-calendar-availability.php");
        
    }

    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
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
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
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