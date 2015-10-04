<?php

class News_model extends CI_Model {

    protected $table_Name = 'news';

    public function __construct() {
        parent::__construct();
    }

////admin
    function select_news_all_manager() {
        $this->db->select('id_news,news.alias,title,description,username,content,categories.name_categories,views,date,img,video,news.deleted,news.status');
        $this->db->from('news');
        $this->db->join('categories', 'categories.id_categories = news.id_categories', 'inner');
        $this->db->join('users', ' users.id= news.id_auth', 'inner');
        $this->db->where('news.deleted', 0);
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    function select_video($id) {
        $this->db->from('news as a');
        $this->db->join('categories as b', 'a.id_categories = b.id_categories', 'inner');
        $this->db->join('users as c', ' c.id= a.id_auth', 'inner');
        $this->db->where('a.deleted', 0);
        $this->db->where('a.id_news', $id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    function select_videos($id_auth) {
        $sql = "SELECT * "
                . "FROM news a LEFT JOIN users b ON a.id_auth = b.id "
                . "WHERE a.deleted = 0 AND b.deleted = 0 AND a.id_auth = IFNULL(?,a.id_auth)";
        $query = $this->db->query($sql, array($id_auth));
        $return = $query->result_array();
        return $return;
    }

    function select_all_videos_software() {
        $sql = "Select a.id_software,b.name FROM news as a LEFT JOIN software as b ON a.id_software = b.id WHERE a.deleted = 0 and a.show = 1 and a.status = 1 AND a.id_software <> 10 Group by a.id_software";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        foreach ($return as &$row) {
            $row['videos'] = $this->select_videos_home($row['id_software'], 12);
        }
        return $return;
    }

    function select_videos_home($id_software, $limit) {
        $sql = "SELECT * "
                . "FROM news a LEFT JOIN users b ON a.id_auth = b.id "
                . "WHERE a.deleted = 0 AND b.deleted = 0 and a.show = 1 and a.status = 1 AND a.id_software = IFNULL(?,a.id_software) ORDER BY a.date DESC LIMIT $limit";
        $query = $this->db->query($sql, array($id_software));
        $return = $query->result_array();
        return $return;
    }

    function insert_news($data) {
        $this->db->insert($this->table_Name, $data);
    }

    function update($id, $data) {
        $this->db->where('id_news', $id);
        $this->db->update($this->table_Name, $data);
    }

    function select_videos_lq($id, $software, $limit, $type) {
        $this->db->select('news.id_news,news.title,news.img,users.username,news.views,news.alias');
        if ($type == 'video') {
            $this->db->where('news.video !=', NULL);
        } else {
            $this->db->where('news.video', NULL);
        }
        $where = "news.id_software = $software AND news.id_news <> $id AND  news.deleted = 0 AND news.show = 1 AND news.status = 1";
        $this->db->where($where);
        $this->db->join('users', "users.id = $this->table_Name.id_auth", 'left');
        $this->db->order_by('news.date', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table_Name);
        $return = $query->result_array();
        return $return;
    }

    function select_num_video($id_soft) {
        $sql = "SELECT b.name as name ,count(*) as tong FROM news a LEFT JOIN software b  ON a.id_software = b.id WHERE a.deleted = 0 AND a.id_software = ? and a.show = 1 and a.status = 1";
        $query = $this->db->query($sql, array($id_soft));
        $return = $query->result_array();
        return $return;
    }

    function select_num_video_all() {
        $sql1 = "SELECT * FROM news where deleted = 0 and status = 1 and news.show = 1";
        $sql2 = "SELECT * FROM software where deleted = 0";
        $sql = "SELECT a.name as name,a.id as id,a.img as img,a.pos as pos,a.alias as alias,SUM(IF(b.id_software IS NOT NULL,1,0)) as tong FROM ($sql2) as a LEFT JOIN ($sql1) as b ON a.id = b.id_software GROUP BY a.name ORDER BY a.pos";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

    function select_videos_categories($search, $id_cate, $id_soft, $id_level, $id_auth) {
        $sql = "SELECT * "
                . "FROM news a LEFT JOIN users b ON a.id_auth = b.id "
                . "WHERE a.deleted = 0 AND b.deleted = 0 and a.show = 1 and a.status = 1 AND FIND_IN_SET(a.id_categories,IFNULL(?,a.id_categories)) AND a.id_software = IFNULL(?,a.id_software) AND a.id_level = IFNULL(?,a.id_level) AND a.id_auth = IFNULL(?,a.id_auth) AND (a.title LIKE  '%".$this->db->escape_like_str($search)."%' OR b.username LIKE  '%".$this->db->escape_like_str($search)."%') ORDER BY a.date ASC";
        $query = $this->db->query($sql, array($id_cate, $id_soft, $id_level, $id_auth));
        $return = $query->result_array();
        return $return;
    }

    function select_num_videos_users() {
        $sql1 = "Select id_auth from news where deleted = 0 and news.show = 1 and status = 1";
        $sql2 = "Select id,username from users";
        $sql = "Select b.id as id,b.username as name,Count(*) as tong from ($sql1) as a LEFT JOIN ($sql2) as b ON a.id_auth = b.id Group by id,name";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

}
