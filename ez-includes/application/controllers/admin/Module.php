<?php

class Module extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
    $this->load->model('Modules_m');
	}

	public function index ()
	{

      // Redirect unauthorized users
      if ( ! $this->authorization->is_permitted('retrieve_modules'))
      {
      $this->session->set_flashdata('access_error', ez_line('access_denied'));
        redirect('admin');
      }
  		// Fetch all posts
  		$data['modules'] = $this->Modules_m->get();

      $data['main_content'] = 'modules/index';
      $data['page_title'] = ez_line('modules') . ' <span class="badge bg-aqua">' . count_table('modules') . '</span>';

      $this->load->ext_view('admin', 'layouts/main',$data);
	}

  /**
   * Uninstall Module
   */
  function uninstall($module)
  {

    if(is_demo() == FALSE) {
      $path = FCPATH . 'ez-content/modules/'.$module;

      delete_files($path, true);

      if(rmdir($path)) {

        $db_module = $this->Modules_m->get_by('module_name', $module);

        $this->Modules_m->delete($db_module->id);

        // Set successfully flashdata
        $this->session->set_flashdata('message', 'Your module have been deleted.');

        // redirect user to referrer url
        redirect($this->agent->referrer());
      } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'Your module can not delete.');

        // redirect user to referrer url
        redirect($this->agent->referrer());
      }
    } else {
      // Set successfully flashdata
      $this->session->set_flashdata('error', 'This option not work in demo site.');

      // redirect user to referrer url
      redirect($this->agent->referrer()); 
    }
  }


	/**
	 * Module settings
	 */
	public function setting($id)
	{

		$data['module'] = $this->Modules_m->get($id)->module_name;
      // Set page title
      $data['page_title']   = ucfirst($data['module']) . ' ' . ez_line('settings');

      // Set view file
      $data['main_content'] = 'modules/setting';

      // Load view file with data
      $this->load->ext_view('admin', 'layouts/main',$data);

	}

    /**
     * Update theme options on database.
     */
    public function update () {

      if(is_demo() == FALSE) {
        // Loop the post data in foreach
        foreach($this->input->post() as $key => $value){
          // update current option value
          update_option($key, $value);
        }
        // Set successfully flashdata
        $this->session->set_flashdata('message', 'Your settings have been saved successfully.');
        // redirect user to referrer url
        redirect($this->agent->referrer());
      } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
      }
    }

	public function enable ($id)
	{

    if(is_demo() == FALSE) {  
  		$this->Modules_m->save(array('statue' => 'enable'), $id);
      $this->session->set_flashdata('message', ez_line('enabled', $this->lang->line('module') ));
  		redirect('admin/module');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }
	}

	public function disable ($id)
	{
    if(is_demo() == FALSE) {
  		$this->Modules_m->save(array('statue' => 'disable'), $id);
      $this->session->set_flashdata('message', ez_line('disabled', $this->lang->line('module') ));
  		redirect('admin/module');
    } else {
      // Set successfully flashdata
      $this->session->set_flashdata('error', 'This option not work in demo site.');

      // redirect user to referrer url
      redirect($this->agent->referrer()); 
    }
	}

}