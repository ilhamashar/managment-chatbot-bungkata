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
    
    // public function getData()
    // {
    //     $hasil=$this->db->get_where('challenge', array('id' => $id));
    //     return $hasil->result();
    // }

    public function get_challenge($id = null)
    {
    	// $this->db->from('challenge');
    	// if($id != null){
    	// 	$this->db->where('id', $id);
    	// }
    	// $query = $this->db->get();
    	// return $query;
        $query = $this->db->get('challenge');
        if($query->result()) return $query->result();
        return NULL;
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