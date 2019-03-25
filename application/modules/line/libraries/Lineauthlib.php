<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/11/2018
 * Time: 8:42 PM
 */

class Lineauthlib
{
    function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->helper('url');
        $this->CI->load->config('line/lineauth');
    }

    function get_url($callback=NULL){
        if (!$callback) return FALSE;
        $session_factory = new \Aura\Session\SessionFactory;
        $session = $session_factory->newInstance($_COOKIE);
        $csrf_value = $session->getCsrfToken()->getValue();
        $url    = "https://access.line.me/oauth2/v2.1/authorize?scope=profile&response_type=code&client_id=" . $this->CI->config->item('LOGIN_CHANNEL_ID') . "&redirect_uri=" . $callback . '&state=' . $csrf_value;
        return $url;
    }

    function get_result($code=NULL,$callback=NULL){
        if (!$callback || !$code) return FALSE;
        $url = 'https://api.line.me/oauth2/v2.1/token';
        $data = array(
            'grant_type' => 'authorization_code',
            'client_id' => $this->CI->config->item('LOGIN_CHANNEL_ID'),
            'client_secret' => $this->CI->config->item('LOGIN_CHANNEL_SECRET'),
            'code' => $_GET['code'],
            'redirect_uri' => $callback
        );
        $data = http_build_query($data, '', '&');
        $header = array(
            'Content-Type: application/x-www-form-urlencoded'
        );
        $context = array(
            'http' => array(
                'method' => 'POST',
                'header' => implode('\r\n', $header),
                'content' => $data
            )
        );
        $resultString = file_get_contents($url, false, stream_context_create($context));
        $result = json_decode($resultString, true);

        if (isset($result['access_token'])) {
            $url = 'https://api.line.me/v2/profile';
            $context = array(
                'http' => array(
                    'method' => 'GET',
                    'header' => 'Authorization: Bearer ' . $result['access_token']
                )
            );
            $profileString = file_get_contents($url, false, stream_context_create($context));
            $profile = json_decode($profileString, true);
            return $profile;
        }
        return FALSE;
    }
}