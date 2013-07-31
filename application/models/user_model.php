<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_user()
    {
        $options=func_get_args();
        $this->db->where('EMAIL',$options[0]);
        $this->db->where('SENHA',$options[1]);		
        $query = $this->db->get('utilizadores');
        return $query->row(0);
    }
    
    function login_user($options = array())
    {
        
    }
    
    function is_login()
    {
        $logged = $this->session->userdata('logged');

        if (!isset($logged) || $logged != TRUE) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    private function hashPassword($password)
    {
        //gera uma string salt aleatória
        $data['salt'] = sha1(rand());
        //gera o hashing da password
        $data['password'] = sha1($data['salt'].$password);
        
        return $data;
    }
    
    function insert_user()
    {
        
    }
    
    function delete_user()
    {
        
    }
    
    function check_status()
    {
        if(!$this->is_login())
            redirect ('admin/home');
    }
    
    function check_login_status()
    {
        if($this->is_login())
            redirect ('admin/dashboard');
        
    }
}
