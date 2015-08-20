<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounting_model extends CI_Model {

    function listTransaction($money_type = 'all') {
        $this->db->from('tbl_transaction');
        if ($money_type != 'all') {
            $this->db->where('money_type', $money_type);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function setFormTransaction($type = 'income') {
        $i_income = array(
            'id' => 'income',
            'name' => 'income',
            'value' => set_value('income'),
            'type' => 'number',
            'autocomplete' => 'off',
            'class' => 'form-control');
        $i_outcome = array(
            'id' => 'outcome',
            'name' => 'outcome',
            'value' => set_value('outcome'),
            'type' => 'number',
            'autocomplete' => 'off',
            'class' => 'form-control');
        $i_money_type = array(
            'id' => 'money_type',
            'name' => 'money_type',
            'value' => $type,
            'type' => 'hidden',
            'class' => 'form-control');
        $i_action_date = array(
            'id' => 'action_date',
            'name' => 'action_date',
            'value' => set_value('action_date'),
            'autocomplete' => 'off',
            'class' => 'form-control');
        $i_comment = array(
            'id' => 'comment',
            'name' => 'comment',
            'value' => set_value('comment'),
            'autocomplete' => 'off',
            'class' => 'form-control');

        $data = array(
            'income' => form_input($i_income),
            'outcome' => form_input($i_outcome),
            'money_type' => form_input($i_money_type),
            'action_date' => form_input($i_action_date),
            'comment' => form_textarea($i_comment),
        );
        return $data;
    }

    function listUsers() {
        $this->db->from('tbm_user');
        $query = $this->db->get();
        return $query->result_array();
    }

    function login($data) {
        $session = array(
            'id_user' => $data['id_user'],
            'user_name' => $data['user_name'],
            'create_date' => $data['create_date'],
            'login' => TRUE
        );
        $this->session->set_userdata($session);
        return TRUE;
    }

    function setFormType() {
        $i_id_type = array(
            'id' => 'id_type',
            'name' => 'id_type',
            'value' => set_value('id_type'),
            'type' => 'number',
            'autocomplete' => 'off',
            'class' => 'form-control');
        $i_type_name = array(
            'id' => 'type_name',
            'name' => 'type_name',
            'value' => set_value('type_name'),
            'autocomplete' => 'off',
            'class' => 'form-control');
        $i_type_des = array(
            'id' => 'type_des',
            'name' => 'type_des',
            'value' => set_value('type_des'),
            'autocomplete' => 'off',
            'class' => 'form-control');

        $data = array(
            'id_type' => form_input($i_id_type),
            'type_name' => form_input($i_type_name),
            'type_des' => form_textarea($i_type_des),
        );
        return $data;
    }

    function setValidationType() {
        $this->form_validation->set_rules('id_type', '', 'trim|required');
        $this->form_validation->set_rules('type_name', '', 'trim|required');
        $this->form_validation->set_rules('type_des', '', 'trim');
        return true;
    }

    function getPostType() {
        $data = array(
            'id_type' => $this->input->post('id_type'),
            'type_name' => $this->input->post('type_name'),
            'type_des' => $this->input->post('type_des'),
        );
        return $data;
    }

    function setFormUser() {
        $i_id_user = array(
            'id' => 'id_user',
            'name' => 'id_user',
            'value' => set_value('id_user'),
            'autocomplete' => 'off',
            'class' => 'form-control');
        $i_user_pass = array(
            'id' => 'user_pass',
            'name' => 'user_pass',
            'value' => set_value('user_pass'),
            'autocomplete' => 'off',
            'class' => 'form-control');
        $i_user_name = array(
            'id' => 'user_name',
            'name' => 'user_name',
            'value' => set_value('user_name'),
            'autocomplete' => 'off',
            'class' => 'form-control');

        $data = array(
            'id_user' => form_input($i_id_user),
            'user_pass' => form_password($i_user_pass),
            'user_name' => form_input($i_user_name),
        );
        return $data;
    }

    function setValidationUser() {
        $this->form_validation->set_rules('id_user', '', 'trim|required');
        $this->form_validation->set_rules('user_pass', '', 'trim|required');
        $this->form_validation->set_rules('user_name', '', 'trim|required');
        return true;
    }

    function getPostUser() {
        $data = array(
            'id_user' => $this->input->post('id_user'),
            'user_pass' => $this->input->post('user_pass'),
            'user_name' => $this->input->post('user_name'),
        );
        return $data;
    }

}
