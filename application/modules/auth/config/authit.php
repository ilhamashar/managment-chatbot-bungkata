<?php
/**
 * Authit Authentication Library
 *
 * @package Authentication
 * @category Libraries
 * @author Ron Bailey
 * @version 1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$config['authit_users_table']           = 'auth_user';
$config['authit_groups_table']          = 'auth_group';
$config['authit_password_min_length']   = 4;
// Do you want to test the emails you send out?
//    If you do you can view the results by going to ../auth/sentemails
$config['authit_test_emails']           = true;

$config['authit_admin_group']           = 'admin';
$config['authit_default_group']         = 'member';

$config['authit_remember_users']        = true;
$config['authit_user_expire']           = 1209600; // How long to remember the user (seconds). Set to zero for no expiration

/*
 | -------------------------------------------------------------------------
 | Cookie options.
 | -------------------------------------------------------------------------
 | remember_cookie_name Default: remember_code
 | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';

/* End of file: Authit.php */
/* Location: application/config/Authit.php */