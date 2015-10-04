<?php

class Comments extends MY_Model {

    protected $table_Name = 'comments';

    public function __construct() {
        parent::__construct();
    }

    /*
     * Lấy danh sách tất cả các Comments
     */

    public function list_all_comments() {
        $this->db->order_by("id desc");
        $query = $this->db->get($this->table_Name);
        return $query->result_array();
    }

    /*
     * Lấy danh sách 10 comments
     */

    public function list_10_comments($start) {
        $this->db->order_by("id desc");
        $this->db->limit(10,$start);
        $query = $this->db->get($this->table_Name);
        return $query->result_array();
    }

    /*
     * Đếm tổng số dòng trong Table 
     */

    public function num_comments() {

        return $this->db->count_all($this->table_Name);
    }

    /*
     * Thêm Comment vào cơ sở dữ liệu
     */

    public function insert_comment($content) {
        $date = date('Y-m-d H:i:s', time());
        $this->db->insert($this->table_Name, array('id' => '', 'content' => $content, 'date' => $date));
    }

}
