<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    function check_user($user, $pass) {
        $this->db->from('tbm_user');
        $this->db->where('id_user', $user);
        $this->db->where('user_pass', md5($pass));
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result_array()[0];
        } else {
            return FALSE;
        }
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

}
