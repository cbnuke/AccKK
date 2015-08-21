<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounting_model extends CI_Model {

    function listTransaction($type = NULL) {
        $this->db->from('tbl_transaction');
        if ($type == 'income') {
            $this->db->where('income IS NOT NULL');
        } elseif ($type == 'outcome') {
            $this->db->where('outcome IS NOT NULL');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function setFormTransaction() {
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

        $i_money_type = '<div class="radio"><label>';
        $i_money_type .= form_radio('money_type', 'debit', TRUE) . 'DEBIT</label></div>';
        $i_money_type .= '<div class="radio col-lg-offset-1"><label>';
        $i_money_type .= form_radio('money_type', 'credit', FALSE) . 'CREDIT</label></div>';

        $options = array();
        $query = $this->db->get('tbm_type');
        $temp = $query->result_array();
        foreach ($temp as $row) {
            $options[$row['id_type']] = $row['type_name'];
        }
        reset($options);

        $data = array(
            'income' => form_input($i_income),
            'outcome' => form_input($i_outcome),
            'money_type' => $i_money_type,
            'id_type' => form_dropdown('id_type', $options, key($options), array('class' => 'form-control')),
            'action_date' => form_input($i_action_date),
            'comment' => form_textarea($i_comment),
        );
        return $data;
    }

    function setValidationTransaction() {
        $this->form_validation->set_rules('income', '', 'trim');
        $this->form_validation->set_rules('outcome', '', 'trim');
        $this->form_validation->set_rules('money_type', '', 'trim|required');
        $this->form_validation->set_rules('id_type', '', 'trim|required');
        $this->form_validation->set_rules('action_date', '', 'trim|required');
        $this->form_validation->set_rules('comment', '', 'trim');
        return true;
    }

    function getPostTransaction($id_tran = NULL) {
        $data = array(
            'income' => $this->input->post('income'),
            'outcome' => $this->input->post('outcome'),
            'money_type' => $this->input->post('money_type'),
            'id_type' => $this->input->post('id_type'),
            'action_date' => date("Y-m-d H:i", strtotime($this->input->post('action_date'))),
            'comment' => $this->input->post('comment'),
        );
        if ($id_tran != NULL) {
            $data['id_tran'] = $id_tran;
        }
        return $data;
    }

}
