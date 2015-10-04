<?php

class User extends CI_Controller {

    private $_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('auth/Ion_auth');

        $this->load->model('admin/news_model');
        $this->load->model('admin/categories_model');
        $this->_data['library'] = $this->categories_model->select_library();
        $this->dashboard();
    }

    /*
     * Hàm �?i�?u Khiển chính trong trang web
     */

    public function index() {
        //Comments::tran();
// Please note you can also query against your account and find all the profiles associated with it by
// grab all profiles within your account
        //$data['accounts'] = $this->ga_api->login()->get_accounts();
        // $this->_data['accounts'] = $this->ga_api->login()->get_accounts();
        $this->_data['software'] = $this->news_model->select_all_videos_software();
        $this->_data['num_video_software'] = $this->news_model->select_num_video_all();
        //print_r($this->_data['num_video_software']);
        $this->_data['title'] = 'Trang chủ - 3ctuts - Kết nối đam mê';
        $this->_data['main'] = 'home';
        //print_r($this->_data['comments']);
        $this->load->view('template', $this->_data);
    }

    public function tran() {
        $this->dashboard();
    }

    public function hide() {
        echo $file = './public/upload/1434879289_1.mp4';
        exit();
    }

    /*
     * Hàm đi�?u khiển lấy thêm 10 comment nếu Ngư�?i dung yêu cầu.
     */

    public function get_10_comments() {
        
    }

    /*
     * Hàm �?i�?u Khiển thêm Comment vào cơ sở dữ liệu 
     */

    public function c_insert_comment() {
        $content = $this->input->post('content');
        $this->load->model('Comments');
        $this->Comments->insert_comment($content);
        $this->_data['content'] = $content;
        $this->_data['date'] = date('Y-m-d H:i:s', time());
        $this->load->view('comment_view', $this->_data);
    }

    public function news($id) {
        if (isset($id)) {
            //print_r($this->session->all_userdata());
            $this->load->model('comments_model');
            $this->load->library("fb_comments");
            $this->_data['main'] = 'news';
            //id bài vết
            $this->_data['id_news'] = $id;
            // select bài viết
            $news = $this->news_model->select_video($id);
            $this->_data['title'] = $news[0]['title'] . ' - 3ctuts';
            $this->_data['news'] = $news;

            ///////// Select menu //////////
            $breadcrumb = $this->categories_model->select_breadcrumb($news[0]['id_categories'], $news[0]['id_software'], $news[0]['id_level']);

            if (count($breadcrumb) == 4) {
                $breadcrumb[0]['url'] = base_url() . $breadcrumb[0]['alias'] . '-c' . $breadcrumb[0]['id'] . '-s0-l0-a0.html';
                $breadcrumb[1]['url'] = base_url() . $breadcrumb[0]['alias'] . '/' . $breadcrumb[1]['alias'] . '-c' . $breadcrumb[1]['id'] . '-s0-l0-a0.html';
                $breadcrumb[2]['url'] = base_url() . $breadcrumb[0]['alias'] . '/' . $breadcrumb[1]['alias'] . '/' . $breadcrumb[2]['alias'] . '-c' . $breadcrumb[1]['id'] . '-s' . $breadcrumb[2]['id'] . '-l0-a0.html';
                $breadcrumb[3]['url'] = base_url() . $breadcrumb[0]['alias'] . '/' . $breadcrumb[1]['alias'] . '/' . $breadcrumb[2]['alias'] . '-c' . $breadcrumb[1]['id'] . '-s' . $breadcrumb[2]['id'] . '-l' . $breadcrumb[3]['id'] . '-a0.html';
            } else {
                $breadcrumb[0]['url'] = base_url() . $breadcrumb[0]['alias'] . '-c' . $breadcrumb[0]['id'] . '-s0-l0-a0.html';
                $breadcrumb[1]['url'] = base_url() . $breadcrumb[0]['alias'] . '/' . $breadcrumb[1]['alias'] . '-c' . $breadcrumb[0]['id'] . '-s' . $breadcrumb[1]['id'] . '-l0-a0.html';
                $breadcrumb[2]['url'] = base_url() . $breadcrumb[0]['alias'] . '/' . $breadcrumb[1]['alias'] . '-c' . $breadcrumb[0]['id'] . '-s' . $breadcrumb[1]['id'] . '-l' . $breadcrumb[2]['id'] . '-a0.html';
            }


            $this->_data['breadcrumb'] = $breadcrumb;
            //print_r($this->_data['breadcrumb']);
            //END
            //update views
            $views = $news[0]['views'] + 1;
            $this->news_model->update($id, array('views' => $views));
            // select comment v�? bài viết
            $this->_data['comments'] = $this->comments_model->select_comment($id);
            //select bài viết liên quan
            if ($news[0]['video']) {
                $type = 'video';
                $this->_data['news_lq'] = $this->news_model->select_videos_lq($id, $news[0]['id_software'], null, $type);
                //print_r($this->_data['news_lq']);
            } else {
                $type = 'news';
                $this->_data['news_lq'] = $this->news_model->select_videos_lq($id, $news[0]['id_software'], null, $type);
            }
            //select các chuyên mục khác
            $this->_data['categories'] = $this->categories_model->select_categories_diff($news[0]['id_categories']);
            //print_r($this->_data['comments']);
            $this->load->view('user/template', $this->_data);
        }
    }

    public function addcomment() {
        if ($this->input->get('comment') != '') {
            $id_news = $this->input->get('id_news');
            $id_user = $this->input->get('id_user');
            $comment = $this->input->get('comment');
            $data = array('comment' => $comment, 'id_user' => $id_user, 'id_news' => $id_news);
            $this->load->model('comments_model');
            $this->comments_model->insert($data);
            //echo "tran2";
            return false;
        }
    }

    function new_create() {
        $this->_data['title'] = "Create news";
        $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('description', 'Mô tả', 'required');
        if ($this->form_validation->run() == true) {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $categories = $this->input->post('categories');
            $content = $this->input->post('content');
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
                'id_auth' => $id_auth,
                'show' => 1
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
            redirect('/', 'refresh');
        } else {
            // config upload 
            ////
            //display the create user form
            //set the flash data error message if there is one
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->_data['categories'] = $this->categories_model->select_get_categories();
            ////////////Sidebar//////////
            $this->sidebar_widget();
            ///////////
            $this->_data['software'] = $this->categories_model->select_software(5);

            $this->_data['level'] = $this->categories_model->select_level();
            $this->_data['main'] = 'new_create';
            $this->_data['id_auth'] = $this->session->userdata('user_id');
            $this->load->view('user/template', $this->_data);
        }
    }

    function video_edit($id) {
        $this->_data['title'] = "Video edit";
        //display the create user form
        //set the flash data error message if there is one
        $this->form_validation->set_rules('title', 'Tiêu đee?', 'required');
        $this->form_validation->set_rules('description', 'Mô tả', 'required');
        $this->form_validation->set_rules('categories', 'Thể loại', 'required');
        if ($this->form_validation->run() == true) {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $categories = $this->input->post('categories');
            $software = $this->input->post('software');
            $level = $this->input->post('level');
            $content = $this->input->post('content');
            $show = $this->input->post('show');
            $additional_data = array(
                'title' => $title,
                'description' => $description,
                'id_level' => $level,
                'id_categories' => $categories,
                'id_software' => $software,
                'content' => $content,
                'show' => $show
            );
            $this->news_model->update($id, $additional_data);
            redirect('user/video_manager/' . $this->session->userdata('user_id'), 'refresh');
        } else {
            $this->sidebar_widget();
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $video = $this->news_model->select_video($id);
            if ($video[0]['id_auth'] == $this->session->userdata('user_id')) {
                $this->_data['video'] = $video;
                $this->_data['main'] = 'video_edit';
                $this->_data['categories'] = $this->categories_model->select_get_categories();
                $this->_data['software'] = $this->categories_model->select_software(5);
                $this->_data['level'] = $this->categories_model->select_level();
                $this->load->view('user/template', $this->_data);
            }
        }
    }

    public function video_remove($id) {
        $video = $this->news_model->select_video($id);
        if ($video[0]['id_auth'] == $this->session->userdata('user_id')) {
            $additional_data = array(
                'deleted' => 1
            );
            $this->news_model->update($id, $additional_data);
            redirect('user/video_manager/' . $this->session->userdata('user_id'), 'refresh');
        }
    }

    public function video_manager($id_auth) {
        $this->sidebar_widget();
        $this->_data['title'] = 'Video Manager';
        $this->_data['videos'] = $this->news_model->select_videos($id_auth);
        $this->_data['main'] = 'video_manager';
        $this->load->view('user/template', $this->_data);
    }

    function categories($id_cate = null, $id_soft = null, $id_level = null, $id_auth = NULL) {
        $this->_data['title'] = 'Chuyên mục';
        $this->_data['main'] = 'categories';

        //// lấy giá trị truyên vào ban đầu //////////
        if (isset($_GET['q'])) {
            $sSearch = $_GET['q'];
        } else {
            $sSearch = null;
        }
        if ($id_cate == 0) {
            $id_cate = null;
        }
        if ($id_soft == 0) {
            $id_soft = null;
        }
        if ($id_level == 0) {
            $id_level = null;
        }
        if ($id_auth == 0) {
            $id_auth = null;
        }
        $this->_data['sSearch'] = $sSearch;
        $this->_data['catecurrent'] = $id_cate;
        $this->_data['softcurrent'] = $id_soft;
        $this->_data['levelcurrent'] = $id_level;
        $this->_data['authcurrent'] = $id_auth;
        /////////////END./////////////////
        ////////Lấy các Video//////////
        //$this->get_video($id_cate, $id_soft, $id_level, $id_auth);
        /////////////END./////////////////
        ///////////Lấy danh sách Chuyen mục/////////////
        $this->_data['categories'] = $this->categories_model->select_get_categories();
        ////////////END.////////////////////
        //////////////Lấy danh sach software ////////////

        if ($id_cate != null) {
            $check = $this->categories_model->check_root($id_cate);
            if ($check) {
                
            } else {
                $id_cate = $this->categories_model->get_root($id_cate);
            }
            $this->_data['soft'] = $this->categories_model->select_software_categories($id_cate);
        } else {
            $this->_data['soft'] = $this->categories_model->select_software();
        }
        ////////END////////////
        //
        ///////Lấy danh sách level/////////////
        $this->_data['level'] = $this->categories_model->select_level();
        //////////END//////////
        //
        /////////////Lấy danh sách Tác giả//////////////
        $this->_data['auth'] = $this->news_model->select_num_videos_users();
        /////////END///////////

        $this->load->view('template', $this->_data);
    }

    private function do_upload($filename, $field_name) {
        $config = array(
            'upload_path' => "./public/upload",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024",
            'file_name' => $filename
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($field_name)) {
            $data = $this->upload->data();
            $config = array("source_image" => $data['full_path'],
                "new_image" => "./public/upload/thumbs",
                "maintain_ration" => true,
                "width" => '480',
                "height" => '360',);
            $this->load->library("image_lib", $config);
            $this->image_lib->resize();
            return $data['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            return FALSE;
        }
    }

    public function do_upload_video() {
        $this->load->helper('file');
        $this->load->model('admin/video_model');
        $name = time() . '_' . $this->session->userdata('user_id');
        $upload_path_url = base_url() . 'public/upload/';

        $config['upload_path'] = FCPATH . 'public/upload/';
        $config['allowed_types'] = 'flv|mp4|mov';
        $config['max_size'] = '200000000'; // max size 200mb
        $config['file_name'] = $name;
        $config['overwrite'] = FALSE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            echo json_encode($this->upload->data());
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);
            //Load the list of existing files in the upload directory
            /*
              $existingFiles = get_dir_file_info($config['upload_path']);
              $foundFiles = array();
              $f = 0;
              foreach ($existingFiles as $fileName => $info) {
              if ($fileName != 'thumbs') {//Skip over thumbs directory
              //set the data for the json array
              $foundFiles[$f]['name'] = $fileName;
              $foundFiles[$f]['size'] = $info['size'];
              $foundFiles[$f]['url'] = $upload_path_url . $fileName;
              $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
              $foundFiles[$f]['deleteUrl'] = base_url() . 'admin/deleteImage/' . $fileName;
              $foundFiles[$f]['deleteType'] = 'DELETE';
              $foundFiles[$f]['error'] = null;

              $f++;
              }
              }
              $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode(array('files' => $foundFiles)));
             * 
             */
        } else {
            $data = $this->upload->data();
            //  echo json_encode($this->upload->data());die();
            $video = $data['full_path'];
            $command2 = shell_exec("ffmpeg -i $video 2>&1");
            $search = '/Duration: (.*?),/';
            preg_match($search, $command2, $matches);
            $time = substr($matches[1], 0, -3);
            $arrtime = explode(':', $time);
            $second = round($arrtime[2] / 2, 0);
            $image = FCPATH . 'public/upload/thumbs/' . $name . '.jpg';
            //
            $command = "ffmpeg  -itsoffset -$second  -i $video -vcodec mjpeg -vframes 1 -an -f rawvideo -s 320x180 $image";
            //
            //  $videoconvert = $data['full_path'];
            //   $convert = "ffmpeg -i $videoconvert -c:v libx264 -crf 23 -profile:v high -r 30 -c:a libfaac -q:a 100 -ar 48000 " . FCPATH . 'public/upload/thumbs/' . $name . ".mp4";
            //   shell_exec($convert);
            //}
            shell_exec($command);
            //

            $data_add = array(
                'video' => $data['file_name'],
                //'video_name' => ,
                'img_video' => $name . '.jpg',
                'duration' => $time
            );
            $this->video_model->insert($data_add);
            /*
             * Array
              (
              [file_name] => png1.jpg
              [file_type] => image/jpeg
              [file_path] => /home/ipresupu/public_html/uploads/
              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
              [raw_name] => png1
              [orig_name] => png.jpg
              [client_name] => png.jpg
              [file_ext] => .jpg
              [file_size] => 456.93
              [is_image] => 1
              [image_width] => 1198
              [image_height] => 1166
              [image_type] => jpeg
              [image_size_str] => width="1198" height="1166"
              )

              // to re-size for thumbnail images un-comment and set path here and in json array
              $config = array();
              $config['image_library'] = 'gd2';
              $config['source_image'] = $data['full_path'];
              $config['create_thumb'] = TRUE;
              $config['new_image'] = $data['file_path'] . 'thumbs/';
              $config['maintain_ratio'] = TRUE;
              $config['thumb_marker'] = '';
              $config['width'] = 75;
              $config['height'] = 50;
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();
             */

            //set the data for the json array
            $info = new StdClass;
            $info->name = $data['file_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            //$info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
            $info->deleteUrl = '/user/deleteImage/' . $data['file_name'];
            $info->deleteType = 'GET';
            $info->error = null;
            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if (IS_AJAX) {
                echo json_encode(array("files" => $files));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                // so that this will still work if javascript is not enabled
            } else {
                $file_data['upload_data'] = $this->upload->data();
                //$this->load->view('upload/upload_success', $file_data);
            }
        }
    }

    public function deleteImage($file) {//gets the job done but you might want to add error checking and security
        if (file_exists(FCPATH . 'public/upload/' . $file))
            $success = unlink(FCPATH . 'public/upload/' . $file);
        //$success = unlink(FCPATH . 'public/upload/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'public/upload/' . $file;
        $info->file = is_file(FCPATH . 'public/upload/' . $file);

        if (IS_AJAX) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete        
            $file_data['delete_data'] = $file;
            //$this->load->view('admin/delete_success', $file_data);
        }
    }

    function get_sofware($id_cate) {

        $check = $this->categories_model->check_root($id_cate);
        if ($check) {
            $data = $this->categories_model->select_software_categories($id_cate);
        } else {
            $id_cate = $this->categories_model->get_root($id_cate);
            $data = $this->categories_model->select_software_categories($id_cate);
        }

        echo json_encode($data);
    }

    private function sidebar_widget() {
        $id = $this->session->userdata('user_id');
        $this->load->library('Auth/ion_auth');
        $user = $this->ion_auth->user($id)->row();
        $this->_data['user'] = $user;
    }

    function hide_url() {

        $this->load->library('VideoStream');
        $file = './public/upload/1434879289_1 . mp4';
        $stream = new VideoStream($file);
        $stream->start();
    }

    public function get_video() {
        $id_cate = null;
        $id_soft = null;
        $id_level = null;
        $id_auth = null;
        $search = null;
        $arr = $_GET['data'];
        $arr = json_decode($arr);
        foreach ($arr as $row) {
            switch ($row->type) {
                case 'cate':
                    $id_cate = $row->value == '' ? null : $row->value;
                    break;
                case 'soft':
                    $id_soft = $row->value == '' ? null : $row->value;
                    break;
                case 'level':
                    $id_level = $row->value == '' ? null : $row->value;
                    break;
                case 'auth':
                    $id_auth = $row->value == '' ? null : $row->value;
                    break;
                case 'search':
                    $search = $row->value == '' ? null : $row->value;
                    break;
            }
        }
        $checkcon = $this->categories_model->check_con($id_cate);
        $arr = array();
        if ($checkcon) {
            $cates = $this->categories_model->get_con($id_cate);
            foreach ($cates as $row) {
                array_push($arr, $row['id_categories']);
            }
            $cate = implode(",", $arr);
            $data = $this->news_model->select_videos_categories($search, $cate, $id_soft, $id_level, $id_auth);
        } else {
            if ($id_cate == 26) {
                $data = $this->news_model->select_videos_categories($search, null, $id_soft, $id_level, $id_auth);
            } else {
                $data = $this->news_model->select_videos_categories($search, $id_cate, $id_soft, $id_level, $id_auth);
            }
        }
        $this->load->model('comments_model');
        foreach ($data as &$row) {
            $row['numcomments'] = count($this->comments_model->select_comment($row['id_news']));
        }
        echo json_encode($data);
    }

    public function trackuser() {
        $this->load->model('trackuser_model');
        $session = $_GET['session'];
        $user = $_GET['user'];
        $page = $_GET['page'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = array(
            'session' => $session,
            'page' => $page,
            'id_user' => $user,
            'ip' => $ip
        );
        $result = $this->trackuser_model->insert($data);
    }

    private function dashboard() {
        $this->load->model('trackuser_model');
        $this->_data['online'] = $this->trackuser_model->online();
        $this->_data['allvideos'] = $this->trackuser_model->allvideos();
        $this->_data['allviews'] = $this->trackuser_model->allviews();
    }

}
