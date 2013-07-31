<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class android_model extends CI_Model {

    private $_host="http://www.imob.tecweb.pt/";
    private $_uploadPath;
    private $_thumbPath;
    
    function __construct()
    {
        parent::__construct();
        
        $this->_uploadPath=FCPATH.'assets/imgs/imoveis/';
        $this->_thumbPath=$this->_host."/assets/imgs/imoveis/thumbs/";
    }
    
    public function getImoveis()
    {
        $result = $this->db->query("SELECT m.*,i.PATH FROM imoveis as m, imagens_imovel as i WHERE m.nimovel=i.nimovel and i.alt=1");
        
        $res=array();
        $i=0;
        foreach($result->result_array() as $imovel)
        {
            $res[$i]['id']=$imovel['NIMOVEL'];
            $res[$i]['titulo_imovel']=($imovel['TITULO']);
            $res[$i]['local_imovel']=($imovel['LOCALIDADE']);
            $res[$i]['imagem_imovel']= $this->_thumbPath.$imovel['PATH'];
            $res[$i]['preco_imovel']=$imovel['PRECO'];
            
            $i++;
        }
               
        return $res;
    }
    
    public function getTiposImoveis()
    {
        $result = $this->db->query("SELECT * FROM tipos_imovel");
        
        $res=array();
        $i=0;
        foreach($result->result_array() as $tipo)
        {
            $res[$i]['id']=$tipo['ID_TIPO'];
            $res[$i]['desc']=($tipo['DESC_TIPO']);
            
            $i++;
        }
        return $res;
    }
    
    public function insertImovel()
    {
        extract($_POST);
        
        $sql="INSERT INTO imoveis (ID_TIPO,TITULO,PRECO,AREA_TERRENO,ANO,DESCRICAO) VALUES('$tipo','$titulo','$preco','$area','$ano','$descricao')";
        
        $this->db->query($sql);
        
        return mysql_insert_id();
    }
    
    public function editImovel()
    {
        $id_imovel= $this->input->post('id_imovel');
        
        extract($_POST);
        
        $update['ID_TIPO']=$tipo;
        $update['TITULO']=$titulo;
        $update['PRECO']=$preco;
        $update['AREA_TERRENO']=$area;
        $update['ANO']=$ano;
        $update['DESCRICAO']=$descricao;
        
        $this->db->where('nimovel', $id_imovel);
        $this->db->update('imoveis', $update); 
        
    }
    
    public function getIdTipo($tipo)
    {
        $result = $this->db->query("SELECT id_tipo FROM tipos_imovel WHERE DESC_TIPO='$tipo' LIMIT 1");
        
        return $result->row()->id_tipo;
    }
    
    public function getImovel($id)
    {
        $result = $this->db->query("SELECT ID_TIPO,TITULO,PRECO,AREA_TERRENO,ANO,DESCRICAO FROM imoveis WHERE nimovel='$id'");
        
        $res['ID_TIPO'] = $result->row()->ID_TIPO;
        $res['PRECO'] = $result->row()->PRECO;
        $res['AREA_TERRENO'] = $result->row()->AREA_TERRENO;
        $res['ANO'] = $result->row()->ANO;
        $res['TITULO'] = ($result->row()->TITULO);
        $res['DESCRICAO'] = ($result->row()->DESCRICAO);
        
        return $res;
    }
    
    public function saveImage($id_imovel,$n_img)
    {
        $this->load->helper('string');
        $this->load->library('m2brimagem');
        
        $data=array();
        $filename= strtolower(random_string('alnum', 32));
        $filename.='.jpg';
        
        $base=$_REQUEST['image'];
                
        $binary=base64_decode($base);
        header('Content-Type: bitmap; charset=utf-8');
        $filepath=$this->_uploadPath.$filename;
        $file = fopen($filepath, 'wb');
        fwrite($file, $binary);
        fclose($file);
        
        $oImg = new m2brimagem($filepath);
        
        if($n_img==1){
            $oImg->redimensiona(624,250);
            $oImg->grava($this->_uploadPath."destaques/".$filename, 100);
            
            unlink($filepath);
            $data['ALT']='1';
        }                 
        else{
            $oImg->redimensiona(630,438);
            $oImg->grava($filepath, 100);
            $data['ALT']='0';
        }
        
        $oImg->redimensiona(121,83);
        $oImg->grava($this->_uploadPath."thumbs/".$filename, 100);
        
        $data['PATH']=$filename;
        $data['NIMOVEL']=$id_imovel;

        $this->db->where('nimovel', $id_imovel);
        $this->db->insert('imagens_imovel', $data); 
            
    }
    
    
    public function getImages($id_imovel)
    {
        $this->load->model('imovel_model');
        
        $images=array();
        $destaque=$this->imovel_model->get_img_destaque($id_imovel);
        $imagens=$this->imovel_model->get_images($id_imovel);
        
        $images[0]['path']=$this->_thumbPath.$destaque[0]['path'];
        $i=1;
        
        foreach ($imagens as $key => $value) {
            $images[$i]['path']= $this->_thumbPath.$value['path'];
            $i++;
        }
        return $images;
    }
    
    public function saveLocalizacao($id_imovel)
    {

        $update['LONGI']=$this->input->post('longi'); 
        $update['LATI']=$this->input->post('lati'); 
        $update['MORADA']=$this->input->post('morada'); 
        $update['LOCALIDADE']=$this->input->post('localidade'); 
        
        $this->db->where('nimovel', $id_imovel);
        $this->db->update('imoveis', $update); 
       
    }
    
    public function getLocalizacao($id_imovel)
    {
        $result = $this->db->query("SELECT LONGI,LATI,MORADA,LOCALIDADE FROM imoveis WHERE nimovel='$id_imovel'");
        
        $res['LONGI'] = $result->row()->LONGI;
        $res['LATI'] = $result->row()->LATI;
        $res['MORADA'] = $result->row()->MORADA;
        $res['LOCALIDADE'] = $result->row()->LOCALIDADE;
        
        return $res;
    }
}