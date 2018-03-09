<?php

class Media extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {
	    // Redirect unauthorized users
	    if ( ! $this->authorization->is_permitted('manage_media'))
	    {
  		$this->session->set_flashdata('access_error', ez_line('access_denied'));
	      redirect($this->agent->referrer());
	    }

		$data['main_content'] = 'media/index';
		$data['page_title'] = ez_line('media');

		$this->load->ext_view('admin', 'layouts/main',$data);
    }


}