<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tiposimoveis extends CI_Controller {

    private $title_page="Imóveis";
    
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
        $this->listar();
    }
    
    function listar(){
        
        $this->load->model('imovel_model');
        
        $data['tipos']= $this->imovel_model->get_tipos_imovel();
        
        $this->template->write_view('content', 'tiposimoveis/listar',$data);
        $this->template->render();
    }
    
    function novo(){
        $this->template->write_view('content', 'tiposimoveis/novo');
        $this->template->render();
    }
    
    function save(){
        
        $this->load->library('form_validation');
        
        $config=array(
                    array('field'   => 'titulo',
                         'label'   => 'Titulo',
                         'rules'   => 'required|min_length[1]|max_length[30]'
                        )
                  );
        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run())
        {
            $this->load->model('imovel_model');
            
            if($this->input->post('id'))
                $this->imovel_model->edit_tipo_imovel($this->input->post('id'));
            else
                $this->imovel_model->insert_tipo_imovel();
            
            redirect('admin/tiposimoveis');
        }
        else
            $this->novo();
    }
    
    function edit($id){
        
        if(isset($id))
        {
            $this->load->model('imovel_model');

            $data['tipo']=$this->imovel_model->get_tipos_imovel($id);

            $this->template->write_view('content', 'tiposimoveis/edit',$data);
            $this->template->render();
        }
        else
            redirect("admin/tiposimoveis");
    }
    
    function del($id){
        
        if(isset($id))
        {
            $this->load->model('imovel_model');

            if($this->imovel_model->del_tipo_imovel($id))
                $this->session->set_flashdata('sucess', 'Tipo de Imóvel eliminado com Sucesso!');
            else
                $this->session->set_flashdata('warning', 'Não foi Possivel Eliminar! Verifique se não tem Imóveis deste tipo.');
            
        }
        
        redirect("admin/tiposimoveis");
    }
}
