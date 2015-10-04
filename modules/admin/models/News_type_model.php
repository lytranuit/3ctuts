<?php 
class News_type_model extends CI_Model{
    protected $table_Name = 'news_type';

    public function __construct() {
        parent::__construct();
    }
    
    function select_news_type(){
        $this->db->where('deleted',0);
        $query = $this->db->get($this->table_Name);
        $return = $query->result_array();
        return $return;
    }
}