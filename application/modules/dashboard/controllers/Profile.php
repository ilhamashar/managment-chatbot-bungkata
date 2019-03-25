<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 8/31/2018
 * Time: 5:38 PM
 */

class Profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model(array('user_model', 'profile_model', 'auth/authit_model'));
        // load library
        $this->load->library('session');
        // load helper
        $this->load->helper(array('url','auth/authit','nav', 'dynamicjscss', 'file'));
        check_login();
    }

    function index(){
        $data['page']       = 'content_profile';
        $data['page_title'] = 'Profile';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        $this->load->view('dashboard/base', $data);
    }

    function update()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $user_id = $_POST['user_id'];
            $data = array();
            foreach ($_POST as $key=>$value){
                if ($value != ''){
                    if ($key == 'user_id' || $key == 'image'){
                        continue;
                    }
                    if ($key == 'birth_date'){
                        $value = date('Y-m-d', strtotime($this->input->post('birth_date')));
                    }
                    $data[$key] = $value;
                }
            }

            if ($_FILES['userfile']['name']) {
                $filename = md5(uniqid(rand(), true));
                $upload_path = 'uploads/'.$user_id;
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $config = array(
                    'upload_path' => $upload_path,
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'file_name' => $filename
                );

                $this->load->library('upload', $config);

                if($this->upload->do_upload())
                {
                    $file_data = $this->upload->data();

                    $data['picture_url'] =  base_url($upload_path).'/'.$file_data['file_name'];

                    $this->session->set_flashdata(array(
                        'class'     => 'alert alert-success',
                        'message'   => 'Image uploaded'
                    ));
                } else {
                    $this->session->set_flashdata(array(
                        'class'     => 'alert alert-danger',
                        'message'   => 'Upload failed'
                    ));
                }
            }

            if ($data){
                $this->profile_model->update($user_id, $data);
            }
            redirect(base_url('dashboard/profile'));
        }
    }

    function auth_update()
    {
        if (isset($_POST) && !empty($_POST) && !empty($_POST['password']))
        {
            $id = $_POST['authid'];
            $data = array();
            foreach ($_POST as $key=>$value){
                if ($value != ''){
                    if ($key == 'authid'){
                        continue;
                    }
                    if ($key == 'password'){
                        $data[$key] = password_hash($value, PASSWORD_DEFAULT);
                        continue;
                    }
                    $data[$key] = $value;
                }
            }
            $this->profile_model->authUpdate($id, $data);
            $this->session->set_flashdata(array(
                'class'     => 'alert alert-warning',
                'message'   => 'Password changed, re-login required.'
            ));
            redirect(base_url('auth/logout'));
        }
        redirect(base_url('dashboard/profile'));
    }

    function connect(){
        $callback = base_url('dashboard/profile/connect_success');
        $this->load->library('line/lineauthlib');
        $url = $this->lineauthlib->get_url($callback);
        if ($url)
        {
            redirect($url);
        }
        redirect('dashboard/profile');
    }

    function connect_success(){
        $callback = base_url('dashboard/profile/connect_success');
        $this->load->library('line/lineauthlib');
        if (isset($_GET['code'])) {
            $res = $this->lineauthlib->get_result($_GET['code'], $callback);
            $data = array(
                'user_id' => $res['userId']
            );
            $exist = $this->authit_model->get_user_by_userid($res['userId']);
            if ($exist) {
                $this->session->set_flashdata(array(
                    'class'     => 'alert alert-danger',
                    'message'   => 'Can\'t sync to account that linked to another account'
                ));
                redirect('dashboard/profile');
            }
            $this->authit_model->update_user(auth_user()->id, $data);
            $user = $this->authit_model->get_user_by_email(auth_user()->email);
            $this->session->set_userdata(array(
                'logged_in' => true,
                'user' => $user
            ));
            $this->session->set_flashdata(array(
                'class'     => 'alert alert-success',
                'message'   => 'Line account synced'
            ));
            redirect('dashboard/profile');
        }
    }
}