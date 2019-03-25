<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/27/2018
 * Time: 9:07 PM
 */

class Settings_model extends CI_Model
{
    var $bot_id = 'bot_account';
    var $table  = 'user';
    public function __construct(){
        parent::__construct(); //inherit dari parent
    }

    public function init_settings($settings=NULL){
        $this->db->select('pref_data');
        $query = $this->db->get_where($this->table, array('user_id' => $this->bot_id));
        if($query->num_rows()){
            $data = json_decode($query->row()->pref_data, true);
            if (!$settings){
                $settings = array(
                    'maintenance' => false
                );
            }
            $data['settings'] = $settings;
            $res = $this->db->update($this->table, array('pref_data' => json_encode($data)), array('user_id' => $this->bot_id));
            return $res;
        }
    }

    public function get_settings(){
        $this->db->select('pref_data');
        $query = $this->db->get_where($this->table, array('user_id' => $this->bot_id));
        if($query->num_rows()){
            $data = json_decode($query->row()->pref_data, true);
            if (isset($data['settings'])){
                return $data['settings'];
            } else {
                $this->init_settings();
                return NULL;
            }
        }
        return NULL;
    }

    public function update_settings($settings){
        return;
    }
}