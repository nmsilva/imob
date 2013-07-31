<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $this->load->model('user_model');
            $this->user_model->check_login_status();
        }
        
	public function index()
	{
            $this->_set_view();
	}
        
        public function login()
        {
                $this->form_validation->set_rules('email','email','trim|required|valid_email|callback__check_login');
			
		if($this->form_validation->run())
                {
                   $data = array(
                        'email' => $this->input->post('email'),
                        'logged' => TRUE
                    );
                   
                    $this->session->set_userdata($data);
                    
                    $this->user_model->check_login_status();
                }
                
                $this->_set_view();
        }
                
        function _check_login($email)
        {
	
		if($this->input->post('password'))
		{
                    
                    $user = $this->user_model->get_user($email,$this->input->post('password'));

                    if($user) return TRUE;

		}
		
		$this->form_validation->set_message('_check_login','Utilizador / Senha errado(s)');
		return FALSE;
	
	}
        
        private function _set_view()
        {
                $this->template->set_template('admin');
                $this->template->write('id_body', 'login');
                $this->template->write_view('content', 'login');  
                
                $this->template->render();
        }
}
