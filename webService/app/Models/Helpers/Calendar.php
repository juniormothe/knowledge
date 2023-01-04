<?php

namespace App\Models\Helpers;

use DateTime;

/**
 * Classe de calendário
 * 
 * Está classe é responsável por gerar um calendário mensal ou semanal em formato de Array
 * 
 * @param private $month ...
 * @param private $year ...
 * @param private $firstDay ...
 * @param private $lastDay ...
 * @param private $weekFirstDay ...
 * @param private $weekLastDay ...
 * @param private $days ...
 * 
 * @method public fullCalendar() ... 
 * @method public weekCalendar() ... 
 * @method private checkMonth() ... 
 * @method private checkYear() ... 
 * @method private checkFirstDay() ... 
 * @method private checkLastDay() ... 
 * @method private checkWeek() ... 
 * @method private checkDays() ... 
 * 
 * @package Meus códigos
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class Calendar
{
    private $month;
    private $year;
    private $firstDay;
    private $lastDay;
    private $weekFirstDay;
    private $weekLastDay;
    private $days;

    public function __construct(string $month = null, string $year = null)
    {
        $this->month = $this->checkMonth($month);
        $this->year = $this->checkYear($year);
        $this->firstDay = $this->checkFirstDay($this->month, $this->year);
        $this->lastDay = $this->checkLastDay($this->month, $this->year);
        $this->weekFirstDay = $this->checkWeek($this->firstDay);
        $this->weekLastDay = $this->checkWeek($this->lastDay);
        $this->days = $this->checkDays($this->firstDay);
    }

    public function fullCalendar()
    {
        $lines = ceil(($this->weekFirstDay + $this->days) / 7);
        $startFullCalendar = date('Y-m-d', strtotime('-' . $this->weekFirstDay . ' days', strtotime($this->firstDay)));
        $fullCalendar = array();
        for ($i = 1; $i <= intval($lines); $i++) {
            $fullCalendar[$i][0] = $startFullCalendar;
            $fullCalendar[$i][1] = date('Y-m-d', strtotime('+1 days', strtotime($startFullCalendar)));
            $fullCalendar[$i][2] = date('Y-m-d', strtotime('+2 days', strtotime($startFullCalendar)));
            $fullCalendar[$i][3] = date('Y-m-d', strtotime('+3 days', strtotime($startFullCalendar)));
            $fullCalendar[$i][4] = date('Y-m-d', strtotime('+4 days', strtotime($startFullCalendar)));
            $fullCalendar[$i][5] = date('Y-m-d', strtotime('+5 days', strtotime($startFullCalendar)));
            $fullCalendar[$i][6] = date('Y-m-d', strtotime('+6 days', strtotime($startFullCalendar)));
            $startFullCalendar = date('Y-m-d', strtotime('+7 days', strtotime($startFullCalendar)));
        }
        return $fullCalendar;
    }

    public function weekCalendar($weekYear = null, $year = null)
    {
        if (empty($year)) {
            $year = $this->year;
        }
        if (empty($weekYear)) {
            $weekYear = intval(date('W', strtotime(date('Y-m-d'))));
        }
        $startWeekCalendar = date('Y-m-d', strtotime('-' . intval(date('w', strtotime($year . '-01-01'))) . ' days', strtotime($year . '-01-01')));
        for ($i = 1; $i <= 53; $i++) {
            $weekYearFor = intval(date('W', strtotime(date('Y-m-d', strtotime('+1 days', strtotime($startWeekCalendar))))));
            $weekCalendar[$weekYearFor][1] = date('Y-m-d', strtotime('+1 days', strtotime($startWeekCalendar)));
            $weekYearFor = intval(date('W', strtotime(date('Y-m-d', strtotime('+2 days', strtotime($startWeekCalendar))))));
            $weekCalendar[$weekYearFor][2] = date('Y-m-d', strtotime('+2 days', strtotime($startWeekCalendar)));
            $weekYearFor = intval(date('W', strtotime(date('Y-m-d', strtotime('+3 days', strtotime($startWeekCalendar))))));
            $weekCalendar[$weekYearFor][3] = date('Y-m-d', strtotime('+3 days', strtotime($startWeekCalendar)));
            $weekYearFor = intval(date('W', strtotime(date('Y-m-d', strtotime('+4 days', strtotime($startWeekCalendar))))));
            $weekCalendar[$weekYearFor][4] = date('Y-m-d', strtotime('+4 days', strtotime($startWeekCalendar)));
            $weekYearFor = intval(date('W', strtotime(date('Y-m-d', strtotime('+5 days', strtotime($startWeekCalendar))))));
            $weekCalendar[$weekYearFor][5] = date('Y-m-d', strtotime('+5 days', strtotime($startWeekCalendar)));
            $weekYearFor = intval(date('W', strtotime(date('Y-m-d', strtotime('+6 days', strtotime($startWeekCalendar))))));
            $weekCalendar[$weekYearFor][6] = date('Y-m-d', strtotime('+6 days', strtotime($startWeekCalendar)));
            $weekYearFor = intval(date('W', strtotime(date('Y-m-d', strtotime('+1 days', strtotime($startWeekCalendar))))));
            $weekCalendar[$weekYearFor][0] = date('Y-m-d', strtotime('-1 days', strtotime($weekCalendar[$weekYearFor][1])));
            ksort($weekCalendar[$weekYearFor]);
            $startWeekCalendar = date('Y-m-d', strtotime('+7 days', strtotime($startWeekCalendar)));
        }
        if ($weekYear > 53) {
            $weekYear = intval(date('W', strtotime(date('Y-m-d'))));
        }
        if(isset($weekCalendar[$weekYear])){
            return  $weekCalendar[$weekYear];
        }else{
            return NULL;
        }
        
    }

    private function checkMonth($month)
    {
        if (!empty($month)) {
            $checkMonth = ['01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12'];
            if (array_key_exists($month, $checkMonth)) {
                $month = $month;
            } else {
                $month = date('m');
            }
        } else {
            $month = date('m');
        }
        return $month;
    }

    private function checkYear($year)
    {
        if (!empty($year)) {
            $year = $year;
        } else {
            $year = date('Y');
        }
        return $year;
    }

    private function checkFirstDay($month, $year)
    {
        return $year . "-" . $month . "-01";
    }

    private function checkLastDay($month, $year)
    {
        $firstDay = $year . "-" . $month . "-01";
        return $year . "-" . $month . "-" . date('t', strtotime($firstDay));
    }

    private function checkWeek($date)
    {
        return date('w', strtotime($date));
    }

    private function checkDays($date)
    {
        return date('t', strtotime($date));
    }

}
