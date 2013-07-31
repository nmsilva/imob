<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users extends CI_Controller {

        private $title_page="Utilizadores";
        
        function __construct() {
            parent::__construct();
            
            $this->load->model('user_model');
            $this->user_model->check_status();
            
            $this->template->set_template('admin');
            $this->template->write('id_body', 'container');
            
            $data=array('title'=>$this->title_page);
            
            $this->template->write_view('menu', 'menu', $data);
            $this->template->write_view('footer', 'footer');
        }
        
        function index()
        {
            $this->template->write_view('content', 'users/users');
            $this->template->render();
        }
        
        function perfil()
        {
            $this->template->write_view('content', 'users/perfil');
            $this->template->render();
        }

}