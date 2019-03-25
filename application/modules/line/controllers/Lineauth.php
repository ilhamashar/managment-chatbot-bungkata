<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/11/2018
 * Time: 3:53 PM
 */


class Lineauth extends CI_Controller
{
    public $callback;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('lineauthlib');
        $this->load->config('line/lineauth');

        $this->callback = base_url('line/lineauth/callback');
    }

    function index()
    {
        $url = $this->lineauthlib->get_url();
        echo $url;
    }

    function callback()
    {
        if (isset($_GET['code'])) {
            $res = $this->lineauthlib->get_result($_GET['code']);
            var_dump($res);
        }
        redirect('dashboard/profile');
    }
}