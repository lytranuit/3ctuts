<?php

class Articles extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->_data['title'] = 'News';
        $this->_data['main'] = 'user/news';
        //print_r($this->_data['comments']);
        $this->load->view('user/template', $this->_data);
    }

}
