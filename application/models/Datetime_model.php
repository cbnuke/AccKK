<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Datetime_model extends CI_Model {

    private $month_th = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

    function DDMMYYYYLineToDBFormat($date) {
        if ($date == NULL) {
            return NULL;
        }
        $temp = explode('/', $date);
        return ($temp[2] - 543) . '-' . $temp[1] . '-' . $temp[0];
    }

    function nowToDBFormat() {
        $format = 'DATE_W3C';
        $time = time();
        return standard_date($format, $time);
    }

    function DBToHuman($DB_date, $time = FALSE) {
        if ($DB_date == NULL)
            return '';

        $temp = explode(' ', $DB_date);
        $temp_date = explode('-', $temp[0]);
        $date = $temp_date[2] . ' ' . $this->month_th[intval($temp_date[1])] . ' ' . $temp_date[0];
        if ($time) {
            $date.= ' เวลา ' . substr($temp[1], 0, 5);
        }
        return $date;
    }

    function DBShortToHuman($DB_date) {
        $temp_date = explode('-', $DB_date);
        $date = $temp_date[2] . ' ' . $this->month_th[intval($temp_date[1])] . ' ' . $temp_date[0];
        return $date;
    }

    function DBShortToHumanSlash($DB_date) {
        if ($DB_date == NULL) {
            return NULL;
        }
        $temp_date = explode('-', $DB_date);
        $date = $temp_date[2] . '/' . $temp_date[1] . '/' . ($temp_date[0] + 543);
        return $date;
    }

    function DBToDay() {
        return date('Y-m-d');
    }

    function DayMinusDay($day) {
        return date('Y-m-d', strtotime($this->nowToDBFormat() . "-" . $day . " days"));
    }

}
