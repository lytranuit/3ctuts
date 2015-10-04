<?php 
class Groups_model extends CI_Model{
    protected $table_Name = 'groups';

    public function __construct() {
        parent::__construct();
    }
    
    function select_groups(){
        $this->db->where('deleted',0);
        $query = $this->db->get($this->table_Name);
        $return = $query->result_array();
        return $return;
    }
}