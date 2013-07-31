<?php

function site_nav()
{
    $CI =& get_instance();
    
    $CI->load->library('menu');
        
    $nav = array();
    $nav['site/home'] =  'Home';
    $nav['site/imoveis'] =  'Imóveis';
    $nav['site/servicos'] =  'Serviços';
    $nav['site/contactos'] =  'Contactos';
        
    $active = uri_string();
    $menu = $CI->menu->render($nav, $active, NULL, 'basic');

    return $menu;
}
