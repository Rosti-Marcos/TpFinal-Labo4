<?php
    namespace Models;

    Class Calendar{
        private $activeYear, $activeMonth, $activeDay;
        private $events = [];

        public function __construct($month = null) {
            $this->setActiveYear(date('Y'));
            $this->setActiveMonth($month != null ? date($month) : date('m'));
            if($this->getActiveMonth() == date('m')){
                $this->setActiveDay(date('d'));
            }else{
                $this->setActiveDay(date(1));
            }
            
        }

        public function setActiveYear($activeYear){
            $this->activeYear = $activeYear;
        }

        public function getActiveYear(){
            return $this->activeYear;
        }

        public function setActiveMonth($month){
            $this->activeMonth = $month;
        }

        public function getActiveMonth(){
            return $this->activeMonth;
        }

        public function setActiveDay($day){
            $this->activeDay = $day;
        }

        public function getActiveDay(){
            return $this->activeDay;
        }

        public function getEvents(){
            return $this->events;
        }

        public function setEvents($txt, $date, $days = 1, $color = '') {
            $color = $color ? ' ' . $color : $color;
            $this->events[] = [$txt, $date, $days, $color];
        }
    }