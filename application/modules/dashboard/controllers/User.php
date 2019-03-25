<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/3/2018
 * Time: 9:50 PM
 */

class User extends CI_Controller
{
    var $table = 'user'; //nama tabel dari database
    var $column_order = array(NULL,NULL,'display_name',NULL,'user_type','available','created_at'); //field yang ada di table user
    var $column_search = array('user_id','display_name','display_name_default','status_message'); //field yang diizin untuk pencarian
    var $order = array('created_at' => 'desc'); // default order

    function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('user_model');
        // load helper
        $this->load->helper(array('auth/authit','url','nav','dynamicjscss'));
        check_login();
        if(!is_admin()) redirect('dashboard');
    }

    function index(){
        $data['page']       = 'admin/content_user';
        $data['page_title'] = 'Users';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        $this->load->view('base', $data);
    }
    
    function detail($user_id = NULL){
        if (!isset($user_id)){
            redirect('dashboard/user');
        }

        $data['page']       = 'admin/content_user_detail';
        $data['page_title'] = 'Detail User';
        $data['t_user'] = $this->user_model->get_user($user_id);
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        if ($data['t_user'] == null){
            echo 'Not found';
            die();
        }
        $this->load->view('base', $data);
    }

    function edit($user_id = NULL){
        if (!isset($user_id)){
            redirect('dashboard/user');
        }
        $data['page']       = 'admin/content_user_edit';
        $data['page_title'] = 'Edit User';
        $data['t_user'] = $this->user_model->get_user($user_id);
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        if ($data['t_user'] == null){
            echo 'Not found';
            die();
        }
        $this->load->view('base', $data);
    }

    function update($user_id)
    {
        if (isset($_POST) && !empty($_POST))
        {
            $data = array();
            foreach ($_POST as $key=>$value){
                if ($value != ''){
                    if ($key == 'birth_date'){
                        $value = date('Y-m-d', strtotime($this->input->post('birth_date')));
                    }
                    if ($key == 'premium'){
                        $value = date('Y-m-d H:i', strtotime($this->input->post('premium')));
                    }
                    $data[$key] = $value;
                }
            }
            if ($data){
                $this->user_model->update($user_id, $data);
                redirect(base_url('dashboard/user/detail/'.$user_id));
            }
            redirect(base_url('dashboard/user/edit/'.$user_id));
        }
    }


    function delete($user_id)
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->user_model->delete($user_id);
            redirect(base_url('dashboard/user'));
        } else {
            redirect(base_url('dashboard/user/detail/').$user_id);
        }
    }

    function auth_group(){
        $data['page']       = 'admin/content_auth_group';
        $data['page_title'] = 'Auth Groups';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);

        $groups             = $this->authit_model->get_groups();
        $data['groups']      = array();
        foreach ($groups as $key=>$value){
            $data['groups'][$key]  = $value;
        }

        $this->load->view('base', $data);
    }

    function auth_group_add(){
        $this->load->library('form_validation');
        // validate
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if($this->form_validation->run()){
            if ($this->authit_model->create_group(set_value('name'), set_value('description'))){
                $this->session->set_flashdata(array(
                    'class'     => 'alert alert-success',
                    'message'   => 'Group creation success'
                ));
                redirect('dashboard/user/auth_group', 'refresh');
            } else {
                $this->session->set_flashdata(array(
                    'class'     => 'alert alert-danger',
                    'message'   => 'Group creation failed. Group name exists'
                ));
            }
        }

        $data['page']       = 'admin/content_auth_group_add';
        $data['page_title'] = 'Add Group';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        $groups             = $this->authit_model->get_groups();
        $data['roles']      = array();
        foreach ($groups as $key=>$value){
            $data['roles'][$key]  = $value;
        }
        $this->load->view('base', $data);
    }

    function auth_group_delete($id=NULL)
    {
        if (!isset($id)){
            redirect('dashboard/user/auth_group');
        }

        $this->load->model('auth/authit_model');
        if ($this->authit_model->delete_group($id))
        {
            $this->session->set_flashdata(array(
                'class'     => 'alert alert-success',
                'message'   => 'Group deleted'
            ));
        } else {
            $this->session->set_flashdata(array(
                'class'     => 'alert alert-danger',
                'message'   => 'Group deletion failed'
            ));
        }
        redirect(base_url('dashboard/user/auth_group'));
    }

    function auth_group_edit($id = NULL){
        if (!isset($id)){
            redirect('dashboard/user/auth_group');
        }
        if (isset($_POST) && !empty($_POST))
        {
            $data = array();
            foreach ($_POST as $key=>$value){
                if ($value != ''){
                    $data[$key] = $value;
                }
            }
            if ($data){
                if ($this->authit_model->update_group($id, $data)){
                    $this->session->set_flashdata(array(
                        'class'     => 'alert alert-success',
                        'message'   => 'Group edited'
                    ));
                } else {
                    $this->session->set_flashdata(array(
                        'class'     => 'alert alert-danger',
                        'message'   => 'Group creation failed. Group name exists'
                    ));
                }
            }
            redirect(base_url('dashboard/user/auth_group_edit/'.$id));
        }

        $data['page']       = 'admin/content_auth_group_edit';
        $data['page_title'] = 'Edit Group';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        $data['group']      = $this->authit_model->get_group($id);
        if ($data['group'] == null){
            echo 'Not found';
            die();
        }
        $this->load->view('base', $data);
    }

    function auth(){
        $data['page']       = 'admin/content_auth_user';
        $data['page_title'] = 'Auth Users';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        $this->load->view('base', $data);
    }

    function auth_add(){
        $this->load->library('form_validation');
        // validate
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');

        if($this->form_validation->run()){
            if ($this->authit_model->create_user(set_value('email'), set_value('password'), set_value('role'))){
                $this->session->set_flashdata(array(
                    'class'     => 'alert alert-success',
                    'message'   => 'User creation success'
                ));
                redirect('dashboard/user/auth_add', 'refresh');
            } else {
                $this->session->set_flashdata(array(
                    'class'     => 'alert alert-danger',
                    'message'   => 'User creation failed'
                ));
            }
        }

        $data['page']       = 'admin/content_auth_user_add';
        $data['page_title'] = 'Add Auth User';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);
        $groups             = $this->authit_model->get_groups();
        $data['roles']      = array();
        foreach ($groups as $key=>$value){
            $data['roles'][$key]  = $value;
        }
        $this->load->view('base', $data);
    }

    function auth_edit($id = NULL){
        if (isset($_POST) && !empty($_POST))
        {
            $id = $this->input->post('id');
            $data = array();
            foreach ($_POST as $key=>$value){
                if ($value != ''){
                    if ($key == 'password'){
                        $value = password_hash($value, PASSWORD_DEFAULT);
                    }
                    $data[$key] = $value;
                }
            }
            if ($data){
                $this->authit_model->update_user($id, $data);
                $flashmsg = array(
                    'class'     => 'alert alert-success',
                    'message'   => 'Profile updated.'
                );
                $this->session->set_flashdata($flashmsg);
            }
            redirect(base_url('dashboard/user/auth_edit/'.$id));
        }

        $this->load->model('auth/authit_model');
        if (!isset($id)){
            redirect('dashboard/user/auth');
        }
        $data['page']       = 'admin/content_auth_user_edit';
        $data['page_title'] = 'Edit Auth User';
        $data['t_user'] = $this->authit_model->get_user($id);
        $data['auth_user']  = auth_user();
        $data['user']       = $this->user_model->get_user(auth_user()->user_id);

        $groups             = $this->authit_model->get_groups();
        $data['roles']      = array();
        foreach ($groups as $key=>$value){
            $data['roles'][$key]  = $value;
        }

        if ($data['t_user'] == null){
            echo 'Not found';
            die();
        }
        $this->load->view('base', $data);
    }

    function get_users(){
        if ($this->input->method(TRUE) != 'POST'){
            redirect('dashboard');
        }
        /*Menangkap semua data yang dikirimkan oleh client*/

        /*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
        server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
        sesuai dengan urutan yang sebenarnya */
        $draw=$_POST['draw'];

        /*Jumlah baris yang akan ditampilkan pada setiap page*/
        $length=$_POST['length'];

        /*Offset yang akan digunakan untuk memberitahu database
        dari baris mana data yang harus ditampilkan untuk masing masing page
        */
        $start=$_POST['start'];

        /*Keyword yang diketikan oleh user pada field pencarian*/
        $search=$_POST['search']["value"];

        /*Menghitung total desa didalam database*/
        $total=$this->db->count_all_results($this->table);

        /*Mempersiapkan array tempat kita akan menampung semua data
        yang nantinya akan server kirimkan ke client*/
        $output=array();

        /*Token yang dikrimkan client, akan dikirim balik ke client*/
        $output['draw']=$draw;

        /*
        $output['recordsTotal'] adalah total data sebelum difilter
        $output['recordsFiltered'] adalah total data ketika difilter
        Biasanya kedua duanya bernilai sama, maka kita assignment
        keduaduanya dengan nilai dari $total
        */
        $output['recordsTotal']=$output['recordsFiltered']=$total;

        /*disini nantinya akan memuat data yang akan kita tampilkan
        pada table client*/
        $output['data']=array();


        /*Jika $search mengandung nilai, berarti user sedang telah
        memasukan keyword didalam filed pencarian*/
        $i  = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if($search) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if($i===0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else
                {
                    $this->db->or_like($item, $search);
                }

                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }


        /*Lanjutkan pencarian ke database*/
        $this->db->limit($length,$start);

        /*Urutkan*/
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        $query=$this->db->get($this->table);

        /*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai
        dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
        yang mengandung keyword tertentu
        */
        $i  = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if($search) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if($i===0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else
                {
                    $this->db->or_like($item, $search);
                }

                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if($search){
            $jum = $this->db->count_all_results($this->table);
            $output['recordsTotal']=$output['recordsFiltered']=$jum;
        }

        $nomor_urut=$start+1;
        foreach ($query->result_array() as $user) {
            $output['data'][]=array(
                $nomor_urut,
                "<img src='".htmlspecialchars($user['picture_url'])."' height='48' width='48' onerror=\"this.src='".base_url('assets/templates/backend/')."images/avatar.jpg'\"/>",
                $user['display_name'],
                $user['status_message'],
                $user['user_type'],
                $user['available'],
                $user['created_at'],
                "<button type='button' class='btn btn-xs' onclick=\"window.open('".base_url('dashboard/user/detail/'.$user['user_id'])."')\">Detail</button>"
            );
            $nomor_urut++;
        }

        echo json_encode($output);
    }

    function get_auth_users(){
        $this->load->config('auth/authit');
        $table = $this->config->item('authit_users_table');
        $column_order = array(NULL,'email','role',NULL,'last_login','created');
        $column_search = array('email');
        $order = array('created' => 'desc'); // default order
        if ($this->input->method(TRUE) != 'POST'){
            redirect('dashboard');
        }
        $draw=$_POST['draw'];
        $length=$_POST['length'];
        $start=$_POST['start'];
        $search=$_POST['search']['value'];
        $total=$this->db->count_all_results($table);
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $i  = 0;
        $this->db->select($table.'.*, ag.name role_name, u.display_name');
        $this->db->join($this->config->item('authit_groups_table') . ' ag', $table.'.role = ag.id', 'left');
        $this->db->join('user u', $table.'.user_id = u.user_id', 'left');
        foreach ($column_search as $item)
        {
            if($search)
            {
                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else
                {
                    $this->db->or_like($item, $search);
                }

                if(count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        $this->db->limit($length,$start);
        if(isset($_POST['order']))
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($order))
        {
            $this->db->order_by(key($order), $order[key($order)]);
        }
        $query=$this->db->get($table);
        $i  = 0;
        foreach ($column_search as $item)
        {
            if($search)
            {
                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else
                {
                    $this->db->or_like($item, $search);
                }
                if(count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if($search){
            $jum = $this->db->count_all_results($table);
            $output['recordsTotal']=$output['recordsFiltered']=$jum;
        }
        $nomor_urut=$start+1;
        foreach ($query->result_array() as $user) {
            $output['data'][]=array(
                $nomor_urut,
                $user['email'],
                $user['role_name'],
                "<a href='".base_url('dashboard/user/detail/').$user['user_id']."'>".$user['display_name']."</a>",
                $user['last_login'],
                $user['created'],
                "<button type='button' class='btn btn-xs' onclick=\"window.open('".base_url('dashboard/user/auth_edit/'.$user['id'])."', '_self')\">Edit</button>"
            );
            $nomor_urut++;
        }
        echo json_encode($output);
    }
}