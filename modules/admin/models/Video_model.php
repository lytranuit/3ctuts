<?php 
class Video_model extends CI_Model{
    protected $table_Name = 'video';

    public function __construct() {
        parent::__construct();
    }
    
   function insert($data){
         $this->db->insert($this->table_Name, $data); 
   }
}