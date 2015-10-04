<?php

class Comments extends CI_Controller {

    public function __construct() {
         parent::__construct();
         //$this->load->library('session/session');
    }

    public function tran() {
        echo "tran";
        $this->load->view('comments');
    }

}
