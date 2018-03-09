      <?=(is_option('themeone_header_layout') && get_option('themeone_header_layout') != '') ? load_template('includes/header_'. get_option('themeone_header_layout')) : null?>
      <div class="main">
        <section class="module" id="about">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2 class="module-title font-alt">Welcome to ezCMS</h2>
                <div class="module-subtitle font-serif large-text">ezCMS is a PHP content management system built on codeIgniter framework with fully functionality and customization.</div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2 col-sm-offset-5">
                <div class="large-text align-center"><a class="section-scroll" href="#services"><i class="fa fa-angle-down"></i></a></div>
              </div>
            </div>
          </div>
        </section>
        <hr class="divider-w">
        <section class="module" id="services">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Our Services</h2>
                <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>
              </div>
            </div>
            <div class="row multi-columns-row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-lightbulb"></span></div>
                  <h3 class="features-title font-alt">Ideas and concepts</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-bike"></span></div>
                  <h3 class="features-title font-alt">Optimised for speed</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-tools"></span></div>
                  <h3 class="features-title font-alt">Designs &amp; interfaces</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-gears"></span></div>
                  <h3 class="features-title font-alt">Highly customizable</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-tools-2"></span></div>
                  <h3 class="features-title font-alt">Coding &amp; development</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-genius"></span></div>
                  <h3 class="features-title font-alt">Features &amp; plugins</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-mobile"></span></div>
                  <h3 class="features-title font-alt">Responsive design</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-lifesaver"></span></div>
                  <h3 class="features-title font-alt">Dedicated support</h3>
                  <p>Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.</p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="module bg-dark-60" data-background="<?php echo theme_folder('themeone'); ?>assets/images/section-6.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="video-box">
                  <div class="video-box-icon"><a class="video-pop-up" href="https://www.youtube.com/watch?v=TTxZj3DZiIM"><span class="icon-video"></span></a></div>
                  <div class="video-title font-alt">Presentation</div>
                  <div class="video-subtitle font-alt">Watch the video about our new products</div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php if(module_enable('portfolio')){ ?>
        <section class="module pb-0" id="works">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Our Works</h2>
                <div class="module-subtitle font-serif"></div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <ul class="filter font-alt" id="filters">
                  <li><a class="current wow fadeInUp" href="#" data-filter="*">All</a></li>
                <?php foreach( list_portfolio_cats() as $cat): ?>
                  <li><a class="wow fadeInUp" href="#" data-filter=".<?=cat_slug($cat)?>" data-wow-delay="0.2s"><?=cat_title($cat)?></a></li>
                <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <ul class="works-grid works-grid-gut works-grid-3 works-hover-w" id="works-grid">

            <?php foreach( list_works(6) as $work): ?>
              <li class="work-item <?=post_cat_slug($work)?>"><a href="<?=work_url($work)?>">
                <div class="work-image"><img src="<?=post_thumb($work, 'medium')?>" alt="<?=post_title($work)?>"/></div>
                <div class="work-caption font-alt">
                  <h3 class="work-title"><?=post_title($work)?></h3>
                  <div class="work-descr"><?=post_category($work)?></div>
                </div></a>
              </li>
            <?php endforeach; ?>

            </ul>
          </div>
        </section>
        <?php } ?>
        <section class="module-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-8 col-lg-6 col-lg-offset-2">
                <div class="callout-text font-alt">
                  <h3 class="callout-title">Want to see more works?</h3>
                  <p>We are always open to interesting projects.</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="callout-btn-box"><a class="btn btn-w btn-round" href="portfolio_boxed_gutter_col_3.html">Lets view portfolio</a></div>
              </div>
            </div>
          </div>
        </section>
        <section class="module" id="alt-features">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Our features</h2>
                <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-strategy"></span></div>
                  <h3 class="alt-features-title font-alt">Branding</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-tools-2"></span></div>
                  <h3 class="alt-features-title font-alt">Development</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-target"></span></div>
                  <h3 class="alt-features-title font-alt">Marketing</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-tools"></span></div>
                  <h3 class="alt-features-title font-alt">Design</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
              </div>
              <div class="col-md-6 col-lg-6 hidden-xs hidden-sm">
                <div class="alt-services-image align-center"><img src="<?php echo theme_folder('themeone'); ?>assets/images/promo.png" alt="Feature Image"></div>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-camera"></span></div>
                  <h3 class="alt-features-title font-alt">Photography</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-mobile"></span></div>
                  <h3 class="alt-features-title font-alt">Mobile</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-linegraph"></span></div>
                  <h3 class="alt-features-title font-alt">Music</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
                <div class="alt-features-item">
                  <div class="alt-features-icon"><span class="icon-basket"></span></div>
                  <h3 class="alt-features-title font-alt">Shop</h3>A wonderful serenity has taken possession of my entire soul like these sweet mornings.
                </div>
              </div>
            </div>
          </div>
        </section>
        <hr class="divider-w">
        <section class="module" id="news">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Latest blog posts</h2>
                <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>
              </div>
            </div>
            <div class="row multi-columns-row post-columns">

            <?php foreach(list_posts(3) as $post): ?>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="post mb-20">
                  <div class="post-thumbnail"><a href="<?=post_url($post)?>"><img src="<?=post_thumb($post, 'medium')?>" alt="<?=post_title($post)?>"/></a></div>
                  <div class="post-header font-alt">
                    <h2 class="post-title"><a href="<?=post_url($post)?>"><?=post_title($post)?></a></h2>
                    <div class="post-meta">By&nbsp;<a href="#"><?=post_author($post)?></a>&nbsp;| <?=post_date($post)?> | <?=count_comments($post)?> Comments
                    </div>
                  </div>
                  <div class="post-entry">
                    <p><?=post_excerpt($post, null, 20)?></p>
                  </div>
                  <div class="post-more"><a class="more-link" href="<?=post_url($post)?>">Read more</a></div>
                </div>
              </div>
            <?php endforeach; ?>

            </div>
          </div>
        </section>
        <div class="module-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-4 col-lg-offset-2">
                <div class="callout-text font-alt">
                  <h3 class="callout-title">Subscribe now</h3>
                  <p>We will not spam your email.</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="callout-btn-box">
                  <form id="subscription-form" role="form" method="post" action="php/subscribe.php">
                    <div class="input-group">
                      <input class="form-control" type="email" id="semail" name="semail" placeholder="Your Email" data-validation-required-message="Please enter your email address." required="required"/><span class="input-group-btn">
                        <button class="btn btn-g btn-round" id="subscription-form-submit" type="submit">Submit</button></span>
                    </div>
                  </form>
                  <div class="text-center" id="subscription-response"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <section class="module" id="contact">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Get in touch</h2>
                <div class="module-subtitle font-serif"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <form id="contactForm" role="form" method="post" action="php/contact.php">
                  <div class="form-group">
                    <label class="sr-only" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Your Name*" required="required" data-validation-required-message="Please enter your name."/>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Your Email*" required="required" data-validation-required-message="Please enter your email address."/>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" rows="7" id="message" name="message" placeholder="Your Message*" required="required" data-validation-required-message="Please enter your message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="text-center">
                    <button class="btn btn-block btn-round btn-d" id="cfsubmit" type="submit">Submit</button>
                  </div>
                </form>
                <div class="ajax-response font-alt" id="contactFormResponse"></div>
              </div>
            </div>
          </div>
        </section>
