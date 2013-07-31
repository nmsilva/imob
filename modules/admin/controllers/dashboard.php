<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

    private $title_page="Dashboard";
    
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
        
        function index(){
            
            $this->template->write_view('content', 'dashboard');
            
            $this->template->render();
        }
        
        public function logout(){
                        
            $data = array(
                        'email' => $this->session->userdata('email'),
                        'logged' => $this->session->userdata('logged')
                    );
            $this->session->unset_userdata($data);
            redirect('admin/home');
        }
        
        
}