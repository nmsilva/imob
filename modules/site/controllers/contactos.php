<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contactos extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $this->load->helper('site');

        }
        
	public function index()
	{
                $this->template->set_template('site');
                $this->template->write_view('content', 'contactos');
                $this->template->write_view('sidebar', 'localizacao');
                $this->template->render();
	}
}

