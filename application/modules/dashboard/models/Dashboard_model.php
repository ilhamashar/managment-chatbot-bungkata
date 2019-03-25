<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/2/2018
 * Time: 3:45 PM
 */

class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_user($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => $user_id));
        if($query->num_rows()) return $query->row();
        return NULL;
    }
}