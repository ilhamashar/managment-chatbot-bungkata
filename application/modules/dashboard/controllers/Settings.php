<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/27/2018
 * Time: 8:55 PM
 * @property  Home_model
 */

class Settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model(array('home_model', 'settings_model'));
        // load library
        $this->load->library('session');
        // load helper
        $this->load->helper(array('url','auth/authit','nav', 'dynamicjscss'));
        check_login();
        if(!is_admin()) redirect('dashboard');
    }

    function index(){
        $data['page']       = 'admin/content_settings';
        $data['page_title'] = 'Settings';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->home_model->get_user(auth_user()->user_id);

        $data['settings']   = $this->settings_model->get_settings();

        $this->load->view('base', $data);
    }

    function update(){
        if (isset($_POST) && !empty($_POST))
        {
            var_dump($_POST);
        }
    }
}