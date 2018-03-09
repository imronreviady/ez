      <div class="main">
        <section class="module bg-dark-60 blog-page-header" data-background="<?=theme_folder('themeone')?>assets/images/blog_bg.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt"><?=cat_title($category)?></h2>
                <div class="module-subtitle font-serif"><?=get_option('themeone_category_text')?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
            <div class="row">

              <?php get_option('themeone_category_layout') == 'classic-left' ? load_template('includes/sidebar') : NULL; ?>                                 
              <div class="col-sm-<?=in_array(get_option('themeone_category_layout'), array('2cols-sidebar', '3cols-sidebar', 'classic-right', 'classic-left')) ? '8' : '12'?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row multi-columns-row post-columns">
                    <?php foreach($posts as $post):

                      $template = get_option('themeone_category_layout');

                      load_template('includes/'.$template, array('post' => $post));

                    endforeach; 
                    ?>

                    </div>
                  </div>
                </div>

                <div class="pagination font-alt">
                  <?=$this->pagination->create_links();?>
                </div>

              </div>

              <?php in_array(get_option('themeone_category_layout'), array('2cols-sidebar', '3cols-sidebar', 'classic-right')) ? load_template('includes/sidebar') : NULL; ?>

            </div>
          </div>
        </section>


