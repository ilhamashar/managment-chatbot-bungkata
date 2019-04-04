<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/2/2018
 * Time: 3:45 PM
 */

class Challenge_model extends CI_Model
{
	var $table = 'challenge';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user($id)
    {
        $query = $this->db->get_where($this->table, array('id' => $id));
        if($query->num_rows()) return $query->row();
        return NULL;
    }

    public function get_challenge($id = null)
    {
        $query = $this->db->get('challenge');
        return $query->result();
        // if($query->result()) return $query->result();
        // return NULL;
    }

    function update($id, $data){
        $res = $this->db->update($this->table, $data, array('id =' => $id)); // Kode ini digunakan untuk merubah record yang sudah ada dalam sebuah tabel
        return $res;
    }

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}