<?php
/**
 * Authit Authentication Library
 *
 * @package Authentication
 * @category Libraries
 * @author Ron Bailey
 * @version 1.0
 */

class Authit_model extends CI_Model {

	public $users_table;
	public $groups_table;
    public $challenges_table;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->config->load('auth/authit');

        $this->groups_table = $this->config->item('authit_groups_table');
        $this->users_table = $this->config->item('authit_users_table');
        $this->challenges_table = $this->config->item('authit_challenge_table');

        if(!$this->db->table_exists($this->groups_table)) $this->create_auth_group_table();
        if(!$this->db->table_exists($this->users_table)) $this->create_auth_user_table();
        //if(!$this->db->table_exists($this->challenges_table)) $this->create_auth_challenge_table();
	}

    public function get_challenge_by_chellengeid($id)
    {
        $query = $this->db->get_where($this->users_table, array('id' => $id));
        if($query->num_rows()) return $query->row();
        return false;
    }

    public function get_challenges($order_by = 'id', $order = 'asc', $limit = 0, $offset = 0)
    {
        $this->db->order_by($order_by, $order); 
        if($limit) $this->db->limit($limit, $offset);
        $query = $this->db->get($this->challenges_table);
        return $query->result();
    }
	
	public function get_user($id)
	{
		$query = $this->db->get_where($this->users_table, array('id' => $id));
		if($query->num_rows()) return $query->row();
		return false;
	}

	public function get_user_by_userid($user_id)
    {
        $query = $this->db->get_where($this->users_table, array('user_id' => $user_id));
        if($query->num_rows()) return $query->row();
        return false;
    }

    public function get_user_by_cookie($cookie)
    {
        $this->db->select('au.id, au.email, au.password, au.user_id, ag.name role, au.created, au.last_login');
        $this->db->join($this->groups_table . ' ag', 'au.role = ag.id', 'left');
        $query = $this->db->get_where($this->users_table . ' au', array('cookie' => $cookie));
        if($query->num_rows()) return $query->row();
        return false;
    }

	public function get_user_by_email($email)
	{
//		$query = $his->db->get_where($this->users_table, array('email' => $email));
        // start my code
        $this->db->select('au.id, au.email, au.password, au.user_id, ag.name role, au.created, au.last_login');
        $this->db->join($this->groups_table . ' ag', 'au.role = ag.id', 'left');
        $query = $this->db->get_where($this->users_table . ' au', array('email' => $email));
        // end my code
		if($query->num_rows()) return $query->row();
		return false;
	}

	public function get_users($order_by = 'id', $order = 'asc', $limit = 0, $offset = 0)
	{
		$this->db->order_by($order_by, $order); 
		if($limit) $this->db->limit($limit, $offset);
		$query = $this->db->get($this->users_table);
		return $query->result();
	}

	public function get_user_count()
	{
		return $this->db->count_all($this->users_table);
	}
	
	public function create_user($email, $password, $group = NULL)
	{
        $query = $this->db->get_where($this->groups_table, array('name' => $this->config->item('authit_default_group')), 1)->row();
        if (!isset($query->id) && empty($group))
        {
            $this->set_error('account_creation_invalid_default_group');
            return FALSE;
        }

		$data = array(
			'email'     => filter_var($email, FILTER_SANITIZE_EMAIL),
			'password'  => password_hash($password, PASSWORD_DEFAULT), // Should be hashed
            'role'      => ($group ?: $query->id),
			'created'   => date('Y-m-d H:i:s')
		);
		$this->db->insert($this->users_table, $data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function update_user($user_id, $data)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->users_table, $data); 
	}
	
	public function delete_user($user_id)
	{
		$this->db->delete($this->users_table, array('id' => $user_id));
	}

    public function create_challenge($id, $data){
        $query = $this->db->get_where($this->challenges_table, array('challenge_name' => $challenge_name), 1)->row();
        if (isset($query->id))
        {
            return FALSE;
        }
        $data = array(
            'challenge_name' => $challenge_name,
            'challenge_type' => $challenge_type,
            'challenge_image'=> $challenge_image,
            'description'    => $description,
            'reward_xp'      => $reward_xp,
            'reward_point'   => $reward_point,
            'reward_badge'   => $reward_badge,
            
        );
        $this->db->insert($this->challenges_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function create_group($name, $description)
    {
        $query = $this->db->get_where($this->groups_table, array('name' => $name), 1)->row();
        if (isset($query->id))
        {
            return FALSE;
        }
        $data = array(
            'name'          => $name,
            'description'   => $description
        );
        $this->db->insert($this->groups_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function update_group($id, $data)
    {
        $query = $this->db->get_where($this->groups_table, array('name' => $data->name), 1)->row();
        if (isset($query->id))
        {
            return FALSE;
        }

        $this->db->where('id', $id);
        $this->db->update($this->groups_table, $data);
        return TRUE;
    }

    public function delete_group($id)
    {
        $group  = $this->get_group($id);
        $admin = $this->config->item('authit_admin_group');
        $default = $this->config->item('authit_default_group');
        if ($group){
            if ($group->name == $admin || $group->name == $default) return FALSE;
        }
        if ($this->db->delete($this->groups_table, array('id' => $id))) return TRUE;
        return FALSE;
    }

    public function get_group($id)
    {
        $query = $this->db->get_where($this->groups_table, array('id' => $id));
        if($query->num_rows()) return $query->row();
        return false;
    }

    public function get_groups(){
        return $this->db->get($this->groups_table)->result();
    }

    private function create_auth_group_table()
    {
//        $this->load->dbforge();
//        $this->dbforge->add_field('id');
//        $this->dbforge->add_field('name VARCHAR(20) NOT NULL');
//        $this->dbforge->add_field('description VARCHAR(100) NOT NULL');
//        $this->dbforge->create_table('auth_group');
        $sql = "CREATE TABLE ".$this->groups_table."(
        id int PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(20) NOT NULL,
        description VARCHAR(200) NOT NULL) 
        CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = INNODB;";
        $this->db->query($sql);

        // insert groups
        $data = array(
            array(
                'name'          => $this->config->item('authit_admin_group'),
                'description'   => $this->config->item('authit_admin_group')
            ),
            array(
                'name'          => $this->config->item('authit_default_group'),
                'description'   => $this->config->item('authit_default_group')
            )
        );

        $this->db->insert_batch($this->groups_table, $data);
    }
	
	private function create_auth_user_table()
	{
//		$this->load->dbforge();
//		$this->dbforge->add_field('id INT PRIMARY KEY AUTO_INCREMENT');
//		$this->dbforge->add_field('email VARCHAR(200) NOT NULL');
//		$this->dbforge->add_field('password VARCHAR(200) NOT NULL');
//		$this->dbforge->add_field('user_id VARCHAR(50) NULL');
//		$this->dbforge->add_field('role INT NULL');
//		$this->dbforge->add_field('cookie VARCHAR(100) NULL');
//		$this->dbforge->add_field('created DATETIME NOT NULL');
//		$this->dbforge->add_field('last_login DATETIME NULL');
//		$this->dbforge->add_field('CONSTRAINT auth_user_auth_group_id_fk FOREIGN KEY (role) REFERENCES auth_group (id) ON UPDATE CASCADE ON DELETE RESTRICT');
//		$this->dbforge->create_table($this->users_table);
        $sql = "CREATE TABLE ".$this->users_table."(
        id int PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(200) NOT NULL,
        password varchar(200) NOT NULL,
        user_id varchar(50),
        role int,
        cookie varchar(100),
        created datetime NOT NULL,
        last_login datetime,
        CONSTRAINT auth_user_auth_group_id_fk FOREIGN KEY (role) REFERENCES ".$this->groups_table."(id) ON UPDATE CASCADE) 
        CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = INNODB;";
        $this->db->query($sql);

		// insert default user
        $now = new DateTime();
        $data = array(
            'email'     => 'admin@admin.com',
            'password'  => password_hash('password', PASSWORD_DEFAULT),
            'role'      => 1,
            'created'   => $now->format('Y-m-d H:i:s')
        );
        $this->db->insert($this->users_table, $data);
	}

    // private function create_auth_challenge_table(){
    //     $sql= "CREATE TABLE ".$this->challenges_table."(   
    //     id int PRIMARY KEY AUTO_INCREMENT,
    //     challenge_name VARCHAR(30) NOT NULL,
    //     challenge_type INT(11) NOT NULL,
    //     challenge_image VARCHAR(200),
    //     description VARCHAR(300),
    //     reward_xp INT(11),
    //     reward_point INT(11),
    //     reward_badge VARCHAR(200),
    //     is_active TINYINT(1),
    //     started_at DATETIME,
    //     expired_ad DATETIME)
    //     CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = INNODB;";
    //     $this->db->query($sql);
    // }

}

/* End of file: Authit_model.php */
/* Location: application/models/Authit_model.php */
