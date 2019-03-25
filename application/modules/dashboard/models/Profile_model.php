<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/3/2018
 * Time: 10:17 PM
 */

class Profile_model extends CI_Model
{
    public $auth_user_table;
    public $user_table = 'user';

    public function __construct(){
        parent::__construct(); //inherit dari parent
        $this->load->database();
        $this->config->load('auth/authit');
        $this->auth_user_table = $this->config->item('authit_users_table');
    }

    function update($user_id, $data){
        $res = $this->db->update($this->user_table, $data, array('user_id =' => $user_id));
        return $res;
    }

    public function authUpdate($user_id, $data)
    {
        $this->db->where('id', $user_id);
        $this->db->update($this->auth_user_table, $data);
    }
}