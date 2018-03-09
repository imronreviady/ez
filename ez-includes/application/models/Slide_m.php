<?php

class Slide_M extends MY_Model
{
	protected $_table_name = 'slider';
	protected $_primary_key = 'id';
	protected $_order_by = 'id desc';
	public $rules = array(
		'title' => array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|xss_clean'
		),
		'alias' => array(
			'field' => 'alias',
			'label' => 'Alias',
			'rules' => 'trim|required|xss_clean'
		),
		'sliderType' => array(
			'field' => 'sliderType',
			'label' => 'Slider type',
			'rules' => 'trim|required|xss_clean'
		)
	);

	public function get_new ()
	{
		$slide = new stdClass();
		$slide->title = '';
		$slide->alias = '';
		$slide->sliderType = '';
		$slide->sliderSource = array();
		$slide->customize = array();
		return $slide;
	}

}