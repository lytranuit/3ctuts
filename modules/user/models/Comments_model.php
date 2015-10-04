<?php

class Comments_model extends CI_Model {

    protected $table_Name = 'comments';

    function __construct() {
        parent::__construct();
    }

    function select_comment($id) {
        $this->db->select('*');
        $this->db->join('users', 'users.id = comments.id_user','inner');
        $this->db->where('id_news',$id);
        $this->db->where('comments.deleted', 0);
        $this->db->order_by('id_comment','DESC');
        $query = $this->db->get($this->table_Name);
        $return = $query->result_array();
        return $return;
    }
    
    function insert($data){
       $this->db->insert($this->table_Name, $data); 
    }
}
