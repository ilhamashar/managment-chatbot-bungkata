<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 8/31/2018
 * Time: 5:38 PM
 */

class Challenge extends CI_Controller
{
	var $table = 'challenge'; //nama tabel dari database
    var $column_order = array(NULL,'challenge_name','challenge_type','challenge_image','description','reward_xp','reward_point','reward_badge','is_active','started_at','expired_at','challenge_data'); //field yang ada di table user
    var $column_search = array('id','challenge_name'); //field yang diizin untuk pencarian
    var $order = array('expired_at' => 'desc'); // default order
    
    function __construct()
    {
    	parent::__construct();
    	$this->load->model('challenge_model');
    	$this->load->library('session');
    	$this->load->helper(array('auth/authit','url','nav','dynamicjscss'));
        check_login();
    }
    
    function index(){
    	$data['page']       = 'content_challenge';
        $data['page_title'] = 'Challenge';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->challenge_model->get_challenge(auth_user()->user_id);
        $challenges              = $this->authit_model->get_challenges();
        var_dump(challenges);
    //     $this->load->view('base', $data);
    }

    // public function get_challenge(){
    //     $data = $this->challenge_model->getData();
    //     echo json_encode($data);
    //     // $this->load->model('challenge_model');
    //     // $data['row'] = $this->challenge_model->get();

    //     $this->load->view('content_challenge', $data);
    // } 

    function challenge(){
        $data['page']       = 'challenge_model';
        $data['page_title'] = 'Challenge';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->challenge_model->get_challenge(auth_user()->id);


        // $data['challenges']      = array();
        // foreach ($challenges as $key=>$value){
        //     $data['challenges'][$key]  = $value;
        // }

        // $this->load->view('content_challenge', $data);
    }


    function update($id)
    {
        if (isset($_POST) && !empty($_POST))
        {
            $data = array();
            foreach ($_POST as $key=>$value){
                if ($value != ''){
                    if ($key == 'challenge_type'){
                        $value = $this->input->post('challenge_type');
                    }
                    $data[$key] = $value;
                }
            }
            if ($data){
                $this->user_model->update($user_id, $data);
                redirect(base_url('dashboard/challenge/detail/'.$id));
            }
            redirect(base_url('dashboard/challenge/edit/'.$id));
        }
    }


    function delete($id)
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->user_model->delete($user_id);
            redirect(base_url('dashboard/challenge'));
        } else {
            redirect(base_url('dashboard/challenge/detail/').$id);
        }
    }

    // function challenge_add(){
    //     $this->load->library('form_validation');
    //     // validate
    //     $this->form_validation->set_rules('challenge_name', 'challenge_name', 'required');
    //     $this->form_validation->set_rules('challenge_type', 'challenge_type', 'required');
    //     $this->form_validation->set_rules('challenge_image', 'challenge_image', 'required');
    //     $this->form_validation->set_rules('description', 'description', 'required');
    //     $this->form_validation->set_rules('reward_xp', 'reward_xp', 'required');
    //     $this->form_validation->set_rules('reward_point', 'reward_point', 'required');
    //     $this->form_validation->set_rules('reward_badge', 'reward_badge', 'required');
    //     $this->form_validation->set_rules('is_active', 'is_active', 'required');
    //     $this->form_validation->set_rules('started_at', 'started_at', 'required');
    //     $this->form_validation->set_rules('expired_at', 'expired_at', 'required');

    //      if($this->form_validation->run()){
    //         if ($this->authit_model->create_challenge(set_value('challenge_name'), set_value('challenge_type'), set_value('challenge_image'), set_value('description'), set_value('reward_xp'), set_value('reward_point'), set_value('reward_badge'), set_value('is_active'), set_value('started_at'), set_value('expired_at'))){
    //             $this->session->set_flashdata(array(
    //                 'class'     => 'alert alert-success',
    //                 'message'   => 'Group creation success'
    //             ));
    //             redirect('dashboard/challenge', 'refresh');
    //         } else {
    //             $this->session->set_flashdata(array(
    //                 'class'     => 'alert alert-danger',
    //                 'message'   => 'Group creation failed. Group name exists'
    //             ));
    //         }
    //     }

    //     $data['page']       = 'content_challenge_add';
    //     $data['page_title'] = 'Add Challenge';
    //     $data['auth_user']  = auth_user();
    //     $data['user']       = $this->user_model->get_user(auth_user()->user_id);
    //     $challenges         = $this->authit_model->get_challenges();
    //     $data['roles']      = array();
    //     foreach ($challenges as $key=>$value){
    //         $data['roles'][$key]  = $value;
    //     }
    //     $this->load->view('base', $data);
    // }
}