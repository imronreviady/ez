<?php

class Langswitch extends Frontend_Controller
{
    public function __construct() {
        parent::__construct();

        // Load required helper
        $this->load->helper('url');
    }


    /**
     * Switch language on session.
     *
     * @param string $language 	Language name  
     *
     * @return mixed  Change language on session data
     */
    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);

        // Redirect user to referrer url
        redirect($_SERVER['HTTP_REFERER']);
    }
}
