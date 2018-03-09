<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Frontend_Controller {

    /**
     * Set Default frontpage.
     *
     * @return mixed load view file
     */
	public function index()
	{

        // Set page title for title tag
        $data['page_title'] = ez_line('contact');

        // Set view file
        $data['main_content'] = 'contact';

        // Load view file with data
        $this->load->view($this->pref->active_theme.'/layouts/main',$data);
        
	}    
}
