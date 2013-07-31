<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class result extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $this->load->model('android_model');
            $this->load->model('user_model');
        }
        
        function index(){
            
            
            if (isset($_POST['tag']) && $_POST['tag'] != '') {
                
                // get tag
                $tag = $_POST['tag'];
    
                // response Array
                $response = array("tag" => $tag, "success" => 0, "error" => 0);
                
                switch ($tag) {
                    case 'login':
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        
                        $user = $this->user_model->get_user($email, $password);
                        if ($user != false) 
                            $response["success"] = 1;
                        else{
                            $response["error"] = 1;
                            $response["error_msg"] = "Incorrect email or password!";
                        }
                            
                        break;
                    case 'imoveis':
                        $response["success"] = 1;
                        $response["imoveis"]=$this->android_model->getImoveis();
                        
                        break;
                    case 'tipos':
                        $response["success"] = 1;
                        $response["tipos"]=$this->android_model->getTiposImoveis();
                        
                        break;
                    case 'insert':
                            $response["id_imovel"]= $this->android_model->insertImovel();
                            $response["success"] = 1;
                            
                        break;
                    case 'imovel':
                        
                        $response["imovel"]=$this->android_model->getImovel($_POST['id_imovel']);
                        $response["success"] = 1;
                        
                        break;
                    case 'edit':
                        
                        $this->android_model->editImovel();
                        $response["success"] = 1;
                        
                        break;
                    case 'images':
                        
                        $id_imovel=$this->input->post('id_imovel');
                        
                        $response["images"]=$this->android_model->getImages($id_imovel);
                        $response["success"] = 1;
                        
                        break;
                    case 'upload':
                        
                        $id_imovel=$this->input->post('id_imovel');
                        $n_img=$this->input->post('img_num');
        
                        $this->android_model->saveImage($id_imovel,$n_img);
                        $response["success"] = 1;
                        
                        break;
                    case 'save-localizacao':
                        
                        $id_imovel=$this->input->post('id_imovel');
                        
                        $this->android_model->saveLocalizacao($id_imovel);
                        $response["success"] = 1;
                        break;
                    case 'get-localizacao':
                        
                        $id_imovel=$this->input->post('id_imovel');
                        
                        $response["localizacao"] = $this->android_model->getLocalizacao($id_imovel);
                        $response["success"] = 1;
                        
                        break;
                    case 'delete':
                        
                        $id_imovel=$this->input->post('id_imovel');
                        
                        $this->load->model("imovel_model");
                        $response["result"]=$this->imovel_model->del_imovel($id_imovel);
                        
                        $response["success"] = 1;
                        break;
                    default:
                        break;
                }
            }
            else
                $response="Acess Denied!";
            
            $data['response']= $response;
            $this->load->view('result',$data);
        }
        
        public function test()
        {
            $this->load->view('test');
        }
}
