<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accounting_model', 'mAccounting', TRUE);
        $this->load->model('Home_model', 'mHome');
    }

    public function index() {
        $listIncome = $this->mAccounting->listTransaction('income');
        $listOutcome = $this->mAccounting->listTransaction('outcome');
        $data = array(
            'graph' => $this->mHome->genGraph($listIncome, $listOutcome),
        );

//        $this->template->set_Debug($data);
        $this->template->set_Content('home', $data);
        $this->template->showTemplate();
    }

}
