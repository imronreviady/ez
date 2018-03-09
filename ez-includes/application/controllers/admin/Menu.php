<?php

class Menu extends Admin_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->model('Menu_model');
      $this->load->model('Menu_items_m');
    }

    function index()
    {
      $data['menus']        = $this->Menu_model->get();
      // Set page title
      $data['page_title']   = 'Menus';

      // Set view file
      $data['main_content'] = 'apperance/menu';

      // Load view file with data
      $this->load->ext_view('admin', 'layouts/main',$data);
    }

  public function edit ($id = NULL)
  {

    $data['sortable'] = TRUE;
    // Fetch a page or set a new one
    if ($id) {
      $data['menu'] = $this->Menu_model->get($id);
      // Fetch all items
      $data['items'] = $this->Menu_items_m->get_nested(FALSE, $id);
      count($data['menu']) || $data['errors'][] = 'page could not be found';
      $data['page_title'] = ez_line('edit', $this->lang->line('menu') );
    }
    else {
      $data['menu'] = $this->Menu_model->get_new();
      $data['page_title'] = ez_line('add', $this->lang->line('menu') );
    }

    // Set up the form
    $rules = $this->Menu_model->rules;
    $this->form_validation->set_rules($rules);

    // Process the form
    if ($this->form_validation->run($this) == TRUE) {
      $data = $this->Menu_model->array_from_post(array(
        'title',
        'alias',
        'st_tag',
        'en_tag',
        'item_st_tag',
        'item_en_tag',
        'sub_st_tag',
        'sub_en_tag',
        'active_class',
        'has_sub_class'
      ));

      if(is_demo() == FALSE) {
        $this->Menu_model->save($data, $id);
        $this->session->set_flashdata('message', ez_line('saved', $this->lang->line('menu') ));
        redirect('admin/menu');
      } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
      }
    }

        $data['main_content'] = 'apperance/edit_menu';

        $this->load->ext_view('admin', 'layouts/main',$data);
  }

  public function order_ajax ($menu_id = null)
  {
    // Save order from ajax call
    if (isset($_POST['sortable'])) {
      /*
      echo '<pre>';
      var_dump($_POST['sortable']);
      echo '</pre>';
      exit();
      */
      if(is_demo() == FALSE) {
        $this->Menu_items_m->save_order($_POST['sortable']);
      }
    }

    // Fetch all pages
    $data['items'] = $this->Menu_items_m->get_nested(FALSE, $menu_id);

    $data = $this->load->ext_view('admin', 'apperance/menu_items', $data, TRUE);

    return $this->output->set_output($data);
  }

  public function delete($id)
  {
    if(is_demo() == FALSE) {
      return $this->Menu_model->delete($id);
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }
  }

  public function delete_multi ()
  {
    // Redirect unauthorized users
    if ( ! $this->authorization->is_permitted('delete_posts'))
    {
      $this->session->set_flashdata('access_error', ez_line('access_denied'));
      redirect($this->agent->referrer());
    }
    $id = $this->input->post('id');

    if(is_demo() == FALSE) {
      $this->Menu_model->delete_multi($id);
      $this->session->set_flashdata('message', ez_line('deleted', $this->lang->line('menu') ));
      redirect('admin/menu');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

  }

  function list_items($type)
  {
    switch ($type) {
      case 'post':
        $items = list_posts(null, 0, null);
        break;
      case 'page':
        $items = list_pages();
        break;
      case 'category':
        $items = list_cats();
        break;
    }

    return $this->output
    ->set_content_type("application/json")
    ->set_output(json_encode($items));

  }  

  function add_item()
  {
    $title = $this->input->post('title');
    $link  = $this->input->post('link');
    $type  = $this->input->post('type');
    $item_id  = $this->input->post('item_id');
    $menu_id  = $this->input->post('menu_id');

    $data = array(
            'title' => $title,
            'link' => $link,
            'type' => $type,
            'item_id' => $item_id,
            'menu_id' => $menu_id,
            'parent_id' => 0
    );

    if(is_demo() == FALSE) {
      $this->db->insert('menu_items', $data);
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

    // Fetch all pages
    $data['items'] = $this->Menu_items_m->get_nested(FALSE);

    $data = $this->load->ext_view('admin', 'apperance/menu_items', $data, TRUE);

    return $this->output->set_output($data);
  }  
  

  function delete_item()
  {
    $id = $this->input->post('id');

    if(is_demo() == FALSE) {    
      $this->Menu_items_m->delete($id);
    } else {
      // Set successfully flashdata
      $this->session->set_flashdata('error', 'This option not work in demo site.');

      // redirect user to referrer url
      redirect($this->agent->referrer()); 
    }
    return true;
  }

  function edit_modal($id)
  {

    $data['item'] = $this->Menu_items_m->get($id);

    $data =  $this->load->ext_view('admin', 'apperance/edit_modal', $data, TRUE);

    return $this->output->set_output($data);

  }

  function edit_item($id)
  {

    $data['title']    = $this->input->post('title');
    $data['link']     = $this->input->post('link');
    $data['item_id']  = $this->input->post('item_id');
    $data['type']     = $this->input->post('type');

    if(is_demo() == FALSE) {
      $this->Menu_items_m->save($data, $id);
      redirect($this->agent->referrer());
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }


  }

  public function _unique_slug ($str)
  {
    // Do NOT validate if slug already exists
    // UNLESS it's the slug for the current page


    $id = $this->uri->segment(5);
    $this->db->where('alias', $this->input->post('alias'));
    ! $id || $this->db->where('id !=', $id);
    $menu = $this->Menu_model->get();

    if (count($menu)) {
      $this->form_validation->set_message('_unique_slug', 'This %s is currently used for another post.');
      return FALSE;
    }

    return TRUE;
  }

}