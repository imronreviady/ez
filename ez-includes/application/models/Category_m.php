<?php

class Category_M extends MY_Model
{
	protected $_table_name = 'categories';
	public $rules = array(
		'title' => array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'trim|required|max_length[100]|xss_clean'
		),
		'slug' => array(
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
		),
		'parent_id' => array(
			'field' => 'parent_id',
			'label' => 'Parent category',
			'rules' => 'trim|is_natural|xss_clean'
		),
		'order' => array(
			'field' => 'order',
			'label' => 'Order',
			'rules' => 'trim|required|is_natural|xss_clean'
		)
	);

	public function get_new ()
	{
		$article = new stdClass();
		$article->title = '';
		$article->slug = '';
		$article->body = '';
		$article->parent_id = 0;
		$article->order = '';
        $map = directory_map(APPPATH . 'language', 1);
        foreach($map as $lang) {
        	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
            if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
              $title = 'title_'.$lang;
              $body = 'body_'.$lang;
              $article->$title = '';
              $article->$body = '';
            }
        }
		return $article;
	}

	public function get($id = NULL, $single = FALSE, $published = FALSE, $category = NULL)
	{
		$this->db->select('categories.*, b.*');
		$this->db->join('post_meta as b', 'categories.id=b.post_id AND b.type="category"', 'left');
        $this->_primary_key = 'categories.id';
		return parent::get($id, $single);
	}

    public function get_last($limit = 5) {
        $this->db->limit($limit);
		return $this->get();
    }

}