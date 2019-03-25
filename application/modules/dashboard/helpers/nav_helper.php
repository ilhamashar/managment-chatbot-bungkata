<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('active_link'))
{
    function active_link($controller, $method=NULL)
    {
        $CI = &get_instance();
        $class = $CI->router->class;
        $meth = $CI->router->method;
        if ($method){
            return ($class == $controller && $method == $meth) ? 'active' : '';
        }
        return ($class == $controller) ? 'active' : '';
    }
}