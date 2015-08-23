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

    public function today($print = FALSE) {
        $begin = $this->datetime->DBToDay();
        $end = NULL;
        $data = array(
            'report_type' => 'วันนี้',
            'form_open' => form_open('report/today'),
            'print_link' => 'today/true',
            'now_time' => $this->datetime->DBToDayTime(),
            'list' => $this->mReport->listTransaction($begin),
            'begin' => $begin,
            'end' => $end,
            'money_income' => 0,
            'money_outcome' => 0,
        );

        if ($print) {
            $this->load->view('report/print.php', $data);
        } else {
            $this->template->set_Debug($print);
            $this->template->set_Content('report/main', $data);
            $this->template->showTemplate();
        }
    }

    public function week($print = FALSE) {
        $begin = $this->datetime->DayMinusDay(7);
        $end = $this->datetime->DBToDay();
        $data = array(
            'report_type' => 'สัปดาห์',
            'form_open' => form_open('report/week'),
            'print_link' => 'week/true',
            'now_time' => $this->datetime->DBToDayTime(),
            'list' => $this->mReport->listTransaction($begin, $end),
            'begin' => $begin,
            'end' => $end,
            'money_income' => 0,
            'money_outcome' => 0,
        );

        if ($print) {
            $this->load->view('report/print.php', $data);
        } else {
            $this->template->set_Debug($print);
            $this->template->set_Content('report/main', $data);
            $this->template->showTemplate();
        }
    }

    public function range($u_begin = "", $u_end = "", $print = FALSE) {
        $range = $this->input->post('range');
        $temp;
        if ($range != NULL) {
            $temp = explode(' ', $range);
            if ((isset($temp[0]) && isset($temp[3])) == FALSE) {
                redirect('report/range');
            }
        }
        $begin = (isset($temp[0])) ? $temp[0] : $this->datetime->DayMinusDay(7);
        $end = (isset($temp[3])) ? $temp[3] : $this->datetime->DBToDay();

        if ($print) {
            $begin = $u_begin;
            $end = $u_end;
        }

        $data = array(
            'report_type' => 'สัปดาห์',
            'form_open' => form_open('report/range'),
            'print_link' => 'range/' . $begin . '/' . $end . '/true',
            'now_time' => $this->datetime->DBToDayTime(),
            'list' => $this->mReport->listTransaction($begin, $end),
            'begin' => $begin,
            'end' => $end,
            'money_income' => 0,
            'money_outcome' => 0,
            'range' => $range,
        );

        if ($print) {
            $this->load->view('report/print.php', $data);
        } else if ($this->input->post('action') == 'pdf') {
            // Get output html
            $this->load->view('report/print.php', $data);
            $html = $this->output->get_output();

            $this->load->library('TCPDF_gen');
            $pdf = new TCPDF_gen('L', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetFont('thsarabun', '', 14, '', true);
            // Add a page
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('My-File-Name.pdf', 'I');
        } else {
            $this->template->set_Debug($print);
            $this->template->set_Content('report/main', $data);
            $this->template->showTemplate();
        }
    }

}
