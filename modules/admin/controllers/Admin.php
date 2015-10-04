<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('auth/Ion_auth');
        $this->load->helper('ckeditor');
        $this->_data['title'] = 'Admin Pages';
    }

    public function _remap($method, $params = array()) {
        if (!method_exists($this, $method)) {
            show_404();
        }
        if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('MOD')) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif ($this->ion_auth->is_admin()) {
            $this->$method($params);
        } elseif ($this->ion_auth->in_group('MOD')) {
            if (in_array($method, array('index', 'logout', 'manager', 'users_manager', 'news_manager', 'audit', 'video_remove'))) {
                $this->$method($params);
            } else {
                return show_error('Bạn không có quyền truy cập vào trang này');
            }
        }
    }

    function index() {
        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('MOD')) { //remove this elseif if you want to enable this for non-admins
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            redirect('admin/manager', 'refresh');
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('auth/login', 'refresh');
    }

    function manager() {
        //print_r($this->session->all_userdata());
        $this->_data['main'] = 'admin';
        $this->load->view('admin/template', $this->_data);
    }

    function users_manager() {
        if ($this->ion_auth->in_group('admin')) {
            $this->_data['users'] = $this->ion_auth->users()->result();
            foreach ($this->_data['users'] as $k => &$user) {
                if ($this->ion_auth->is_admin($user->id)) {
                    unset($this->_data['users'][$k]);
                } else {
                    $group = $this->ion_auth->get_users_groups($user->id)->result();
                    $user->groups = $group;
                }
            }
        } else {
            $this->_data['users'] = $this->ion_auth->users()->result();
            foreach ($this->_data['users'] as $k => &$user) {
                if ($this->ion_auth->in_group(array('MOD', 'admin'), $user->id)) {
                    unset($this->_data['users'][$k]);
                } else {
                    $group = $this->ion_auth->get_users_groups($user->id)->result();
                    $user->groups = $group;
                }
            }
        }
        $this->_data['main'] = 'users_manager';
        $this->load->view('admin/template', $this->_data);
    }

    function user_edit($params) {
        $id = $params[0];
        $groupData = $this->input->post('groups');
        if (isset($groupData) && !empty($groupData)) {

            $this->ion_auth->remove_from_group('', $id);

            foreach ($groupData as $grp) {
                $this->ion_auth->add_to_group($grp, $id);
            }
            redirect('admin/users_manager', 'refresh');
        } else {
            $this->load->model('groups_model');
            $user = $this->ion_auth->user($id)->row();
            $groups = $this->ion_auth->groups()->result_array();
            $currentGroups = $this->ion_auth->get_users_groups($id)->result();
            $this->_data['main'] = 'user_edit';
            $this->_data['id'] = $id;
            $this->_data['user'] = $user;
            $this->_data['groups'] = $groups;
            $this->_data['currentGroups'] = $currentGroups;
            $this->load->view('admin/template', $this->_data);
        }
    }

    function groups_manager() {
        $this->load->model('groups_model');
        $this->_data['main'] = 'groups_manager';
        $this->_data['groups'] = $this->groups_model->select_groups();
        $this->load->view('admin/template', $this->_data);
    }

    function news_manager() {
        $this->load->model('news_model');
        $this->_data['main'] = 'news_manager';
        $this->_data['news'] = $this->news_model->select_news_all_manager();
        $this->load->view('admin/template', $this->_data);
    }

    function new_edit($params) {
        $id = $params[0];
        $this->load->model('news_model');
        $this->load->model('categories_model');
        $this->load->model('news_type_model');
        //display the create user form
        //set the flash data error message if there is one
        $this->form_validation->set_rules('title', 'Tiêu đ�?', 'required');
        $this->form_validation->set_rules('description', 'Mô tả', 'required');
        $this->form_validation->set_rules('categories', 'Thể loại', 'required');
        $this->form_validation->set_rules('type', 'Loại', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');
        if ($this->form_validation->run() == true) {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $categories = $this->input->post('categories');
            $content = $this->input->post('content');
            $type = $this->input->post('type');
            $id_auth = $this->input->post('id_auth');
            $additional_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'id_type' => $this->input->post('type'),
                'id_categories' => $this->input->post('categories'),
                'content' => $this->input->post('content'),
                'id_auth' => $this->input->post('id_auth')
            );
            $this->news_model->update($id, $additional_data);
            redirect('admin/news_manager', 'refresh');
        } else {
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->_data['categories'] = $this->categories_model->select_get_categories();
            $this->_data['type'] = $this->news_type_model->select_news_type();
            $this->_data['id_auth'] = $this->session->userdata('user_id');
            $this->_data['main'] = 'new_edit';
            $this->_data['news'] = $this->news_model->select_new($id);
            $this->load->view('admin/template', $this->_data);
        }
    }

    function audit($params) {
        $this->load->model('news_model');
        $id = $params[0];
        $data = array('status' => 1);
        $result = $this->news_model->update($id, $data);
        echo $result;
    }

    function video_remove($params) {
        $this->load->model('news_model');
        $id = $params[0];
        $data = array('deleted' => 1);
        $result = $this->news_model->update($id, $data);
        redirect('admin/news_manager', 'refresh');
    }

    function categories_manager() {
        $this->load->model('categories_model');

        $this->_data['categories'] = $this->categories_model->select_categories();
        $this->_data['main'] = 'admin/categories_manager';
        $this->load->view('admin/template', $this->_data);
    }

    function new_create() {

        $this->_data['title'] = "Create news";
        $this->load->model('news_model');
        $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('description', 'Mô tả', 'required');
        if ($this->form_validation->run() == true) {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $categories = $this->input->post('categories');
            $content = $this->input->post('content');
            $type = $this->input->post('type');
            $software = $this->input->post('software');
            $id_auth = $this->input->post('id_auth');
            $level = $this->input->post('level');
            $additional_data = array(
                'title' => $title,
                'alias' => utf8convert($title),
                'description' => $description,
                'id_level' => $level,
                'id_categories' => $categories,
                'id_software' => $software,
                'content' => $content,
                'id_auth' => $id_auth
            );
            $type_up = $this->input->post('type_up');
            $video = false;
            $image = FALSE;
            if ($type_up == 'news') {
                $name = time() . '_' . $id_auth;
                $image = $this->do_upload($name, 'img');
                $additional_data['img'] = $image;
            } else {
                if (isset($_POST['video_name'])) {
                    $video = $this->input->post('video_name');
                    $additional_data['img'] = substr($video, 0, -4) . '.jpg';
                }
                $additional_data['video'] = $video;
            }
        }
        if ($this->form_validation->run() == true && ($image || $video)) {
            $this->news_model->insert_news($additional_data);
            redirect('admin/news_manager', 'refresh');
        } else {
            // config upload 
            ////
            $this->load->model('categories_model');
            //display the create user form
            //set the flash data error message if there is one
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->_data['categories'] = $this->categories_model->select_get_categories();

            $this->_data['software'] = $this->categories_model->select_software();

            $this->_data['level'] = $this->categories_model->select_level();

            $this->_data['main'] = 'admin/new_create';
            $this->_data['id_auth'] = $this->session->userdata('user_id');
            $this->load->view('admin/template', $this->_data);
        }
    }

    private function do_upload($filename, $field_name) {
        $config['upload_path'] = FCPATH . 'public/upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '200000'; // max size 500mb
        $config['file_name'] = $filename;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($field_name)) {
            $data = $this->upload->data();
            $config = array("source_image" => $data['full_path'],
                "new_image" => "./public/upload/thumbs",
                "maintain_ration" => true,
                "width" => '320',
                "height" => '180',);
            $this->load->library("image_lib", $config);
            $this->image_lib->resize();
            return $data['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            return FALSE;
        }
    }

}
