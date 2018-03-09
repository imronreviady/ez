<?php

class Dashboard extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {

      // Set view file
      $data['main_content'] = 'dashboard/index';

      // Set page title
      $data['page_title']   = ez_line('dashboard');

      // Load view file with data
      $this->load->ext_view('admin', 'layouts/main',$data);
    }
}

