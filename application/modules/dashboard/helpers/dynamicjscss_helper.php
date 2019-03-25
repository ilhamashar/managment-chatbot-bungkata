<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/23/2018
 * Time: 2:39 PM
 *
 * Add 'header_js', 'header_css', 'footer_js', 'footer_css' key with array value to config
 */
if(!function_exists('add_header_js')){
    function add_header_js($file='')
    {
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}

if(!function_exists('add_footer_js')){
    function add_footer_js($file='')
    {
        $ci = &get_instance();
        $footer_js  = $ci->config->item('footer_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $footer_js[] = $item;
            }
            $ci->config->set_item('footer_js',$footer_js);
        }else{
            $str = $file;
            $footer_js[] = $str;
            $ci->config->set_item('footer_js',$footer_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_header_css')){
    function add_header_css($file='')
    {
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css',$header_css);
        }else{
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css',$header_css);
        }
    }
}

if(!function_exists('put_headers')){
    function put_headers()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        $header_js  = $ci->config->item('header_js');

        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().$item.'" type="text/css" />'."\n";
        }

        foreach($header_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url().$item.'"></script>'."\n";
        }

        return $str;
    }
}

if(!function_exists('put_footers')){
    function put_footers()
    {
        $str = '';
        $ci = &get_instance();
        $footer_css = $ci->config->item('footer_css');
        $footer_js  = $ci->config->item('footer_js');

        foreach($footer_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().$item.'" type="text/css" />'."\n";
        }

        foreach($footer_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url().$item.'"></script>'."\n";
        }

        return $str;
    }
}