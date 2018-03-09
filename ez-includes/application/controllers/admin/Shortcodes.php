<?php

class Shortcodes extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

  public function parse()
  {
    $code = $this->input->post('scode');

    $data['content'] = $this->Shortcodes->parse($code);

    $this->load->ext_view('admin', 'layouts/shortcode',$data);
  }

}