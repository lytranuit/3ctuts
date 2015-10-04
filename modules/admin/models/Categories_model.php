<?php

class Categories_model extends CI_Model {

    protected $table_Name = 'categories';

    public function __construct() {
        parent::__construct();
    }

    function select_categories() {
        $sql1 = "Select * from $this->table_Name where `deleted` = 0 and `level` = 0";
        $query1 = $this->db->query($sql1);
        $return1 = $query1->result_array();
        return $return1;
    }
    function select_get_categories() {
        $sql1 = "Select * from $this->table_Name where `deleted` = 0 and `level` = 0";
        $sql2 = "Select * from $this->table_Name where `deleted` = 0 and `level` = 1";
        $query1 = $this->db->query($sql1);
        $return1 = $query1->result_array();
        $query2 = $this->db->query($sql2);
        $return2 = $query2->result_array();
        foreach ($return1 as &$root) {
            $root['child'] = array();
            foreach ($return2 as $con) {
                if ($root['id_categories'] == $con['id_parent']) {
                    array_push($root['child'], $con);
                }
            }
        }
        return $return1;
    }

    function select_library() {
        $sql1 = "Select * from $this->table_Name where `deleted` = 0 and `level` = 0";
        $sql2 = "Select * from $this->table_Name where `deleted` = 0 and `level` = 1";
        $sql3 = "Select * from software where `deleted` = 0";
        $sql4 = "Select * from categories_software where `deleted` = 0";
        $sql = "Select a.id_categories as idparent,a.name_categories as nameparent,a.alias_categories as aliasparent,b.id_categories as idcon,b.name_categories as namecon,b.alias_categories as aliascon,c.id as idsoft,c.name as namesoft,c.alias as aliassoft from ($sql1) as a,($sql2) as b,($sql3) as c,($sql4) as d where a.id_categories = b.id_parent and a.id_categories = d.id_categories and c.id = d.id_software ORDER BY idparent";
        $query = $this->db->query($sql);
        $query1 = $this->db->query($sql1);
        $return = $query->result_array();
        $return1 = $query1->result_array();
        $array = array();
        foreach ($return as $row) {
            if (array_key_exists($row['idparent'], $array)) {
                if (array_key_exists($row['idcon'], $array[$row['idparent']]['child'])) {
                    
                } else {
                    $array[$row['idparent']]['child'][$row['idcon']] = array('idcon' => $row['idcon'], 'namecon' => $row['namecon'], 'aliascon' => $row['aliascon']);
                }
                if (array_key_exists($row['idsoft'], $array[$row['idparent']]['soft'])) {
                    
                } else {
                    $array[$row['idparent']]['soft'][$row['idsoft']] = array('idsoft' => $row['idsoft'], 'namesoft' => $row['namesoft'], 'aliassoft' => $row['aliassoft']);
                }
            } else {
                $array[$row['idparent']] = array('idparent' => $row['idparent'], 'nameparent' => $row['nameparent'], 'aliasparent' => $row['aliasparent'], 'child' => array(), 'soft' => array());
                $array[$row['idparent']]['child'][$row['idcon']] = array('idcon' => $row['idcon'], 'namecon' => $row['namecon'], 'aliascon' => $row['aliascon']);
                $array[$row['idparent']]['soft'][$row['idsoft']] = array('idsoft' => $row['idsoft'], 'namesoft' => $row['namesoft'], 'aliassoft' => $row['aliassoft']);
            }
        }
        return $array;
    }

    function select_categories_diff($id) {
        $this->db->where('id_categories !=', $id);
        $this->db->where('deleted', 0);
        $query = $this->db->get($this->table_Name);
        $return = $query->result_array();
        return $return;
    }

    function select_software() {
        $this->db->where("deleted", 0);
        $query = $this->db->get('software');
        $return = $query->result_array();
        return $return;
    }

    function select_software_categories($id_cate) {
        $sql = "SELECT a.id,a.name,a.alias FROM software as a,categories_software as b WHERE a.id = b.id_software and FIND_IN_SET(b.id_categories, ?) ORDER BY a.id";
        $query = $this->db->query($sql, array($id_cate));
        $return = $query->result_array();
        return $return;
    }

    function check_root($id_cate) {
        $sql = "SELECT * FROM categories WHERE deleted = 0 and id_parent = 0 And id_categories = ? ";
        $query = $this->db->query($sql, array($id_cate));
        $return = $query->result_array();
        if (count($return)) {
            return true;
        } else {
            return false;
        }
    }

    function get_root($id_cate) {
        $sql = "SELECT id_parent FROM categories WHERE deleted = 0 and id_categories = ?";
        $query = $this->db->query($sql, array($id_cate));
        $return = $query->result_array();
        return $return[0]['id_parent'];
    }

    function check_con($id_cate) {
        $sql = "SELECT * FROM categories WHERE deleted = 0 and id_parent = ?";
        $query = $this->db->query($sql, array($id_cate));
        $return = $query->result_array();
        if (count($return)) {
            return true;
        } else {
            return false;
        }
    }

    function get_con($id_cate) {
        $sql = "SELECT * FROM categories WHERE deleted = 0 and (id_parent = ? or id_categories = ?)";
        $query = $this->db->query($sql, array($id_cate, $id_cate));
        $return = $query->result_array();
        return $return;
    }

    function select_level() {
        $this->db->where('deleted', 0);
        $query = $this->db->get('software_type');
        $return = $query->result_array();
        return $return;
    }

    function select_breadcrumb($id_cate, $id_soft, $id_level) {

        if ($this->check_root($id_cate)) {
            $sql1 = "SELECT id_categories as id,name_categories as name,alias_categories as alias FROM categories WHERE deleted = 0 and id_categories = $id_cate";
        } else {
            $id_root = $this->get_root($id_cate);
            $sql1 = "SELECT id_categories as id,name_categories as name,alias_categories as alias FROM categories WHERE deleted = 0 and id_categories = $id_cate or id_categories = $id_root ";
        }
        $sql2 = "SELECT id,name,alias FROM software WHERE deleted = 0 and id = $id_soft";
        $sql3 = "SELECT id,name,alias FROM software_type WHERE deleted = 0 and id = $id_level";
        $sql = "($sql1) UNION ALL ($sql2) UNION ALL ($sql3)";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

}
