<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imovel extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $this->load->helper('site');
            $this->load->model('imovel_model');
        }
        
	public function view($id)
	{
            if(isset($id))
            {
                $data['imovel']= $this->imovel_model->get_imoveis($id);
                $data['imagem_destaque']= $this->imovel_model->get_img_destaque($id);
                $data['imagens']= $this->imovel_model->get_images($id);
                
                $this->template->set_template('site');
                $this->template->write_view('content', 'imovel',$data);
                
                
                $procura['tipos_imoveis']=$this->imovel_model->get_tipos_imovel();
                $this->template->write_view('sidebar', 'procurar_imovel',$procura);
                
                $this->template->render();
            }
            else
                redirect ('site/imoveis');
	}
        
}
