<?php 
if($post->option != '') {
  $options = unserialize( base64_decode($post->option) );
} else {
  $options = array();
}

$dir = is_rtl() ? 'right' : 'left';
?>
          <div class="row">

            <!-- Form start -->
            <?=form_open_multipart()?>
            
            <div class="col-md-9 col-sm-12">
              <div class="box">
                <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1"><?=ez_line('title')?></label>
                      <?php echo form_input('title', set_value('title', $post->title), array('class' => 'form-control', 'id' => 'titleInput')); ?>
                            <?php echo form_error('title', '<p class="text-danger">', '</p>'); ?>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                      <label for="exampleInputPassword1"><?=ez_line('slug')?></label>
                      <?php echo form_input('slug', set_value('slug', $post->slug), array('class' => 'form-control', 'id' => 'slugInput')); ?>
                            <?php echo form_error('slug', '<p class="text-danger">', '</p>'); ?>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                      <label><?=ez_line('body')?></label>
                      <?php echo form_textarea('body', set_value('body', $post->body, FALSE), array('class' => 'tinymce form-control body', 'id' => 'body')); ?>
                      <?php echo form_error('body', '<p class="text-danger">', '</p>'); ?> 
                  </div><!-- /.form-group -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- post translation -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=ez_line('post_translate')?></h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <?php
                      $map = directory_map(APPPATH . 'language', 1);
                      $d = 0;
                      foreach($map as $lang) {
                      $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
                        if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') { ?>
                    <li <?php if($d == 0){echo ' class="active"';}?>><a data-toggle="tab" href="#<?=$lang?>"><?=$lang?></a></li>
                    
                    <?php
                        }
                        $d++;
                      }
                    ?>
                  </ul>

                  <div class="tab-content">

                <?php
                  $map = directory_map(APPPATH . 'language', 1);
                  $c = 0;
                  foreach($map as $lang) {
                  $lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
                    if(is_dir(APPPATH . 'language/'.$lang) and $lang != 'english') {
                    $title = 'title_'.$lang;
                    $body = 'body_'.$lang;
                    ?>
                    <div id="<?=$lang?>" class="tab-pane fade in <?php if($c == 0) {echo ' active';}?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?=ez_line('title')?></label>
                            <?php echo form_input($title, set_value($title, $post->$title), array('class' => 'form-control')); ?>
                                  <?php echo form_error($title, '<p class="text-danger">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label><?=ez_line('body')?></label>
                            <?php echo form_textarea($body, set_value($body, $post->$body, FALSE), array('class' => 'form-control tinymce', 'id' => 'body')); ?>
                            <?php echo form_error($body, '<p class="text-danger">', '</p>'); ?>
                        </div>
                    </div>
                <?php
                    $c++;
                    }
                  }
                ?>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col-md8 -->

            <div class="col-md-3 col-sm-12">

              <!-- Save button -->
              <div class="box box-success">
                <div class="box-body">
                  <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> <?=ez_line('save')?></button>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- Post settings -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=ez_line('settings', 'Post')?></h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <div class="box-body">
                    
                  <div class="form-group">
                      <label for="exampleInputEmail1"><?=ez_line('publication_date')?></label>
                      <?php echo form_input('pubdate', set_value('pubdate', $post->pubdate), array('class' => 'form-control date-picker')); ?>
                      <i class="fa fa-calendar"></i>
                      <?php echo form_error('pubdate', '<p class="text-danger">', '</p>'); ?>
                  </div><!-- /.form-group -->

                  <div class="form-group">
                      <div class="ios-switch switch-md">
                          <label style="padding-left: 0;">
                          <span class="check-label"><?=ez_line('publish')?>&nbsp;</span>
                          <input type="checkbox" class="js-switch" name="statue" value="1" <?php if($post->statue == 1){ echo 'checked';}?>>
                          </label>
                      </div>
                  </div><!-- /.form-group -->
                  
                  <div class="form-group">
                      <div class="ios-switch switch-md">
                          <label style="padding-left: 0;">
                          <span class="check-label"><?=ez_line('sidebar')?>&nbsp;</span>
                          <input type="checkbox" class="js-switch" name="sidebar" value="1" <?php if($post->sidebar == 1){ echo 'checked';}?>>
                          </label>
                      </div>
                  </div><!-- /.form-group -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->              

              <!-- category -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=ez_line('category')?></h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <div class="box-body">
                  <div class="form-group">
                    <select name="category_id" class="form-control" dir="<?=$dir?>" >
                      <option value=""><?=ez_line('select_category')?></option>
                    <?php foreach(list_portfolio_cats() as $category): ?>
                      <option value="<?php echo $category->id; ?>"<?php if($post->category_id == $category->id){echo 'selected="selected"';}?>><?php echo $category->title; ?></option>
                    <?php endforeach; ?>
                    </select>
                    <?php echo form_error('category_id', '<p class="text-danger">', '</p>'); ?>
                  </div><!-- /.form-group -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- Post image -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=ez_line('post_image')?></h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <div class="box-body">
                  <?php if($this->uri->segment(4)){ ?>

                  <h4><?=ez_line('current_image')?></h4>
                  <img src="<?php echo base_url(); ?>ez-content/uploads/<?php echo $post->image; ?>" class="img-responsive" alt="<?php echo $post->title; ?>" />
                  <hr>
                  <?php } ?>

                  <div class="form-group">
                      <div class="input-group input-group-sm">
                        <input class="form-control iframe-btn" placeholder="<?=$this->uri->segment(4) ? ez_line('change_image') : ez_line('select_image')?>" type="text" name="image" id="image">
                        <span class="input-group-btn">
                          <a href="#" class="btn btn-danger delete_media" id="image" data-toggle="tooltip" data-title="remove" type="button"><i class="fa fa-trash"></i></a>
                          <a href="<?=base_url()?>ez-includes/admin/assets/filemanager/dialog.php?type=1&field_id=image" class="btn btn-success iframe-btn" data-toggle="tooltip" data-title="<?=ez_line('select_image')?>" type="button"><i class="fa fa-folder-open"></i></a>
                        </span>
                      </div>
                      <div id="image_preview" class="thumbnail" style="margin-top: 10px; display: none">
                        <img src="" class="img-responsive">
                      </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- Custom options -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=ez_line('cust_options')?></h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->

                <div class="box-body">
                  <div id="postOptions">
                  <?php
                      $theme_options = config_item('templates_path').$this->pref->active_theme.'/theme_options/post_options.php';

                      if(!isset($options['details'])) {
                        echo admin_post_option('details', 'Project details', 'textarea');
                      }

                      if(!isset($options['client'])) {
                        echo admin_post_option('client', 'Client name', 'text');
                      }

                      if(!isset($options['online'])) {
                        echo admin_post_option('online', 'Online link', 'text');
                      }

                      $i = 0;
                      foreach($options as $key => $option):
                        switch($option['type']) {
                          case 'text':
                          case 'email':
                            $optionType = '<div class="optionPlace form-group"><label for="' . $key . '">' . $option['title'] . '</label><input type="' . $option['type'] . '" id="' . $key . '" name="option[' . $key . '][value]" value="' . $option['value'] . '" class="form-control"/><input type="hidden" name="option[' . $key . '][type]" value="' . $option['type'] . '" class="form-control"/><input type="hidden" name="option[' . $key . '][title]" value="' . $option['title'] . '" class="form-control"/></div>';
                          break;
                          case 'checkbox':
                            $checked = (post_option($key, $post) == 1) ? 'checked' : null;
                            $optionType = '<div class="form-group"><div class="ios-switch switch-md"><label style="padding-left: 0;"><span class="check-label">' . $option['title'] . '&nbsp;</span><input type="checkbox" class="js-switch" name="option[' . $key . '][value]" value="1" '.$checked.'></label></div><input type="hidden" name="option[' . $key . '][type]" value="' . $option['type'] . '" class="form-control"/><input type="hidden" name="option[' . $key . '][title]" value="' . $option['title'] . '" class="form-control"/></div>';
                          break;
                          case 'datepicker':
                            $optionType = '<div class="optionPlace form-group"><label for="' . $option['title'] . '">' . $option['title'] . '</label><input type="text" id="' . $option['title'] . '" name="option[' . $key . '][value]" value="' . $option['value'] . '" class="form-control date-picker"/><i class="fa fa-calendar"></i><input type="hidden" name="option[' . $key . '][type]" value="' . $option['type'] . '" class="form-control"/><input type="hidden" name="option[' . $key . '][title]" value="' . $option['title'] . '" class="form-control"/></div>';
                          break;
                          case 'textarea':
                            $optionType = '<div class="optionPlace form-group"><label for="' . $option['title'] . '">' . $option['title'] . '</label><textarea id="' . $option['title'] . '" name="option[' . $key . '][value]" class="form-control simple">' . $option['value'] . '</textarea><input type="hidden" id="' . $option['title'] . '" name="option[' . $key . '][type]" value="' . $option['type'] . '" class="form-control"/><input type="hidden" id="' . $option['title'] . '" name="option[' . $key . '][title]" value="' . $option['title'] . '" class="form-control"/></div>';
                          break;
                        };
                    
                          $string = $optionType;
                          ++$i;
                          
                          echo $string;
                      endforeach;
                  ?>
                  </div>
                  <hr>
                  <div class="form-group">
                      <input type="text" name="optionName" placeholder="field name" class="form-control" id="optionName">
                  </div>
                  <div class="form-group">
                      <input type="text" name="optionTitle" placeholder="field title" class="form-control" id="optionTitle">
                  </div>
                  <div class="form-group">
                      <select name="optionType" class="form-control" id="optionType" dir="<?=$dir?>">
                      <option value="">Select type</option>
                      <option value="text">Text</option>
                      <option value="textarea">Textarea</option>
                      <option value="email">Email</option>
                      <option value="checkbox">Checkbox</option>
                      <option value="datepicker">Datepicker</option>
                      </select>
                  </div>
                  <button type="button" name="addOption" class="btn btn-block btn-primary" id="addOption">Add Option</button>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              

            </div><!-- /.col-md-4 -->

            <!-- Form close -->
            <?=form_close()?>

          </div><!-- /.row -->