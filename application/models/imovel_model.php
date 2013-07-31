<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class imovel_model extends CI_Model {

    private $sql_get_imoveis="SELECT i.nimovel, i.titulo, i.morada, i.longi,i.lati, i.localidade, i.area_terreno, i.preco,
                            i.descricao,i.ano,ti.desc_tipo,ti.id_tipo
                    FROM imoveis as i, 
                        tipos_imovel as ti
                    WHERE i.id_tipo=ti.id_tipo";
    
    var $image_path;
    var $thumb_path;
    var $destaque_path;


    function __construct()
    {
        parent::__construct();
        
        $this->image_path= FCPATH."assets/imgs/imoveis/";
        $this->thumb_path=$this->image_path."thumbs/";
        $this->destaque_path=$this->image_path."destaques/";
    }

    function get_tipos_imovel($id="")
    {
        
        $sql_query="SELECT id_tipo, desc_tipo FROM tipos_imovel";
        
        if($id!="")
            $sql_query.=" WHERE id_tipo='$id'";
        
        $query = $this->db->query($sql_query);
        
        return $query->result_array();
    }
    
    function insert_tipo_imovel()
    {
        $data['DESC_TIPO'] = $this->input->post('titulo');
        $this->db->insert('tipos_imovel', $data);
    }
    
    function edit_tipo_imovel($id)
    {
        $data['DESC_TIPO'] = $this->input->post('titulo');
        
        $this->db->where('id_tipo', $id);
        $this->db->update('tipos_imovel', $data); 
    }
    
    function del_tipo_imovel($id)
    {
        $query = $this->db->get_where('imoveis', array('id_tipo' => $id));
        
        if($query->num_rows()==0)
             return $this->db->delete('tipos_imovel', array('id_tipo' => $id));
        else
            return FALSE;
    }
    
    function insert_imovel()
    {

        $data= $this->get_values_imovel();
        $this->db->insert('imoveis', $data);
        
        // retorna o id do ultimo imovel que foi inserido
        $id_imovel=mysql_insert_id();
        
        // fax o upload das imagens do imovel e grava na base de dados
        $imagens=$this->get_upload_images();
        foreach ($imagens as $key => $value) {
            
            $var['NIMOVEL']=$id_imovel;
            $var['PATH']=$imagens[$key]['PATH'];
            $var['ALT']=$imagens[$key]['ALT'];
            $this->db->insert('imagens_imovel', $var);
        }
        
    }
    
    function del_imovel($id)
    {

        $imagem_destaque=$this->get_img_destaque($id);
        
        if($imagem_destaque)
        {
            if(!unlink($this->destaque_path.$imagem_destaque[0]['path']))die ('error to delete image file');
            if(!unlink($this->thumb_path.$imagem_destaque[0]['path']))die ('error to delete image file');
        }
        
        $imagens=$this->get_images($id);
        foreach ($imagens as $imagem) {
            if(!unlink($this->image_path.$imagem['path']))die ('error to delete image file');
            if(!unlink($this->thumb_path.$imagem['path']))die ('error to delete image file');
        }
        
        $this->db->delete('imagens_imovel', array('NIMOVEL' => $id));
        $this->db->delete('imoveis', array('NIMOVEL' => $id));
        
        return TRUE;
    }
    
    function del_imagem_imovel($id_imagem)
    {
        $query = $this->db->query("SELECT path FROM imagens_imovel WHERE id_imagem='$id_imagem'");
        
        $res=$query->result_array();
        
        if(!unlink($this->image_path.$res[0]['path']))die ('error to delete image file');
        if(!unlink($this->thumb_path.$res[0]['path']))die ('error to delete image file');
        
        $this->db->delete('imagens_imovel', array('id_imagem' => $id_imagem));
        
        return TRUE;
    }
    
    function add_imagens($id)
    {
        // fax o upload das imagens do imovel e grava na base de dados
        $imagens=$this->get_upload_images();
        foreach ($imagens as $key => $value) {
            
            $var['NIMOVEL']=$id;
            $var['PATH']=$imagens[$key]['PATH'];
            $var['ALT']=$imagens[$key]['ALT'];
            
            $this->db->where('nimovel', $id);
            $this->db->insert('imagens_imovel', $var); 
            
        }
    }
    
    function edit_imovel($id)
    {
        $data= $this->get_values_imovel();
        
        $this->db->where('nimovel', $id);
        $this->db->update('imoveis', $data); 
    }
    
    function get_imoveis($id="",$page="",$per_page="")
    {
        $mysql_query= $this->sql_get_imoveis;
        
        if($id!="")
            $mysql_query.=" and i.nimovel='$id'";
        if(($page!="") && ($per_page!=""))
            $mysql_query.=" LIMIT $page,$per_page";
        
        $query = $this->db->query($mysql_query);
        
        return $query->result_array();
        
    }
    
    function get_imoveis_procura()
    {
        $mysql_query= $this->get_query_procura();
        
        $query = $this->db->query($mysql_query);
        
        return $query->result_array();
    }
    
    function get_imoveis_destaque()
    {
        $query = $this->db->query($this->sql_get_imoveis);
        
        return $query->result_array();
    }
    
    function get_img_destaque($id_imovel)
    {
        $query = $this->db->query("SELECT id_imagem,path FROM imagens_imovel WHERE nimovel='$id_imovel' and alt='1'");
        
        if($query->num_rows()!=0)
            return $query->result_array();
    }
    
    function get_images($id_imovel){
        $query = $this->db->query("SELECT id_imagem,path FROM imagens_imovel WHERE nimovel='$id_imovel' and alt='0'");
        
        return $query->result_array();
    }
    
    private function get_query_procura()
    {
        $data['ID_TIPO'] = $this->input->post('tipo_imovel');
        $data['LOCALIDADE'] = $this->input->post('localizacao');
        $data['PRECO_DE'] = $this->input->post('preco_de');
        $data['PRECO_ATE'] = $this->input->post('preco_ate');
        
        $query= $this->sql_get_imoveis;
        if(!empty($data['ID_TIPO']))
            $query.=" and ti.id_tipo=".$data['ID_TIPO'];
        
        if(!empty($data['LOCALIDADE']))
            $query.=" and i.LOCALIDADE LIKE  '%".$data['LOCALIDADE']."%'";
        
        if(!empty($data['PRECO_DE']))
            $query.=" and i.PRECO>".$data['PRECO_DE'];
        
        if(!empty($data['PRECO_ATE']))
            $query.=" and i.PRECO<".$data['PRECO_ATE'];
        
        return $query;
    }
    
    private function get_values_imovel()
    {
        $data['TITULO'] = $this->input->post('titulo');
        $data['PRECO'] = $this->input->post('preco');
        $data['AREA_TERRENO'] = $this->input->post('area');
        $data['ANO'] = $this->input->post('ano');
        $data['ID_TIPO'] = $this->input->post('tipo');
        $data['DESCRICAO'] = $this->input->post('descricao');
        $data['LOCALIDADE'] = $this->input->post('localidade');
        $data['MORADA'] = $this->input->post('morada');
        $data['LONGI'] = $this->input->post('long');
        $data['LATI'] = $this->input->post('lat');
        
        return $data;
    }
    
    private function get_upload_images()
    {       
        
        $config['upload_path'] = FCPATH.'assets/imgs/imoveis/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']    = '2048'; //2 meg
        $config['encrypt_name'] =TRUE;

        $this->load->library('upload',$config);
        $this->load->library('m2brimagem');
        
        $errors=array();
        $data=array();
        
        $i=0;
        foreach($_FILES as $key => $value)
        {
            
            if(!empty($value['name']) AND empty($errors))
            {
        
                if (!$this->upload->do_upload($key))
                    $errors[] = $this->upload->display_errors();
                else
                {
                    $result=$this->upload->data();
                                        
                    $oImg = new m2brimagem($result['full_path']);
                    
                    if ($oImg->valida()=='OK') {
                        
                        if($key!='imagem'){
                            $oImg->redimensiona(630,438);
                            $oImg->grava($result['full_path'], 100);
                            $oImg->redimensiona(121,83);
                            $oImg->grava($result['file_path']."thumbs/".$result['file_name'], 100);
                            $data[$i]['ALT']='0';
                        }                 
                        else{
                            $oImg->redimensiona(624,250);
                            $oImg->grava($result['file_path']."destaques/".$result['file_name'], 100);
                            $oImg->redimensiona(121,83);
                            $oImg->grava($result['file_path']."thumbs/".$result['file_name'], 100);
                            
                            unlink($result['full_path']);
                            $data[$i]['ALT']='1';
                        }
                        
                    }
                    
                    $data[$i]['PATH']=$result['file_name'];
                    
                    $i++;
                }
             }
        
        }
        
        return $data;
        
    }
}