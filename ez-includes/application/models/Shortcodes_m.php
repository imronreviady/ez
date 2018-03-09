<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Shortcodes_M extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
        if(is_dir($this->pref->active_theme.'/shortcodes')) {

            $map = directory_map($this->pref->active_theme.'/shortcodes', 1);
            
            print_r($map);

        }
    }

    public $content_css = array();
    public $editor_plugins = array();

    public function register_shortcode_css($links = array())
    {
	    foreach($links as $link):
	      $this->content_css[] = $link;
	    endforeach;
    }

    public function shortcode_css()
    {
    	return $this->content_css;
    } 

    public function register_editor_plugin($link = array())
    {
        $this->editor_plugins[] = $link;
    }

    public function registered_editor_plugins()
    {
        $this->register_editor_plugin('"filemanager" : "'.base_url('ez-includes').'/admin/assets/filemanager/plugin.min.js"');

        $this->register_editor_plugin('"shortcodes" : "'.base_url('ez-content').'/themes/ez/tinymce/plugin.min.js"');

        $this->register_editor_plugin('"debutshortcodes" : "'.base_url('ez-content').'/themes/debut/tinymce/plugin.min.js"');

        return $this->editor_plugins;
    } 
}