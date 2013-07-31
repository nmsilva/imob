<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicos extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $this->load->helper('site');
            $this->load->model('imovel_model');

        }
        
	public function index()
	{
                $this->template->set_template('site');
                $this->template->write_view('content', 'servicos');
                
                $procura['tipos_imoveis']=$this->imovel_model->get_tipos_imovel();
                $this->template->write_view('sidebar', 'procurar_imovel',$procura);
                $this->template->render();
	}
}
