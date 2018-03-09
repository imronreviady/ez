<?php

class Categories extends Admin_Controller {

    public function __construct() {
      parent::__construct();
    }

    function index()
    {
	    // Redirect unauthorized users
	    if ( ! $this->authorization->is_permitted('retrieve_cats'))
	    {
  		$this->session->set_flashdata('access_error', ez_line('access_denied'));
	      redirect($this->agent->referrer());
	    }

		$data['categories'] = $this->Category_m->get();

		$data['main_content'] = 'categories/index';
		$data['page_title'] = ez_line('categories') . ' <span class="badge bg-aqua">' . count_table('categories') . '</span>';

		$this->load->ext_view('admin', 'layouts/main',$data);
    }

	public function edit ($id = NULL)
	{
		// Fetch a page or set a new one
		if ($id) {
		    // Redirect unauthorized users
		    if ( ! $this->authorization->is_permitted('update_cats'))
		    {
			$this->session->set_flashdata('access_error', ez_line('access_denied'));
		      redirect($this->agent->referrer());
		    }
			$data['category'] = $this->Category_m->get($id);
			count($data['category']) || $data['errors'][] = 'page could not be found';
            $data['page_title'] = ez_line('edit', $this->lang->line('category') );
		}
		else {
		    // Redirect unauthorized users
		    if ( ! $this->authorization->is_permitted('create_cats'))
		    {
  			$this->session->set_flashdata('access_error', ez_line('access_denied'));
		      redirect($this->agent->referrer());
		    }
			$data['category'] = $this->Category_m->get_new();
            $data['page_title'] = ez_line('add', $this->lang->line('category') );
		}

		// Set up the form
		$rules = $this->Category_m->rules;
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run($this) == TRUE) {
	      $postArray = array(
	        'title',
	        'body',
	        'slug',
	        'parent_id',
	        'order'
	      );
	      $map = directory_map(APPPATH . 'language', 1);
	      foreach($map as $lang) {
	        $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
	          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
	            $title = 'title_'.$lang;
	            $body = 'body_'.$lang;
	            if(!empty($title) or !empty($body)) {
	              array_push($postArray, $title, $body);
	            }
	          }
	      }

	      $data = $this->Category_m->array_from_post($postArray);

	      foreach($map as $lang) {
	      	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
	          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
	            $title = 'title_'.$lang;
	            $body = 'body_'.$lang;
	            unset($data[$title]);
	            unset($data[$body]);
	          }
	      }


			if(is_demo() == FALSE) {
				$post_id = $this->Category_m->save($data, $id);
			} else {
	          // Set successfully flashdata
	          $this->session->set_flashdata('error', 'This option not work in demo site.');

	          // redirect user to referrer url
	          redirect($this->agent->referrer());
			}

	      $map = directory_map(APPPATH . 'language', 1);
	      $i = 0;
	      foreach($map as $lang) {
	        $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
	          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
	            $title = 'title_'.$lang;
	            $body = 'body_'.$lang;
	            $title_val = $this->input->post($title);
	            $body_val = $this->input->post($body);

	          if(!empty($title_val) or !empty($body_val)) {
	            if($id) {
	                $data = array(
	                    $title => $title_val,
	                    $body => $body_val,
	                    'type' => 'category'
	                );
	                $new = FALSE;
	                if(count($this->db->where('post_id', $post_id)->where('type', 'category')->get('post_meta')->result()) < 1) {
	                  $new = TRUE;
	                }
	                if($new) {
	                  $data = array(
	                      'post_id' => $post_id,
	                      $title => $title_val,
	                      $body => $body_val,
	                      'type' => 'category'
	                  );
	                  $this->db->set($data);
	                  $this->db->insert('post_meta');
	                } else {
	                  $this->db->set($data);
	                  $this->db->where('post_id', $post_id);
	                  $this->db->update('post_meta');
	                }
	            } else {
	                $data = array(
	                    'post_id' => $post_id,
	                    $title => $title_val,
	                    $body => $body_val,
	                    'type' => 'category'
	                );

	                if($i == 0) {
	                  $data = array(
	                      'post_id' => $post_id,
	                      $title => $title_val,
	                      $body => $body_val,
	                      'type' => 'category'
	                  );
	                  $this->db->set($data);
	                  $this->db->insert('post_meta');

	                } else {
	                $data = array(
	                    $title => $title_val,
	                    $body => $body_val,
	                    'type' => 'category'
	                );
	                $this->db->set($data);
	                $this->db->where('post_id', $post_id);
	                $this->db->update('post_meta');
	                }
	            }
	          } else {
	                $data = array(
	                    'post_id' => $post_id,
	                    $title => $title_val,
	                    $body => $body_val,
	                    'type' => 'category'
	                );
	                $this->db->set($data);
	                $this->db->where('post_id', $post_id);
	                $this->db->update('post_meta');
	          }

	          } $i++;
	      }

            $this->session->set_flashdata('message', ez_line('saved', $this->lang->line('category') ));
			redirect('admin/categories');
		}

        $data['main_content'] = 'categories/edit';

        $this->load->ext_view('admin', 'layouts/main',$data);
	}

	public function delete_multi ()
	{
		// Redirect unauthorized users
		if ( ! $this->authorization->is_permitted('delete_cats'))
		{
		  $this->session->set_flashdata('access_error', ez_line('access_denied'));
		  redirect($this->agent->referrer());
		}
		$id = $this->input->post('id');
		if(is_demo() == FALSE) {
			$this->Category_m->delete_multi($id);
			$this->session->set_flashdata('message', ez_line('deleted', $this->lang->line('categories') ));
			redirect('admin/categories');
		} else {
			// Set successfully flashdata
			$this->session->set_flashdata('error', 'This option not work in demo site.');

			// redirect user to referrer url
			redirect($this->agent->referrer());
		}
	}

	public function delete ($id)
	{
	    // Redirect unauthorized users
	    if ( ! $this->authorization->is_permitted('delete_cats'))
	    {
  		$this->session->set_flashdata('access_error', ez_line('access_denied'));
	      redirect($this->agent->referrer());
	    }
	    if(is_demo() == FALSE) {
			$this->Category_m->delete($id);
	        $this->session->set_flashdata('message', ez_line('deleted', $this->lang->line('category') ));
			redirect('admin/categories');
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


		$id = $this->uri->segment(4);
		$this->db->where('categories.slug', $this->input->post('slug'));
		! $id || $this->db->where('categories.id !=', $id);
		$page = $this->Category_m->get();

		if (count($page)) {
			$this->form_validation->set_message('_unique_slug', 'This %s is currently used for another category.');
			return FALSE;
		}

		return TRUE;
	}


}