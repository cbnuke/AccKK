<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Setting_model', 'mSetting', TRUE);
        $this->load->library('form_validation');
    }

    public function index() {
        $this->template->set_Content('404.php');
        $this->template->showTemplate();
    }

    public function type() {
        $data = array(
            'listType' => $this->mSetting->listType(),
            'input' => $this->mSetting->setFormType(),
        );

//        $this->template->set_Debug($data);
        $this->template->set_Content('setting/type.php', $data);
        $this->template->showTemplate();
    }

    public function users() {
        $data = array(
            'listUsers' => $this->mSetting->listUsers(),
            'input' => $this->mSetting->setFormUser(),
        );

//        $this->template->set_Debug($data['input']);
        $this->template->set_Content('setting/users.php', $data);
        $this->template->showTemplate();
    }

    public function add_user() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->mSetting->setValidationUser() && $this->form_validation->run()) {
                $data = $this->mSetting->getPostUser();
                //create date and md5 password
                $data['user_pass'] = md5($data['user_pass']);
                $data['create_date'] = $this->datetime->nowToDBFormat();
                $data['create_by'] = $this->session->userdata('id_user');
                if ($this->db->insert('tbm_user', $data)) {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "เพิ่มผู้ใช้เรียบร้อยแล้ว";
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
        redirect('setting/users');
    }

    public function edit_user() {
        if ($this->input->post('id_user') == NULL) {
            redirect('setting/users');
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->mSetting->setValidationUser() && $this->form_validation->run()) {
                $data = $this->mSetting->getPostUser();
                //create date and md5 password
                $data['user_pass'] = md5($data['user_pass']);
                $data['update_date'] = $this->datetime->nowToDBFormat();
                $data['update_by'] = $this->session->userdata('id_user');

                $this->db->where('id_user', $data['id_user']);
                unset($data['id_user']);
                if ($this->db->update('tbm_user', $data)) {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "แก้ไขผู้ใช้เรียบร้อยแล้ว";
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
        redirect('setting/users');
    }

    public function del_user($id_user) {
        if ($id_user == NULL) {
            redirect('setting/users');
        }

        if ($this->db->delete('tbm_user', array('id_user' => $id_user))) {
            //Alert success and redirect to candidate
            $alert['alert_message'] = "ลบผู้ใช้เรียบร้อยแล้ว";
            $alert['alert_mode'] = "success";
            $this->session->set_userdata('alert', $alert);
        } else {
            //Alert success and redirect to candidate
            $alert['alert_message'] = "กรุณาลองใหม่อีกครั้ง";
            $alert['alert_mode'] = "danger";
            $this->session->set_userdata('alert', $alert);
        }

        redirect('setting/users');
    }

    public function add_type() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->mSetting->setValidationType() && $this->form_validation->run()) {
                $data = $this->mSetting->getPostType();
                //create date
                $data['create_date'] = $this->datetime->nowToDBFormat();
                $data['create_by'] = $this->session->userdata('id_user');
                if ($this->db->insert('tbm_type', $data)) {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "เพิ่มประเภทค่าใช้จ่ายเรียบร้อยแล้ว";
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
        redirect('setting/type');
    }

    public function edit_type() {
        if ($this->input->post('id_type') == NULL) {
            redirect('setting/type');
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->mSetting->setValidationType() && $this->form_validation->run()) {
                $data = $this->mSetting->getPostType();
                //create date
                $data['update_date'] = $this->datetime->nowToDBFormat();
                $data['update_by'] = $this->session->userdata('id_user');

                $this->db->where('id_type', $data['id_type']);
                unset($data['id_type']);
                if ($this->db->update('tbm_type', $data)) {
                    //Alert success and redirect to candidate
                    $alert['alert_message'] = "แก้ไขประเภทค่าใช้จ่ายเรียบร้อยแล้ว";
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
        redirect('setting/type');
    }

    public function del_type($id_type) {
        if ($id_type == NULL) {
            redirect('setting/type');
        }

        if ($this->db->delete('tbm_type', array('id_type' => $id_type))) {
            //Alert success and redirect to candidate
            $alert['alert_message'] = "ลบประเภทค่าใช้จ่ายเรียบร้อยแล้ว";
            $alert['alert_mode'] = "success";
            $this->session->set_userdata('alert', $alert);
        } else {
            //Alert success and redirect to candidate
            $alert['alert_message'] = "กรุณาลองใหม่อีกครั้ง";
            $alert['alert_mode'] = "danger";
            $this->session->set_userdata('alert', $alert);
        }

        redirect('setting/type');
    }

}
