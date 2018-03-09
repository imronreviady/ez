<?php

class Posts extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{

      // Redirect unauthorized users
      if ( ! $this->authorization->is_permitted('retrieve_posts'))
      {
      $this->session->set_flashdata('access_error', ez_line('access_denied'));
        redirect($this->agent->referrer());
      }
  		// Fetch all posts
  		$data['posts'] = $this->Post_m->get();

      $data['main_content'] = 'posts/index';
      $data['page_title'] = ez_line('posts') . ' <span class="badge bg-aqua">' . count_table('posts', array('post_type' => 'post')) . '</span>';

      $this->load->ext_view('admin', 'layouts/main',$data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a post or set a new one
		if ($id) {
      // Redirect unauthorized users
      if ( ! $this->authorization->is_permitted('update_posts'))
      {
      $this->session->set_flashdata('access_error', ez_line('access_denied'));
        redirect($this->agent->referrer());
      }
			$data['post'] = $this->Post_m->get_by_id($id);
			count($data['post']) || $data['errors'][] = 'post could not be found';
            $data['page_title'] = ez_line('edit', $this->lang->line('post') );
		}
		else {
      // Redirect unauthorized users
      if ( ! $this->authorization->is_permitted('create_posts'))
      {
      $this->session->set_flashdata('access_error', ez_line('access_denied'));
        redirect($this->agent->referrer());
      }
			$data['post'] = $this->Post_m->get_new();
      $data['page_title'] = ez_line('add', $this->lang->line('post') );
		}

		// Set up the form
		$rules = $this->Post_m->rules;
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run($this) == TRUE) {

      $postArray = array(
				'title',
				'slug',
				'category_id',
				'body',
				'pubdate',
				'statue',
				'sidebar',
				'option'
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

      $oldImg = $data['post']->image;

      $data = $this->Post_m->array_from_post($postArray);

      if($id == null) {
        array_push($postArray, 'user_id', $this->session->userdata('account_id'));
      }

      if($data['statue'] != 1){ $data['statue'] = 0;}

      if($data['sidebar'] != 1){ $data['sidebar'] = 0;}
     
      if($data['option'] != '') {
          foreach($data['option'] as $k => $v):
            if($data['option'][$k]['type'] == 'checkbox') {
              if(!$data['option'][$k]['value'] or $data['option'][$k]['value'] != 1) { 
                $data['option'][$k]['value'] = 0;
              }
            }
          endforeach;
      }

      if($data['option'] != '' && is_array($data['option'])) {
          $data['option'] = base64_encode( serialize($data['option']) );
      }

      $data['post_type'] = 'post';

      foreach($map as $lang) {
      	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
            $title = 'title_'.$lang;
            $body = 'body_'.$lang;
            unset($data[$title]);
            unset($data[$body]);
          }
      }

      if($this->input->post('image') == '') {
        if($oldImg == '') {
          $img = base_url('ez-content/uploads/no-image.jpg');
        } else {
          $img = $oldImg;
        }
      } else {
        $img = $this->input->post('image');
      }

      $data['image'] = pathinfo( $img )['basename'];

      if(!empty($data['image'])) {
            $thumbnail = pathinfo( $img )['filename'] . '.' . pathinfo( $img )['extension'];
      }


    if(is_demo() == FALSE) {
      $post_id = $this->Post_m->save($data, $id);

      if(!empty($data['image'])) {
        if($id) {
            $this->Image_m->update(array('image' => $data['image'],'thumb' => $thumbnail), $id);
        } else {
            $this->Image_m->save(array('image' => $data['image'],'thumb' => $thumbnail,'post_id' => $post_id));
        }
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
                    'type' => 'post'
                );
                $new = FALSE;
                if(count($this->db->where('post_id', $post_id)->where('type', 'post')->get('post_meta')->result()) < 1) {
                  $new = TRUE;
                }
                if($new) {
                  $data = array(
                      'post_id' => $post_id,
                      $title => $title_val,
                      $body => $body_val,
                      'type' => 'post'
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
                    'type' => 'post'
                );

                if($i == 0) {
                  $data = array(
                      'post_id' => $post_id,
                      $title => $title_val,
                      $body => $body_val,
                      'type' => 'post'
                  );
                  $this->db->set($data);
                  $this->db->insert('post_meta');

                } else {
                $data = array(
                    $title => $title_val,
                    $body => $body_val,
                    'type' => 'post'
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
                    'type' => 'post'
                );
                $this->db->set($data);
                $this->db->where('post_id', $post_id);
                $this->db->update('post_meta');
          }

          } $i++;
      }

      $this->session->set_flashdata('message', ez_line('saved', $this->lang->line('post') ));
        redirect('admin/posts');

    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }


		}

        $data['categories'] = $this->Category_m->get();

        $dir = $this->session->userdata('site_lang') == 'arabic' ? 'true' : 'false';
        $data['js']   = $this->data['textarea'];
        $data['js'] .= '
        <script type="text/javascript">
          $(document).ready(function(){
              $("input[name=\"title\"]").blur(function(){
                  var Slug = $(this).val().toLowerCase();
                  $("input[name=\"slug\"]").val(Slug);
              });
          });
        </script>
        ';

        $data['main_content'] = 'posts/edit';

        $this->load->ext_view('admin', 'layouts/main',$data);
	}

    function _createThumbnail($fileName) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = './ez-content/uploads/' . $fileName;
        $config['new_image'] = './ez-content/thumbs/'. $fileName;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = 450;
        $config['height'] = 350;

        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
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
      $this->Post_m->delete_multi($id);
      $this->session->set_flashdata('message', ez_line('deleted', $this->lang->line('posts') ));
      redirect('admin/posts');
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
    if ( ! $this->authorization->is_permitted('delete_posts'))
    {
      $this->session->set_flashdata('access_error', ez_line('access_denied'));
      redirect($this->agent->referrer());
    }

    if(is_demo() == FALSE) {
  		$this->Post_m->delete($id);
      $this->session->set_flashdata('message', ez_line('deleted', $this->lang->line('post') ));
  		redirect('admin/posts');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }
	
  }

	public function publish ($id)
	{

    if(is_demo() == FALSE) {
  		$this->Post_m->save(array('statue' => '1'), $id);
      $this->session->set_flashdata('message', ez_line('published', $this->lang->line('post') ));
  		redirect('admin/posts');
    } else {
        // Set successfully flashdata
        $this->session->set_flashdata('error', 'This option not work in demo site.');

        // redirect user to referrer url
        redirect($this->agent->referrer()); 
    }

	}

	public function unpublish ($id)
	{

    if(is_demo() == FALSE) {
  		$this->Post_m->save(array('statue' => '0'), $id);
      $this->session->set_flashdata('message', ez_line('unpublished', $this->lang->line('post') ));
  		redirect('admin/posts');
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
		$this->db->where('posts.slug', $this->input->post('slug'));
    $this->db->where('posts.post_type', 'post');
		! $id || $this->db->where('posts.id !=', $id);
		$post = $this->Post_m->get();

		if (count($post)) {
			$this->form_validation->set_message('_unique_slug', 'This %s is currently used for another post.');
			return FALSE;
		}

		return TRUE;
	}

}