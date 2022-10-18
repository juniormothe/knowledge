<?php

namespace Classe\assistant;

/**
 * @copyright (c) 2022, Junior Silva <junior.mothe@gmail.com>
 */
class CalendarAssistant
{
    private $type;
    private $year;
    private $month;
    private $week;

    public function __construct()
    {
        $this->checkType();
        $this->checkMonth();
        $this->checkYear();
        $this->checkWeek();
    }

    public function get()
    {
        return ['type' => $this->type, 'year' => $this->year, 'month' => $this->month, 'week' => $this->week];
    }

    public function checkDaysMonth($month, $date, $type = null)
    {
        if ($month == date('m', strtotime($date))) {
            return date($this->checkDaysMonthType($type), strtotime($date));
        } else {
            return '<small style="color: #C0C0C0;">' . date($this->checkDaysMonthType($type), strtotime($date)) . '</small>';
        }
    }

    public function routeWeek($week, $year)
    {
        $week = intval($week);
        $array['previous'] = ($week - 1);
        $array['next'] = ($week + 1);
        $array['yearPrevious'] = $year;
        $array['yearNext'] = $year;
        if ($week == 1) {
            $array['previous'] = $this->routeWeekTotal($year - 1);
            $array['yearPrevious'] = ($year - 1);
        }
        if ($week == $this->routeWeekTotal($year)) {
            $array['next'] = 1;
            $array['yearNext'] = ($year + 1);
        }
        return $array;
    }

    public function actionDay($data)
    {
        if ($data == date('Y-m-d')) {
            return 'class="table-success"';
        }
    }

    private function checkType()
    {
        if (!isset($_GET['type'])) {
            $this->type = 1;
        } else {
            $this->type = $_GET['type'];
        }
    }

    private function checkYear()
    {
        if (!isset($_GET['year'])) {
            $this->year = date('Y');
        } else {
            $this->year = $_GET['year'];
        }
    }

    private function checkMonth()
    {
        if (!isset($_GET['month'])) {
            $this->month = date('m');
        } else {
            $this->month = $_GET['month'];
        }
    }

    private function checkWeek()
    {
        if (!isset($_GET['week'])) {
            $this->week = date('W', strtotime(date('Y-m-d')));
        } else {
            $this->week = $_GET['week'];
        }
    }

    private function checkDaysMonthType($type)
    {
        if (empty($type)) {
            return "d/m/Y";
        } else {
            return "{$type}";
        }
    }

    private function routeWeekTotal($year)
    {
        $week = date('w', strtotime($year . "-12-31"));
        if ($week == 6) {
            return 52;
        } else {
            return 53;
        }
    }
}
