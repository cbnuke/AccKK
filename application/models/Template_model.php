<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Template_model extends CI_Model {

    private $title = 'ระบบบัญชี';
    private $view_name = NULL;
    private $set_data = NULL;
    private $breadcrumb_data = array();
    private $permission = "ALL";
    private $debud_data = NULL;
    private $lang_value = array('theme');
    private $version = '1.0';

    function set_Debug($data) {
        $this->debud_data = $data;
    }

    function set_Title($name) {
        $this->title = $name . ' | ' . $this->title;
    }

    function set_Content($name, $data = NULL) {
        $this->view_name = $name;
        $this->set_data = $data;
    }

    function set_Breadcrumb($data) {
        $this->breadcrumb_data = $data;
    }

    function set_Permission($mode) {
        $this->permission = $mode;
    }

    function check_permission() {
        $sess = $this->session->userdata('login');
        if ($sess == NULL || $sess == FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    function set_Language($in) {
        foreach ($in as $data) {
            array_push($this->lang_value, $data);
        }
    }

    function showTemplate() {
        //Check login
        if ($this->check_permission() == FALSE) {
            redirect('login');
        }

        //Load version for Cache CSS and JS
        $data['version'] = $this->version;

        //Load session user data
        $data['id_user'] = $this->session->userdata('id_user');
        $data['user_name'] = $this->session->userdata('user_name');
        $data['create_date'] = $this->session->userdata('create_date');

        //Load page title
        $data['title'] = $this->title;

        //Data to view
        $data_view = $this->set_data;

        //Data to nav
        $data_nav['debug'] = $this->debud_data;
        $data_nav['page'] = ($this->uri->segment(1) != NULL) ? $this->uri->segment(1) : 'home';
        $data_nav['subpage'] = $this->uri->segment(2);

        $data_nav['name'] = $this->session->userdata('name');
        $data_nav['position'] = $this->session->userdata('position');
        $data_nav['per_name'] = $this->session->userdata('per_name');
        $data_nav['per_value'] = $this->session->userdata('per_value');
        $data_nav['picture'] = $this->session->userdata('picture');

        //--- Alert System ---//
        $data_nav['alert'] = $this->session->userdata('alert');
        $this->session->unset_userdata('alert');

        $this->load->view('theme_header', $data);
        $this->load->view('theme_nav', $data_nav);
        if ($this->view_name != NULL) {
            $this->load->view($this->view_name, $data_view);
        }
        $this->load->view('theme_footer', $data);
    }

}
