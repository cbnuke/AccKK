<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
//        echo '<pre>';
//        print_r($this->session->userdata());
//        echo '</pre>';
        $this->template->set_Content('home');
        $this->template->showTemplate();
    }

}
