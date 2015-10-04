<?php

class Trackuser_model extends CI_Model {

    protected $table_Name = 'history_user';

    function __construct() {
        parent::__construct();
    }

    function insert($data) {
        $this->db->insert($this->table_Name, $data);
    }

    function online() {
        $date = date('Y-m-d H:i:s', time() - 900);
        $sql = "select IFNULL(SUM(IF(id_user = 0,1,0)),0) as guest,IFNULL(SUM(IF(id_user <> 0 ,1,0)),0) as member from history_user as a join 
        (select ip, max(date) as date from history_user where date >= '$date' group by ip) as b on a.ip = b.ip and a.date = b.date";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

    function allvideos() {
        $sql = "SELECT COUNT(*) as numvideos FROM news where deleted = 0 and news.show = 1 and status = 1";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

    function allviews() {
        $sql = "SELECT COUNT(*) as numviews FROM history_user where deleted = 0 ";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

}
