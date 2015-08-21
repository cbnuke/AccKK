<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Report_model', 'mReport', TRUE);
        $this->load->model('Home_model', 'mHome');
    }

    public function index() {
        $this->template->set_Content('404.php');
        $this->template->showTemplate();
    }

    public function today() {
        $begin = $this->datetime->DBToDay();
        $data = array(
            'list' => $this->mReport->listTransaction($begin),
            'begin' => $begin,
        );

        $this->template->set_Debug($data);
        $this->template->set_Content('report/today', $data);
        $this->template->showTemplate();
    }

    public function week() {
        $begin = $this->datetime->DayMinusDay(7);
        $end = $this->datetime->DBToDay();
        $data = array(
            'list' => $this->mReport->listTransaction($begin, $end),
            'begin' => $begin,
            'end' => $end,
        );

        $this->template->set_Debug($data);
        $this->template->set_Content('report/today', $data);
        $this->template->showTemplate();
    }

}
