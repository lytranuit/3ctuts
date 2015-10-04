<?php

class Categories extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->_data['title'] = 'categories';
        $this->_data['main'] = 'categories';
        //print_r($this->_data['comments']);
        $this->load->view('template', $this->_data);
    }

}
