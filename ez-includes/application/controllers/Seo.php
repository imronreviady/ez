<?php

Class Seo extends CI_Controller {

    function sitemap()
    {

        $data['posts']      = $this->Post_m->get();
        $data['pages']      = $this->Page_m->get();
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->ext_view('admin', 'sitemap',$data);
    }
}