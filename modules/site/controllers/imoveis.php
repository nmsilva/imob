<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imoveis extends CI_Controller {

        private $per_page=3;
        
        function __construct() {
            parent::__construct();
            
            $this->load->helper('site');
            $this->load->model('imovel_model');
            
            $this->load->library('pagination');

        }
        
	public function index()
	{
            $this->listar();
	}
        
        public function listar($page="0")
        {            
            $config['base_url'] = site_url("site/imoveis/listar");
            $config['total_rows'] = $this->db->count_all('imoveis');
            $config['per_page'] = $this->per_page;
            $config['uri_segment'] = 4;
            
            $this->pagination->initialize($config);
            $data['imoveis']= $this->imovel_model->get_imoveis("",$page,$config['per_page']);
            $data['page']=$page;
            
            $this->template->set_template('site');
            $this->template->write_view('content', 'lista_imoveis',$data);
            
            $procura['tipos_imoveis']=$this->imovel_model->get_tipos_imovel();
            
            $this->template->write_view('sidebar', 'procurar_imovel',$procura);
            $this->template->render();
        }
        
        public function search()
        {
            $data['imoveis']= $this->imovel_model->get_imoveis_procura();
            
            $this->template->set_template('site');
            $this->template->write_view('content', 'lista_imoveis',$data);
            
            $procura['tipos_imoveis']=$this->imovel_model->get_tipos_imovel();
            
            $this->template->write_view('sidebar', 'procurar_imovel',$procura);
            $this->template->render();
        }
}
