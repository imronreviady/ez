<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

  <div class="row">
    <?php echo form_open();?>
    <div class="col-md-12">

      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#english" data-toggle="tab">English</a></li>
          <?php
            $map = directory_map(APPPATH . 'language', 1);
            $d = 0;
            foreach($map as $lang) {
            $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
              if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') { ?>
          <li><a data-toggle="tab" href="#<?=$lang?>"><?=$lang?></a></li>
          
          <?php
              }
              $d++;
            }
          ?>
        </ul>

        <div class="tab-content">
          <div id="english" class="tab-pane fade in active">
            <div class="form-group" style="margin-right: 0; margin-left: 0">
              <?php
              echo form_label(ez_line('title'),'title');
              echo form_input('title',set_value('title',$category->title),'class="form-control"');
              echo form_error('title', '<p class="text-danger">', '</p>');
              ?>
            </div>
            <div class="form-group" style="margin-right: 0; margin-left: 0">
                <label><?=ez_line('body')?></label>
                <?php echo form_textarea('body', set_value('body', $category->body, FALSE), array('class' => 'form-control tinymce', 'id' => 'body')); ?>
                <?php echo form_error('body', '<p class="text-danger">', '</p>'); ?>
            </div>
          </div>
      <?php
        $map = directory_map(APPPATH . 'language', 1);
        $c = 0;
        foreach($map as $lang) {
        $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
          if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
          $title = 'title_'.$lang;
          $body = 'body_'.$lang;
          ?>
          <div id="<?=$lang?>" class="tab-pane fade">
              <div class="form-group" style="margin-right: 0; margin-left: 0">
                  <label for="exampleInputEmail1"><?=ez_line('title')?></label>
                  <?php echo form_input($title, set_value($title, $category->$title), array('class' => 'form-control')); ?>
                        <?php echo form_error($title, '<p class="text-danger">', '</p>'); ?>
              </div>
              <div class="form-group" style="margin-right: 0; margin-left: 0">
                  <label><?=ez_line('body')?></label>
                  <?php echo form_textarea($body, set_value($body, $category->$body, FALSE), array('class' => 'form-control tinymce', 'id' => 'body')); ?>
                  <?php echo form_error($body, '<p class="text-danger">', '</p>'); ?>
              </div>
          </div>
      <?php
          $c++;
          }
        }
      ?>
        </div>
      </div>

        <div class="form-group">
          <?php
          echo form_label(ez_line('slug'),'slug');
          echo form_input('slug',set_value('slug',$category->slug),'class="form-control"');
          echo form_error('slug', '<p class="text-danger">', '</p>');
          ?>
        </div>

        <div class="form-group">

          <?php
          $list = array(0 => 'No parent');
          foreach (list_cats() as $option):
            if($option->parent_id == 0 and $option->id != @$this->uri->segment(4)) {
              $list[$option->id] = $option->title;
            }
          endforeach;

          echo form_label('Parent','parent_id');
          echo form_dropdown('parent_id', $list, $category->parent_id);
          echo form_error('parent_id', '<p class="text-danger">', '</p>');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label(ez_line('order'),'order');
          echo form_input('order',set_value('order',$category->order),'class="form-control"');
          echo form_error('order', '<p class="text-danger">', '</p>');
          ?>
        </div>
        <?php echo form_submit('submit', ez_line('save'), 'class="btn btn-primary btn-lg"');?>
    </div>
    <?php echo form_close();?>
  </div>