<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'mLogin', TRUE);
    }

    public function index() {
        $userid = $this->input->post('userid');
        $userpass = $this->input->post('userpass');
        if (isset($userid) && isset($userpass)) {
            $user_info = $this->mLogin->check_user($userid, $userpass);
            if ($user_info != FALSE && $this->mLogin->login($user_info)) {
                redirect('home');
            }
        }
        $this->load->view('login_page');
    }

}
