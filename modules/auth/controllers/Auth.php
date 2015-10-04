<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->model('admin/news_model');
        $this->load->model('admin/categories_model');
        $this->_data['library'] = $this->categories_model->select_library();
        $this->dashboard();
    }

    //redirect if needed, otherwise display the user list
    function index() {

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { //remove this elseif if you want to enable this for non-admins
            //redirect them to the home page because they must be an administrator to view this
            //return show_error('You must be an administrator to view this page.');
            redirect('', 'refresh');
        } else {
            //set the flash data error message if there is one
            redirect('admin/manager', 'refresh');
        }
    }

    //log the user in
    function login() {
        $this->_data['title'] = "Login";

        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page

                $this->session->set_flashdata('message', $this->ion_auth->messages());

                redirect('/', 'refresh');
            } else {
                //if the login was un-successful
                //redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $this->_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->_data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->_data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control'
            );
            $this->_data['main'] = 'user/login';

            $this->_render_page('user/template', $this->_data);
        }
    }

    //log the user out
    function logout() {
        $this->_data['title'] = "Logout";

        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/', 'refresh');
    }

    //change password
    function change_password($id) {
        $this->form_validation->set_rules('passwordold', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('password', $this->lang->line('change_password_validation_new_password_label'), 'required|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in() || (!($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }
        $user = $this->ion_auth->user($id)->row();

        if ($this->form_validation->run() == false) {
            //display the form
            //set the flash data error message if there is one
            $this->_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->_data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password'
            );
            $this->_data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password'
            );
            $this->_data['id'] = $id;
            $this->_data['user'] = $user;
            //render
            $this->_data['main'] = 'user/change_password';
            $this->_render_page('user/template', $this->_data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('passwordold'), $this->input->post('password'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    //forgot password
    function forgot_password() {
        $this->_data['title'] = 'Forgot Password';
        //setting validation rules by checking wheather identity is username or email
        $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');

        if ($this->form_validation->run() == false) {
            //setup the input
            $this->_data['email'] = array('name' => 'email',
                'id' => 'email',
                'class' => 'form-control'
            );
            //set any errors and display the form
            $this->_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->_data['main'] = 'user/forgot_password';
            $this->_render_page('user/template', $this->_data);
        } else {
            // get identity from username or email

            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            if (empty($identity)) {
                $this->ion_auth->set_message('forgot_password_email_not_found');
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/forgot_password", 'refresh');
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->email);

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    //reset password - final step for forgotten password
    public function reset_password($code = NULL) {
        $this->_data['title'] = 'Resset Password';
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                //display the form
                //set the flash data error message if there is one
                $this->_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->_data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->_data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'class' => 'form-control',
                    'pattern' => '^.{' . $this->_data['min_password_length'] . '}.*$',
                );
                $this->_data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->_data['min_password_length'] . '}.*$',
                    'class' => 'form-control'
                );
                $this->_data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->_data['csrf'] = $this->_get_csrf_nonce();
                $this->_data['code'] = $code;

                //render
                $this->_data['main'] = 'user/reset_password';
                $this->_render_page('user/template', $this->_data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    //activate the user
    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin() || $this->ion_auth->in_group("MOD")) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("admin/users_manager", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    //deactivate the user
    function deactivate($id = NULL) {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group("MOD"))) {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('Bạn không có quyền truy cập vào trang này');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->_data['csrf'] = $this->_get_csrf_nonce();
            $this->_data['user'] = $this->ion_auth->user($id)->row();
            $this->_data['main'] = 'admin/deactivate_user';
            $this->_render_page('admin/template', $this->_data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && ($this->ion_auth->is_admin() || $this->ion_auth->in_group("MOD"))) {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('admin/users_manager', 'refresh');
        }
    }

    //create a new user
    function create_user() {
        $this->_data['title'] = "Create User";

        //if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        //{
        //	redirect('auth', 'refresh');
        //}

        $tables = $this->config->item('tables', 'ion_auth');
        if (!$this->ion_auth->is_admin()) {
            $this->form_validation->set_rules('spamcheck', 'spamcheck', 'required');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|callback_username_unique');
            $this->form_validation->set_rules('email_confirm', 'Email Confirmation', 'required');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|matches[email_confirm]|callback_edit_unique');
        }
        if ($this->form_validation->run() == true) {
            $username = strtolower($this->input->post('username'));
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            if (!$this->ion_auth->is_admin()) {
                $this->_data['main'] = 'user/success_register';
                $this->_render_page('user/template', $this->_data);
            } else {
                redirect('admin/users_manager', 'refresh');
            }
        } else {
            //display the create user form
            //set the flash data error message if there is one
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->_data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->_data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->_data['username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('username'),
            );
            $this->_data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );

            $this->_data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->_data['address'] = array(
                'name' => 'address',
                'id' => 'address',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('address'),
            );
            $this->_data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->_data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );
            $this->_data['email_confirm'] = array(
                'name' => 'email_confirm',
                'id' => 'email_confirm',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email_confirm'),
            );
            if (!$this->ion_auth->is_admin()) {
                $this->_data['main'] = 'user/create_user';
                $this->_render_page('user/template', $this->_data);
            } else {
                $this->_data['main'] = 'user_create';
                $this->_render_page('admin/template', $this->_data);
            }
        }
    }

    //remove a group
    function remove_group($id) {
        if (!$this->ion_auth->is_admin())
            redirect('auth', 'refresh');
        // echo $this->ion_auth->user()->row()->id;
        if ($this->ion_auth->delete_group($id)) {
            redirect('admin/groups_manager', 'refresh');
        } else
            echo "false";
    }

    //remove a user
    function remove_user($id) {
        if (!$this->ion_auth->in_group(array('SMOD', 'admin')) || $this->ion_auth->in_group(array('MOD','SMOD', 'admin'), $id))
            redirect('auth', 'refresh');
        // echo $this->ion_auth->user()->row()->id;
        if ($this->ion_auth->delete_user($id)) {
            redirect('admin/users_manager', 'refresh');
        } else
            echo "false";
    }

    //edit a user
    function edit_user($id) {
        $this->_data['title'] = "Edit User";
        if (!$this->ion_auth->logged_in() || (!($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('address', $this->lang->line('edit_user_validation_address_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            //update the password if it was posted
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'address' => $this->input->post('address'),
                    'phone' => $this->input->post('phone'),
                );


                if ($_FILES['img']['name'] != "") {
                    $data['img_user'] = $this->do_upload($id, 'img');
                }

                /*
                  // Only allow updating groups if user is admin
                  if ($this->ion_auth->is_admin()) {
                  //Update the groups user belongs to
                  $groupData = $this->input->post('groups');

                  if (isset($groupData) && !empty($groupData)) {

                  $this->ion_auth->remove_from_group('', $id);

                  foreach ($groupData as $grp) {
                  $this->ion_auth->add_to_group($grp, $id);
                  }
                  }
                  }
                 */
                //check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('/', 'refresh');
                } else {
                    //redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
            }
        }

        //display the edit user form
        $this->_data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->_data['id'] = $id;
        $this->_data['user'] = $user;

        $this->_data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->_data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->_data['address'] = array(
            'name' => 'address',
            'id' => 'address',
            'type' => 'text',
            'value' => $this->form_validation->set_value('address', $user->address),
        );
        $this->_data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->_data['main'] = 'user/edit_user';
        $this->_render_page('user/template', $this->_data);
    }

    // create a new group
    function create_group() {
        $this->_data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("admin", 'refresh');
            }
        } else {
            //display the create group form
            //set the flash data error message if there is one
            $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->_data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->_data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );
            $this->_data['main'] = "create_group";
            $this->_render_page('admin/template', $this->_data);
        }
    }

    //edit a group
    function edit_group($id) {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        $this->_data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("admin/groups_manager", 'refresh');
            }
        }

        //set the flash data error message if there is one
        $this->_data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->_data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->_data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->_data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );
        $this->_data['main'] = 'edit_group';
        $this->_render_page('admin/template', $this->_data);
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->_data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

    public function edit_unique($value) {
        $this->form_validation->set_message('edit_unique', '%s ?� t?n t?i');

        $query = $this->db->select('email')->from('users')
                        ->where('email', $value)->where('deleted', 0)->limit(1)->get();

        if ($query->row()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function username_unique($value) {
        $this->form_validation->set_message('username_unique', '%s ?� t?n t?i');

        $query = $this->db->select('username')->from('users')
                        ->where('username', $value)->where('deleted', 0)->limit(1)->get();

        if ($query->row()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function username_check() {
        $response = array(
            'valid' => false,
            'message' => 'Nhập lại tên đăng nhập'
        );

        if (isset($_POST['username'])) {
            $user = $_POST['username'];
            $query = $this->db->select('username')->from('users')
                            ->where('username', $user)->where('deleted', 0)->limit(1)->get();
            if ($query->row()) {
                // User name is registered on another account

                $response = array('valid' => false, "message" => 'Tài khoản đã tồn tại');
            } elseif (strlen($user) < 6) {
                // User name is available
                $response = array('valid' => false, 'message' => 'Tài khoản phải có ít nhất 6 kí tự');
            } else {
                $response = array('valid' => true);
            }
        }
        echo json_encode($response);
    }

    public function email_check() {
        $response = array(
            'valid' => false,
            'message' => 'Nhập Email'
        );
        $this->load->helper('email');
        if (isset($_POST['email'])) {
            $user = $_POST['email'];
            $query = $this->db->select('email')->from('users')
                            ->where('email', $user)->where('deleted', 0)->limit(1)->get();
            if ($query->row()) {
                // User name is registered on another account
                $response = array('valid' => false, 'message' => 'Email đã tồn tại');
            } elseif (valid_email($user)) {
                // User name is available
                $response = array('valid' => true);
            } else {
                $response = array('valid' => FALSE, 'message' => 'Định dạng email không đúng(email@email.com)');
            }
        }
        echo json_encode($response);
    }

    public function pass_check($id) {
        $response = array(
            'valid' => true
        );
        if (isset($_POST['passwordold'])) {
            $pass = $_POST['passwordold'];
            $pass = $this->ion_auth->hash_password_db($id, $pass);

            if (!$pass) {
                // User name is registered on another account
                $response = array('valid' => false, 'message' => 'Mật khẩu cũ không đúng');
            } else {
                $response = array('valid' => true);
            }
        }
        if (isset($_POST['password'])) {
            $pass = $_POST['password'];
            if (strlen($pass) > 6 || $pass == '') {
                // User name is registered on another account
                $response = array('valid' => true);
            } else {
                $response = array('valid' => false, 'message' => 'Mật khẩu phải có 6 kí tự');
            }
        }
        echo json_encode($response);
    }

    public function do_upload($filename, $field_name) {

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
                "width" => '129',
                "height" => '129',);
            $this->load->library("image_lib", $config);
            $this->image_lib->resize();
            return $data['file_name'];
        } else {
            $error = array('error' => $this->upload->display_errors());
            return FALSE;
        }
    }

    private function dashboard() {
        $this->load->model('user/trackuser_model');
        $this->_data['online'] = $this->trackuser_model->online();
        $this->_data['allvideos'] = $this->trackuser_model->allvideos();
        $this->_data['allviews'] = $this->trackuser_model->allviews();
    }

}
