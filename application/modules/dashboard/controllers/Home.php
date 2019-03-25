<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 8/31/2018
 * Time: 5:38 PM
 */

class Home extends CI_Controller
{
    function __construct()
    {
        // var_dump(openssl_get_cert_locations());
        // var_dump(phpversion());
        parent::__construct();
        // load model
        $this->load->model('home_model');
        // load library
        $this->load->library('session');
        // load helper
        $this->load->helper(array('url','auth/authit','nav','dynamicjscss'));
        check_login();
    }

    function index(){
        // Morris Chart CSS
        add_header_css('assets/templates/backend/plugins/morrisjs/morris.css');

        $data['page']       = auth_user()->role.'/content_home';
        $data['page_title'] = 'HOME';
        $data['auth_user']  = auth_user();
        $data['user']       = $this->home_model->get_user(auth_user()->user_id);

        $stats              = array();
        $weekstats          = array();
        $adders = $this->home_model->get_user_statistic();
        $sevenday = $this->home_model->get_user_sevenday();

        $haripertama = $this->home_model->get_user_hari1();
        $harikedua = $this->home_model->get_user_hari2();
        $hariketiga = $this->home_model->get_user_hari3();
        $harikeempat = $this->home_model->get_user_hari4();
        $harikelima = $this->home_model->get_user_hari5();
        $harienam = $this->home_model->get_user_hari6();
        $haritujuh = $this->home_model->get_user_hari7();

        foreach ($adders as $u){
            $stats[] = array(
                'day'   => $u->db_date,
                'total' => $u->total,
                'user'  => $u->user_total,
                'group' => $u->group_total,
                'room'  => $u->room_total
            );
        }

        foreach ($sevenday as $p) {
             $weekstats[] = array(
                'week'          => $p->jam,
                'ordinal'      => $p->ordinal,
                'group'         => $p->vs_group,
                'alone'         => $p->alone,
                'multiplayer'   => $p->multiplayer,
                'bungkata'      => $p->bungkata,
                'endless'       => $p->endless
            );
        }

        foreach ($haripertama as $satu) {
             $hourdayone[] = array(
                'jam1'          => $satu->jam,
                'ordinal'       => $satu->ordinal,
                'group'         => $satu->vs_group,
                'alone'         => $satu->alone,
                'multiplayer'   => $satu->multiplayer,
                'bungkata'      => $satu->bungkata,
                'endless'       => $satu->endless
            );
        }

        foreach ($harikedua as $dua) {
             $hourdaytwo[] = array(
                'jam2'          => $dua->jam,
                'ordinal'       => $dua->ordinal,
                'group'         => $dua->vs_group,
                'alone'         => $dua->alone,
                'multiplayer'   => $dua->multiplayer,
                'bungkata'      => $dua->bungkata,
                'endless'       => $dua->endless
            );
        }

        foreach ($hariketiga as $tiga) {
             $hourdaythree[] = array(
                'jam3'          => $tiga->jam,
                'ordinal'       => $tiga->ordinal,
                'group'         => $tiga->vs_group,
                'alone'         => $tiga->alone,
                'multiplayer'   => $tiga->multiplayer,
                'bungkata'      => $tiga->bungkata,
                'endless'       => $tiga->endless
            );
        }

        foreach ($harikeempat as $empat) {
             $hourdayfour[] = array(
                'jam4'          => $empat->jam,
                'ordinal'       => $empat->ordinal,
                'group'         => $empat->vs_group,
                'alone'         => $empat->alone,
                'multiplayer'   => $empat->multiplayer,
                'bungkata'      => $empat->bungkata,
                'endless'       => $empat->endless
            );
        }

        foreach ($harikelima as $lima) {
             $hourdayfive[] = array(
                'jam5'          => $lima->jam,
                'ordinal'       => $lima->ordinal,
                'group'         => $lima->vs_group,
                'alone'         => $lima->alone,
                'multiplayer'   => $lima->multiplayer,
                'bungkata'      => $lima->bungkata,
                'endless'       => $lima->endless
            );
        }

        foreach ($harienam as $enam) {
             $hourdaysix[] = array(
                'jam6'          => $enam->jam,
                'ordinal'       => $enam->ordinal,
                'group'         => $enam->vs_group,
                'alone'         => $enam->alone,
                'multiplayer'   => $enam->multiplayer,
                'bungkata'      => $enam->bungkata,
                'endless'       => $enam->endless
            );
        }

        foreach ($haritujuh as $tujuh) {
             $hourdayseven[] = array(
                'jam7'          => $tujuh->jam,
                'ordinal'       => $tujuh->ordinal,
                'group'         => $tujuh->vs_group,
                'alone'         => $tujuh->alone,
                'multiplayer'   => $tujuh->multiplayer,
                'bungkata'      => $tujuh->bungkata,
                'endless'       => $tujuh->endless
            );
        }

        $data['dashboard']  = array(
            'total_user'    => $this->home_model->get_total_user_count(),
            'available_user'=> $this->home_model->get_available_user_count(),
            'new_user_today'=> $this->home_model->get_today_new_user(),
            'latest_online' => $this->home_model->get_online_users(),
            'adder_stats'   => json_encode($stats),
            'sevenday_weekstats'   => json_encode($weekstats),
            'harisatu_stat' => json_encode($hourdayone),
            'harikedua_stat' => json_encode($hourdaytwo),
            'hariketiga_stat'=> json_encode($hourdaythree),
            'harikeempat_stat' => json_encode($hourdayfour),
            'harikelima_stat' => json_encode($hourdayfive),
            'harienam_stat' => json_encode($hourdaysix),
            'haritujuh_stat' => json_encode($hourdayseven)
        );
        // var_dump($data['dashboard']);
        // exit;
        $this->load->view('dashboard/base', $data);
    }
}