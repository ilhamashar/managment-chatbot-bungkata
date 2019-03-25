<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( !function_exists('check_login'))
{
    function check_login()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->load->helper('cookie');
        $CI->load->model('auth/authit_model');
        $CI->load->config('authit');
        $logged_id = $CI->session->userdata('logged_in');
        $cookie = get_cookie($CI->config->item('remember_cookie_name'));
        if (isset($logged_id)) {
            return TRUE;
        } else if ($cookie <> '') {
            // cek cookie
            $res = $CI->authit_model->get_user_by_cookie($cookie);
            if ($res){
                // daftarkan session
                $CI->session->set_userdata(array(
                    'logged_in' => true,
                    'user' => $res
                ));
                return TRUE;
            } else {
                redirect('auth/login');
            }
        } else {
            redirect('auth/login');
        }

    }
}

if (!function_exists('logged_in'))
{
    function logged_in()
    {
        $CI =& get_instance();
        $CI->load->library('authit');
        return $CI->authit->logged_in();
    }
}

if ( !function_exists('is_admin'))
{
    function is_admin()
    {
        $CI = &get_instance();
        $CI->config->load('auth/authit');
        $CI->load->library('session');
        $user = $CI->session->userdata('user');
        if($user->role == $CI->config->item('authit_admin_group')) return TRUE;
        return FALSE;
    }
}

if ( !function_exists('auth_user'))
{
    function auth_user($key = '')
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $user = $CI->session->userdata('user');
        if($key && isset($user->$key)) return $user->$key;
        return $user;
    }
}