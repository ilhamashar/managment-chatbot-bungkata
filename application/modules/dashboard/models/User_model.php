<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/3/2018
 * Time: 10:17 PM
 */

class User_model extends CI_Model
{
    var $table = 'user'; //nama tabel dari database

    public function __construct(){
        parent::__construct(); //inherit dari parent
    }

    public function get_user($user_id)
    {
        $query = $this->db->get_where($this->table, array('user_id' => $user_id));
        if($query->num_rows()) return $query->row();
        return NULL;
    }

//    function getUser($user_id = NULL){
//        $this->db->select('*');
//        $q = $this->db->get_where($this->table, array('user_id =' => $user_id));
//        $response = $q->row();
//        return $response;
//    }

    function update($user_id, $data){
        $res = $this->db->update($this->table, $data, array('user_id =' => $user_id)); // Kode ini digunakan untuk merubah record yang sudah ada dalam sebuah tabel
        return $res;
    }

    function delete($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->table);
    }
}