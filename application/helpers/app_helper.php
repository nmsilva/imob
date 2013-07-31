<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function draw_menu_admin()
{
    $CI =& get_instance();
    
    $CI->load->library('menu',array('active_class'=>'on', 'render_type' => 'collapsible','container_tag_class'=>'nav'));
    
    $nav = array();
    $nav['admin/dashboard'] =  array('label'=>'Dashboard', 'attributes'=>'class="btn orange"');
    $nav['admin/imoveis'] =  array('label'=>'Imoveis', 'attributes'=>'class="top-link menu"');
    $nav['admin/imoveis/novo'] = array('label' => 'Adicionar Imóvel', 'parent_id' => 'admin/imoveis');
    $nav['admin/imoveis/listar'] = array('label' => 'Lista de Imóveis', 'parent_id' => 'admin/imoveis');
    $nav['admin/tiposimoveis'] = array('label' => 'Tipos de Imóveis', 'parent_id' => 'admin/imoveis');
    
    $nav['admin/pages'] = 'Páginas';
    $nav['admin/users'] = 'Utilizadores';
    
    $nav['admin/perfil'] =  array('label'=>'Perfil', 'attributes'=>'class="top-link menu"');
    $nav['admin/users/perfil'] = array('label' => 'Opções', 'parent_id' => 'admin/perfil');
    $nav['admin/dashboard/logout'] = array('label' => 'Sair', 'parent_id' => 'admin/perfil');
    
    $active = uri_string();
    $menu = $CI->menu->render($nav, $active, NULL, 'basic');

    return $menu;
}
