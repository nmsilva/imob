<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imoveis extends CI_Controller {

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
    
    function index() {
        $this->listar();
    }
    
    function novo(){
        
        $this->load->model('imovel_model');
        
        $data=array('tipos_imoveis'=> $this->imovel_model->get_tipos_imovel());
        
        $this->load->helper('form');
        $this->template->write_view('content', 'imoveis/novo',$data);
        $this->template->render();
    }
    
    function listar(){
        
        $this->load->model('imovel_model');
        
        $data['imoveis']= $this->imovel_model->get_imoveis();
        
        $this->template->write_view('content', 'imoveis/listar',$data);
        $this->template->render();
    }
    
    function save(){
        
        $this->load->model('imovel_model');
        $this->load->library('form_validation');
        
        $config=array(
                array('field'   => 'titulo',
                        'label'   => 'Titulo',
                        'rules'   => 'required|min_length[3]|max_length[50]'
                    ),
                array('field' => 'tipo',
                        'label' => 'Tipo de Imóvel',
                        'rules' => 'required'
                    ),
                array('field' => 'preco',
                        'label' => 'Preço',
                        'rules' => 'required'
                ),
                array('field' => 'area',
                        'label' => 'Área do Terreno',
                        'rules' => 'required'
                ),
                array('field' => 'ano',
                        'label' => 'Ano de Construção',
                        'rules' => 'required'
                ),
                array('field' => 'descricao',
                        'label' => 'Descrição',
                        'rules' => 'required|min_length[4]'
                ),
                array('field' => 'localidade',
                        'label' => 'Localidade',
                        'rules' => 'required|min_length[4]'
                ),
                array('field' => 'morada',
                        'label' => 'Morada',
                        'rules' => 'required|min_length[4]'
                ),
                array('field' => 'long',
                        'label' => 'Mapa',
                        'rules' => 'required'
                ),
                array('field' => 'lat',
                        'label' => 'Mapa',
                        'rules' => 'required'
                ));

        
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run())
        {
            if($this->input->post('id'))
                $this->imovel_model->edit_imovel($this->input->post('id'));
            else
                $this->imovel_model->insert_imovel();
            
            redirect('admin/imoveis');
        }
        else
            $this->novo();

        
    }
    
    function map(){
        
        $morada=$this->input->post('morada');
        
        if(!empty($morada))
        {
            $this->load->library('gMaps');

            $gmaps = new gMaps('ABQIAAAAJUmOL8jq6BxCNATKQ41slxQsHStN5n9DvzffalajE6Hih6jcAhSAPE399jQLyZr3Gp0qHSbR-_42hA');

            $dados = $gmaps->geolocal($morada);

            echo json_encode($dados);
        }

    }
    
    function upload_imagens($id)
    {
        if(isset($id))
        {
            $this->load->model('imovel_model');
            
            $this->imovel_model->add_imagens($id);
            
            redirect("admin/imoveis/edit/".$id."#imagens");
        }
        else
            redirect("admin/imoveis");
    }
    
    function edit($id)
    {
        if(isset($id))
        {
            $this->load->model('imovel_model');

            $data['imovel']=$this->imovel_model->get_imoveis($id);
            $data['tipos_imoveis']= $this->imovel_model->get_tipos_imovel();
            $data['imagem_destaque']= $this->imovel_model->get_img_destaque($id);
            $data['imagens']= $this->imovel_model->get_images($id);

            $this->template->write_view('content', 'imoveis/edit',$data);
            $this->template->render();
        }
        else
            redirect("admin/imoveis");
        
    }
    
    function del($id)
    {
        if(isset($id))
        {
            $this->load->model('imovel_model');

            if($this->imovel_model->del_imovel($id))
                $this->session->set_flashdata('sucess', 'Imóvel eliminado com Sucesso!');
            else
                $this->session->set_flashdata('warning', 'Não foi Possivel Eliminar!');
        }
        
        redirect("admin/imoveis");
    }
    
    function delimage($id_imagem,$id_imovel)
    {
        if(isset($id_imagem))
        {
            $this->load->model('imovel_model');
            
            if($this->imovel_model->del_imagem_imovel($id_imagem))
                $this->session->set_flashdata('sucess', 'Imagem do Imóvel eliminada com Sucesso!');
            else
                $this->session->set_flashdata('warning', 'Não foi Possivel Eliminar!');
            
            redirect("admin/imoveis/edit/".$id_imovel."#imagens");
        }
        else
            redirect("admin/imoveis");
        
    }
    
}