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
        $data = array(
            'listTransaction' => $this->mAccounting->listTransaction('outcome'),
            'input' => $this->mAccounting->setFormTransaction('outcome'),
        );

        $this->template->set_Content('accounting/outcome.php', $data);
        $this->template->showTemplate();
    }

    public function add_transaction($from_function) {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->mAccounting->setValidationTransaction() && $this->form_validation->run()) {
                $data = $this->mAccounting->getPostTransaction();
                //create date
                $data['create_date'] = $this->datetime->nowToDBFormat();
                $data['create_by'] = $this->session->userdata('id_user');
                if ($this->db->insert('tbl_transaction', $data)) {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "เพิ่มรายรับเรียบร้อยแล้ว";
                    $alert['alert_mode'] = "success";
                    $this->session->set_userdata('alert', $alert);
                } else {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "กรุณาลองใหม่อีกครั้ง";
                    $alert['alert_mode'] = "danger";
                    $this->session->set_userdata('alert', $alert);
                }
            } else {
                //Alert success and redirect to candidate
                $alert['alert_message'] = "กรุณาลองใหม่อีกครั้ง";
                $alert['alert_mode'] = "danger";
                $this->session->set_userdata('alert', $alert);
            }
        }
        redirect('accounting/' . $from_function);
    }

    public function edit_transaction($from_function) {
        if ($this->input->post('id_tran') == NULL) {
            redirect('accounting/' . $from_function);
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->mAccounting->setValidationTransaction() && $this->form_validation->run()) {
                $data = $this->mAccounting->getPostTransaction($this->input->post('id_tran'));
                //create date
                $data['update_date'] = $this->datetime->nowToDBFormat();
                $data['update_by'] = $this->session->userdata('id_user');

                $this->db->where('id_tran', $data['id_tran']);
                unset($data['id_tran']);
                if ($this->db->update('tbl_transaction', $data)) {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "แก้ไขรายรับเรียบร้อยแล้ว";
                    $alert['alert_mode'] = "success";
                    $this->session->set_userdata('alert', $alert);
                } else {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "กรุณาลองใหม่อีกครั้ง";
                    $alert['alert_mode'] = "danger";
                    $this->session->set_userdata('alert', $alert);
                }
            }
        }
        redirect('accounting/' . $from_function);
    }

    public function del_transaction($from_function, $id_tran) {
        if ($id_tran == NULL) {
            redirect('accounting/' . $from_function);
        }

        if ($this->db->delete('tbl_transaction', array('id_tran' => $id_tran))) {
            //Alert success and redirect to candidate
            $alert['alert_message'] = "ลบรายการเรียบร้อยแล้ว";
            $alert['alert_mode'] = "success";
            $this->session->set_userdata('alert', $alert);
        } else {
            //Alert success and redirect to candidate
            $alert['alert_message'] = "กรุณาลองใหม่อีกครั้ง";
            $alert['alert_mode'] = "danger";
            $this->session->set_userdata('alert', $alert);
        }

        redirect('accounting/' . $from_function);
    }

}
