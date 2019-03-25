<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Authit Authentication Library
 *
 * @package Authentication
 * @category Libraries
 * @author Ron Bailey
 * @version 1.0
 */

class Authit {

	private $CI;
	protected $PasswordHash;
	
	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->database();
		$this->CI->load->library('session');
		$this->CI->load->model('authit_model');
		$this->CI->load->helper( array('string', 'cookie'));
		$this->CI->config->load('authit');
	}
	
	public function logged_in()
	{
		return $this->CI->session->userdata('logged_in');
	}
	
	public function login($email, $password, $remember=FALSE)
	{
		$user = $this->CI->authit_model->get_user_by_email($email);
		if($user){
			if(password_verify($password, $user->password)){
				unset($user->password);
				$this->CI->session->set_userdata(array(
					'logged_in' => true,
					'user' => $user
				));
				$data = array(
				    'last_login' => date('Y-m-d H:i:s')
                );
				$this->CI->authit_model->update_user($user->id, array('last_login' => date('Y-m-d H:i:s')));
				if ($remember && $this->CI->config->item('authit_remember_users'))
                {
                    // if the user_expire is set to zero we'll set the expiration two years from now.
                    if($this->CI->config->item('authit_user_expire') === 0)
                    {
                        $expire = (60*60*24*365*2);
                    } else {
                        $expire = $this->CI->config->item('authit_user_expire');
                    }
                    $key = random_string('alnum', 64);
                    set_cookie(array(
                        'name'   => $this->CI->config->item('remember_cookie_name'),
                        'value'  => $key,
                        'expire' => $expire
                    ));
                    $data['cookie'] = $key;
                }
                $this->CI->authit_model->update_user($user->id, $data);
				return true;
			}
		}
		 
		return false;
	}
	
	public function logout($redirect = false)
	{
        // delete the remember me cookies if they exist
        if (get_cookie($this->CI->config->item('remember_cookie_name')))
        {
            delete_cookie($this->CI->config->item('remember_cookie_name'));
        }
		$this->CI->session->sess_destroy();
		if($redirect){
			$this->CI->load->helper('url');
			redirect($redirect, 'refresh');
		}
	}
	
	public function signup($email, $password)
	{
		$user = $this->CI->authit_model->get_user_by_email($email);
		if($user) return false;
		 
		$password = password_hash($password, PASSWORD_DEFAULT);
		$this->CI->authit_model->create_user($email, $password);
		return true;
	}
	
	public function reset_password($user_id, $new_password)
	{
		$new_password = password_hash($new_password, PASSWORD_DEFAULT);
		$this->CI->authit_model->update_user($user_id, array('password' => $new_password));
	}
	
}

/* End of file: Authit.php */
/* Location: application/libraries/Authit.php */