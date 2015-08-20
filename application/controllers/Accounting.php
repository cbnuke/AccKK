<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accounting_model', 'mAccounting', TRUE);
        $this->load->library('form_validation');
    }

    public function index() {
        $this->template->set_Content('404.php');
        $this->template->showTemplate();
    }

    public function income() {
        $data = array(
            'listTransaction' => $this->mAccounting->listTransaction('income'),
            'input' => $this->mAccounting->setFormTransaction('income'),
        );

        $this->template->set_Content('accounting/income.php', $data);
        $this->template->showTemplate();
    }

    public function outcome() {
        $this->template->set_Content('404.php');
        $this->template->showTemplate();
    }

}
