<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

    public function __construct()
    {
        parent::__construct();

    }

    public function view($view, $vars = array(), $return = FALSE)
    {

      $CI =& get_instance();
      $CI->load->model('Prefs');
      if( !file_exists(VIEWPATH . $view . '.php') ) {
        $view = ltrim($view, $this->pref->active_theme);
        $view = 'ez' . $view;
        $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
        $view = str_replace('\\', DIRECTORY_SEPARATOR, $view);
      }
      $view = str_replace('\\\\', DIRECTORY_SEPARATOR, $view);
      return parent::view($view, $vars, $return);
    }

    function module_view($folder, $view, $vars = array(), $return = FALSE) {
      if(file_exists(FCPATH.'ez-content/modules/'.$folder.'/'.$view.'.php')) { 
        $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(FCPATH.'ez-content/modules/'.$folder.'/' => TRUE));
      } else {
        $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(FCPATH.'ez-content/'.$folder.'/' => TRUE));
      }
      return $this->_ci_load(array(
              '_ci_view' => $view,
              '_ci_vars' => $this->_ci_object_to_array($vars),
              '_ci_return' => $return
          ));
    }
    
    function ext_view($folder, $view, $vars = array(), $return = FALSE) {
      if(file_exists(FCPATH.'ez-includes/'.$folder.'/'.$view.'.php')) { 
        $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(FCPATH.'ez-includes/'.$folder.'/' => TRUE));
      } else {
        $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(FCPATH.'ez-content/'.$folder.'/' => TRUE));
      }
      return $this->_ci_load(array(
              '_ci_view' => $view,
              '_ci_vars' => $this->_ci_object_to_array($vars),
              '_ci_return' => $return
          ));
    }
    
}