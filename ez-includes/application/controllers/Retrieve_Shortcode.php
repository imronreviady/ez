<?php

class Retrieve_Shortcode extends Frontend_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

    public function retrieve()
    {

        $shortcode = '[' . $this->input->post('shortcode') . '/]';

        $shortcode = str_replace('+', ' ', $shortcode);

        echo do_shortcode($shortcode);
    }

}