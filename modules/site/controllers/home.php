<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $this->load->helper('site');
            $this->load->model('imovel_model');

        }
        
	public function index()
	{
            $data['imoveis']= $this->imovel_model->get_imoveis_destaque();
            
            $this->template->set_template('site');
            $this->template->write_view('destaques', 'imoveis_destaque',$data);
            $this->template->write_view('content', 'home');
            
            $procura['tipos_imoveis']=$this->imovel_model->get_tipos_imovel();
            $this->template->write_view('sidebar', 'procurar_imovel',$procura);
            
            $this->template->render();
	}
        
        public function imovel($id)
        {
            if(isset($id))
            {
                $data['imoveis']= $this->imovel_model->get_imoveis($id);
                
                $this->load->view('ajax_destaque',$data);
            }
        }
}
