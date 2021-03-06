<?php

$CI =& get_instance();
$CI->load->library('Shortcode');

  /*--------------------------------------------------------------------------------------
    *
    * debut_icon_box
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  /*
  if( ! function_exists( 'debut_icon_box' ))
  {
    function debut_icon_box($atts, $content = null) {
      extract(shortcode_att(array(
        "title" => 'Icon box',
        "text" => 'Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea saperet inimicu ut qui dolor oratio mnesarchum.',
        "icon" => 'home',
        "button_text" => 'Read more',
        "button" => '#'
      ), $atts));

      $return  = '
      <div class="span4 col-xs-12 block">';
      $return .= '
        <div class="span2 col-xs-2"><i class="fa fa-'.$icon.' feature_icon"></i></div>';
      $return .= '
        <div class="span10 col-xs-10">';
      $return .= '
          <h4>'.$title.'</h4>';
      $return .= '
          <p>'.$text.'</p>';
      $return .= '
          <a href="'.$button.'" class="readmore">'.$button_text.' <i class="fa fa-caret-right"></i></a>';
      $return .= '
        </div>';      
      $return .= '
      </div>';
      return $return;
    }
  }
  */


/* ---------------------------------------------------------------------------
 * Contact form
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'contact_box' ))
{
  function contact_box()
  {
    $str = contact_form();
    return $str;    
  }
}

/* ---------------------------------------------------------------------------
 * Slider
 * --------------------------------------------------------------------------- */
if( ! function_exists( 'nova_slider' ) )
{
	function nova_slider( $attr, $content = null )
	{
		extract(shortcode_att(array(
			'alias' 	=> '',
			'control' 	=> FALSE
		), $attr));

    $autoplay = is_numeric(slider_option($alias, 'autoplay')) ? true : false;
    $interval  = is_numeric(slider_option($alias, 'autoplay')) ? floor(slider_option(get_option('home_slider'), 'autoplay') * 1000) : 2000;

    $output = '';

    $output .= '
      <section class="home-section home-parallax home-fade home-full-height" id="home">
        <div class="hero-slider">
          <ul class="slides">';

    foreach(  get_slider( $alias ) as $slide):
    $output .= '
            <li class="bg-dark-30 bg-dark" style="background-image:url('.slide_background($slide).');">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-20 titan-title-size-3">'.slide_title($slide).'</div>
                  <div class="font-alt mb-40 titan-title-size-1" style="max-width: 65%; margin: auto; text-align: center">'.slide_text($slide, 20).'</div>
                  <a class="section-scroll btn btn-border-w btn-round" href="'.slide_button($slide).'">'.slide_button_text($slide).'</a>
                </div>
              </div>
            </li>';
    endforeach;

    $output .= '
          </ul>
        </div>
      </section>';

	    return $output;
	}
}

  /*--------------------------------------------------------------------------------------
    *
    * nova_latestworks
    *
    * @author Ead Hassan
    * @since 1.0
    * //DW mod added xclass var
    *-------------------------------------------------------------------------------------*/
    function themeone_latestworks($atts, $content = null) {
      extract(shortcode_att(array(
        "limit" => 6,
        "offset" => '',
        "category" => '',
        "layout" => ''
      ), $atts));

      $output = '';
      $x = 1;
      $CI =& get_instance();
      $CI->load->helper('portfolio/portfolio');

      $output .='
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <ul class="filter font-alt" id="filters">
                  <li><a class="current wow fadeInUp" href="#" data-filter="*">All</a></li>';
      foreach( list_portfolio_cats() as $cat):
      $output .= '
                  <li><a class="wow fadeInUp" href="#" data-filter=".'.cat_slug($cat).'" data-wow-delay="0.6s">'.cat_title($cat).'</a></li>';
      endforeach;
      $output .= '
                </ul>
              </div>
            </div>
            <ul class="works-grid works-grid-gut works-grid-3 works-hover-w" id="works-grid">';

      foreach( list_works($limit) as $work):
          $output .='
              <li class="work-item '.post_cat_slug($work).'">
                <a href="'.work_url($work).'">
                  <div class="work-image"><img src="'.post_thumb($work, 'medium').'" alt="'.post_title($work).'"/></div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">'.post_title($work).'</h3>
                    <div class="work-descr">'.post_category($work).'</div>
                  </div>
                </a>
              </li>';        
      $x++; endforeach;

      $output .= '
            </ul>
          </div>';
    
      return $output;
    }
  
  /*--------------------------------------------------------------------------------------
    *
    * bs_button
    *
    * @author Ead Hassan
    * @since 1.0
    * //DW mod added xclass var
    *-------------------------------------------------------------------------------------*/
  function bs_button($atts, $content = null) {
     extract(shortcode_att(array(
        "type" => false,
        "size" => false,
        "link" => '',
        "target" => false,
        "xclass" => false,
        "title" => false,
        "data" => false
     ), $atts));
     $data_props = '';
      if($data) { 
          $data = explode('|',$data);
          foreach($data as $d):
            $d = explode(',',$d);    
                $data_props .= 'data-'.$d[0]. '="'.$d[1].'" ';
          endforeach;
      }
     $return  =  '<a href="' . $link . '" class="btn';
     $return .= ($type) ? ' btn-' . $type : ' btn-default';
     $return .= ($size) ? ' btn-' . $size : '';
     $return .= ($xclass) ? ' ' . $xclass : '';
     $return .= '"';
     $return .= ($target) ? ' target=' . $target : '';
     $return .= ($title) ? ' title="' . $title . '"' : '';
     $return .= ($data_props) ? ' ' . $data_props : '';
     $return .= '>' . do_shortcode( $content ) . '</a>';
     return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_button_group
    *
    * @author Ead Hassan
    *
    *-------------------------------------------------------------------------------------*/
  function bs_button_group( $atts, $content = null ) {
     extract(shortcode_att(array(
        "size" => false,
        "vertical" => false,
        "justified" => false
     ), $atts));
      if($size) {
        $classes .= ' btn-group-'.$size;
      }
       if($vertical) {
        $classes .= ' btn-group-vertical';
      } 
       if($justified) {
        $classes .= ' btn-group-justified';
      }
    return '<div class="button-group '.$classes.'">' . do_shortcode( $content ) . '</div>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_alert
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_alert($atts, $content = null) {
    extract(shortcode_att(array(
      "type" => 'success',
      "strong" => false,
      "dismissable" => false
    ), $atts));
    $return  = '<div class="alert alert-' . $type;
    $return .= ($dismissable) ? ' alert-dismissable' : '';
    $return .= '">';
    $return .= ($dismissable) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' : '';
    $return .= ($strong) ? '<strong>'.$strong.'</strong>' : '';
    $return .= do_shortcode( $content ) . '</div>';
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_code
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_code($atts, $content = null) {
     extract(shortcode_att(array(
        "inline" => false,
        "scrollable" => false
     ), $atts));
    if($inline) {
      $return = '<code>' . $content . '</code>';
    } else {
      $return  = '<pre';
      $return .= ($scrollable) ? ' class="pre-scrollable"': '';
      $return .= '>' . do_shortcode( $content ) . '</pre>';
    }
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_row
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_row( $atts, $content = null ) {
    return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_column
    *
    * @author Ead Hassan
    * @since 1.0
    * @todo pull and offset
    *-------------------------------------------------------------------------------------*/
  function bs_column( $atts, $content = null ) {
    extract(shortcode_att(array(
      "lg" => false,
      "md" => false,
      "sm" => false,
      "xs" => false,
      "offset_lg" => false,
      "offset_md" => false,
      "offset_sm" => false,
      "offset_xs" => false,
      "pull_lg" => false,
      "pull_md" => false,
      "pull_sm" => false,
      "pull_xs" => false,
      "push_lg" => false,
      "push_md" => false,
      "push_sm" => false,
      "push_xs" => false,
    ), $atts));
    $return  =  '<div class="';
    $return .= ($lg) ? 'span' . $lg . ' ' : '';
    $return .= ($offset_lg) ? 'offset' . $offset_lg . ' ' : '';
    $return .= '">' . do_shortcode( $content ) . '</div>';
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_list_group
    *
    * @author Ead Hassan
    *
    *-------------------------------------------------------------------------------------*/
  function bs_list_group( $atts, $content = null ) {
    return '<ul class="list-group">' . do_shortcode( $content ) . '</ul>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_list_group_item
    *
    * @author Ead Hassan
    *
    *-------------------------------------------------------------------------------------*/
  function bs_list_group_item( $atts, $content = null ) {
    return '<li class="list-group-item">' . do_shortcode( $content ) . '</li>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_label
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_label( $atts, $content = null ) {
    extract(shortcode_att(array(
      "type" => 'default'
    ), $atts));
    return '<span class="label label-' . $type . '">' . do_shortcode( $content ) . '</span>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_badge
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_badge( $atts, $content = null ) {
    extract(shortcode_att(array(
      "right" => false
    ), $atts));
    $right = ($right) ? " pull-right" : "";
    return '<span class="badge' . $right . '">' . do_shortcode( $content ) . '</span>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_icon
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_icon( $atts, $content = null ) {
    extract(shortcode_att(array(
      "type" => 'type',
    ), $atts));
    return '<span class="glyphicon glyphicon-' . $type . '"></span>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * simple_table
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_table( $atts ) {
      extract( shortcode_att( array(
          'cols' => 'none',
          'data' => 'none',
          'type' => 'type'
      ), $atts ) );
      $cols = explode(',',$cols);
      $data = explode(',',$data);
      $total = count($cols);
      $output = '';
      $output .= '<table class="table table-'. $type .' table-bordered"><tr>';
      foreach($cols as $col):
          $output .= '<th>'.$col.'</th>';
      endforeach;
      $output .= '</tr><tr>';
      $counter = 1;
      foreach($data as $datum):
          $output .= '<td>'.$datum.'</td>';
          if($counter%$total==0):
              $output .= '</tr>';
          endif;
          $counter++;
      endforeach;
          $output .= '</table>';
      return $output;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_well
    *
    * @author Ead Hassan
    * @since 1.0
    *
    * Options:
    *   size: sm = small, lg = large
    *
    *-------------------------------------------------------------------------------------*/
    function bs_well( $atts, $content = null ) {
      extract(shortcode_att(array(
        "size" => false
      ), $atts));
      if($size) {
        $size = ' well-'.$size;
      }
      return '<div class="well' . $size . '">' . do_shortcode( $content ) . '</div>';
    }
  /*--------------------------------------------------------------------------------------
    *
    * bs_panel
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_panel( $atts, $content = null ) {
    extract(shortcode_att(array(
      "title" => '',
      "type" => 'default',
      "footer" => false
    ), $atts));
    if($footer) {
        $footer = '<div class="panel-footer">' . $footer . '</div>';
      }
    return '<div class="panel panel-' . $type . '"><div class="panel-heading"><h3 class="panel-title">' . $title . '</h3></div><div class="panel-body">' . do_shortcode( $content ) . '</div>' . $footer . '</div>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_tabs
    *
    * @author Ead Hassan
    * @since 1.0
    * Modified by TwItCh twitch@designweapon.com
    * Now acts a whole nav/tab/pill shortcode solution!
    *-------------------------------------------------------------------------------------*/
  function bs_tabs( $atts, $content = null ) {
    if( isset($GLOBALS['tabs_count']) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;
    $defaults = array('class' => 'nav-tabs');
    extract( shortcode_att( $defaults, $atts ) );
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    $output = '';
    if( count($tab_titles) ){
      $output .= '<ul class="nav ' . $class . '" id="custom-tabs-'. rand(1, 100) .'">';
      $i = 0;
      foreach( $tab_titles as $tab ){
        if($i == 0)
          $output .= '<li class="active">';
        else
          $output .= '<li>';
        $output .= '<a href="#custom-tab-' . $GLOBALS['tabs_count'] . '-' . $tab[0] . '"  data-toggle="tab">' . $tab[0] . '</a></li>';
        $i++;
      }
        $output .= '</ul>';
        $output .= '<div class="tab-content">';
        $output .= do_shortcode( $content );
        $output .= '</div>';
    } else {
      $output .= do_shortcode( $content );
    }
    return $output;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_tab
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_tab( $atts, $content = null ) {
    if( !isset($GLOBALS['current_tabs']) ) {
      $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
      $state = 'active';
    } else {
      if( $GLOBALS['current_tabs'] == $GLOBALS['tabs_count'] ) {
        $state = '';
      } else {
        $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
        $state = 'active';
      }
    }
    $defaults = array( 'title' => 'Tab');
    extract( shortcode_att( $defaults, $atts ) );
    return '<div id="custom-tab-' . $GLOBALS['tabs_count'] . '-'. $title .'" class="tab-pane ' . $state . '">'. do_shortcode( $content ) .'</div>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_collapsibles
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_collapsibles( $atts, $content = null ) {
    if( isset($GLOBALS['collapsibles_count']) )
      $GLOBALS['collapsibles_count']++;
    else
      $GLOBALS['collapsibles_count'] = 0;
    $defaults = array();
    extract( shortcode_att( $defaults, $atts ) );
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/collapse title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    $output = '';
    if( count($tab_titles) ){
      $output .= '<div class="panel-group" id="accordion-' . $GLOBALS['collapsibles_count'] . '">';
      $output .= do_shortcode( $content );
      $output .= '</div>';
    } else {
      $output .= do_shortcode( $content );
    }
    return $output;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_collapse
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_collapse( $atts, $content = null ) {
    if( !isset($GLOBALS['current_collapse']) )
      $GLOBALS['current_collapse'] = 0;
    else
      $GLOBALS['current_collapse']++;
    extract(shortcode_att(array(
      "title" => '',
      "state" => false
    ), $atts));
    if ($state == "active")
      $state = 'in';
    return '<div class="panel"><div class="panel-heading"><h3 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' . $GLOBALS['collapsibles_count'] . '" href="#collapse_' . $GLOBALS['current_collapse'] . '_'. $title .'">' . $title . '</a></h3></div><div id="collapse_' . $GLOBALS['current_collapse'] . '_'. $title .'" class="panel-collapse collapse ' . $state . '"><div class="panel-body">' . do_shortcode($content) . ' </div></div></div>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_tooltip
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
function bs_tooltip( $atts, $content = null ) {
    $defaults = array(
	   'title' => '',
	   'placement' => 'top',
	   'animation' => 'true',
	   'html' => 'false'
    );
    extract( shortcode_att( $defaults, $atts ) );
    $classes = 'bs-tooltip';    
    $dom = new DOMDocument;
    $dom->loadXML($content);
    if(!$dom->documentElement) {
        $element = $dom->createElement('span', $content);
        $dom->appendChild($element);
    }
    $dom->documentElement->setAttribute('class', $dom->documentElement->getAttribute('class') . ' ' . $classes);
    $dom->documentElement->setAttribute('title', $title );
    if($animation) { $dom->documentElement->setAttribute('data-animation', $animation ); }
    if($placement) { $dom->documentElement->setAttribute('data-placement', $placement ); }
    if($html) { $dom->documentElement->setAttribute('data-html', $html ); }
    $return = $dom->saveXML();
    
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_popover
    *
    *
    *-------------------------------------------------------------------------------------*/
function bs_popover( $atts, $content = null ) {
    $defaults = array(
	   'title' => false,
        'content' => '',
	   'placement' => 'top',
	   'animation' => 'true',
	   'html' => 'false'
    );
    extract( shortcode_att( $defaults, $atts ) );
    $classes = 'bs-popover';
    
    $dom = new DOMDocument;
    $dom->loadXML($content);
    if(!$dom->documentElement) {
        $element = $dom->createElement('span', $content);
        $dom->appendChild($element);
    }
    $dom->documentElement->setAttribute('class', $dom->documentElement->getAttribute('class') . ' ' . $classes);
    if($title) { $dom->documentElement->setAttribute('data-original-title', $title ); }
    $dom->documentElement->setAttribute('data-content', $content );
    if($animation) { $dom->documentElement->setAttribute('data-animation', $animation ); }
    if($placement) { $dom->documentElement->setAttribute('data-placement', $placement ); }
    if($html) { $dom->documentElement->setAttribute('data-html', $html ); }
    $return = $dom->saveXML();
    
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_media
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
    
function bs_media( $atts, $content = null ) {
    
    $defaults = array(
	   'title' => false,
    );
    extract( shortcode_att( $defaults, $atts ) );
    return '<div class="media">' . do_shortcode( $content ) . '</div>';
  }
function bs_media_object( $atts, $content = null ) {
    $defaults = array(
	   'pull' => "left",
    );
    extract( shortcode_att( $defaults, $atts ) );
    
    $classes = "media-object";
    $dom = new DOMDocument;
    $dom->loadXML($content);
    $dom->documentElement->setAttribute('class', $dom->documentElement->getAttribute('class') . ' ' . $classes);
    $return = $dom->saveXML();
    $return = '<span class="pull-'. $pull . '">' . $return . '</span>';
    return $return;
  }
function bs_media_body( $atts, $content = null ) {
    
    $defaults = array(
	   'title' => false,
    );
    extract( shortcode_att( $defaults, $atts ) );
    $return .= '<div class="media-body">';
    $return .= ($title) ? '<h4 class="media-heading">' . $title . '</h4>' : '';
    $return .= $content . '</div>';
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_jumbotron
    *
    *
    *-------------------------------------------------------------------------------------*/
  function bs_jumbotron( $atts, $content = null ) {
    extract(shortcode_att(array(
      "title" => false
    ), $atts));
    $return .='<div class="jumbotron">';
    $return .= ($title) ? '<h1>' . $title . '</h1>' : '';
    $return .= do_shortcode( $content ) . '</div>';
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_lead
    *
    *
    *-------------------------------------------------------------------------------------*/
  function bs_lead( $atts, $content = null ) {
    return '<p class="lead">' . do_shortcode( $content ) . '</p>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_emphasis
    *
    *
    *-------------------------------------------------------------------------------------*/
  function bs_emphasis( $atts, $content = null ) {
    extract(shortcode_att(array(
      "type" => 'muted'
    ), $atts));
    return '<p class="text-' . $type . '">' . do_shortcode( $content ) . '</p>';
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_thumbnail
    *
    *
    *-------------------------------------------------------------------------------------*/
  function bs_thumbnail( $atts, $content = null ) {
    $classes = "thumbnail";
    $dom = new DOMDocument;
    $dom->loadXML($content);
    if(!$dom->documentElement) {
        $element = $dom->createElement('div', $content);
        $dom->appendChild($element);
    }
    $dom->documentElement->setAttribute('class', $dom->documentElement->getAttribute('class') . ' ' . $classes);
    $return = $dom->saveXML();
    
    return $return;
  }
    
    /*--------------------------------------------------------------------------------------
    *
    * bs_responsive
    *
    *
    *-------------------------------------------------------------------------------------*/
  function bs_responsive( $atts, $content = null ) {
      extract( shortcode_att( array(
          'visible' => '',
          'hidden' => '',
      ), $atts ) );
      if($visible) { 
          $visible = explode(' ',$visible);
          foreach($visible as $v):
            $classes .= 'visible-'.$v.' ';
          endforeach;
      }
      if($hidden) { 
          $hidden = explode(' ',$hidden);
          foreach($hidden as $h):
            $classes .= 'hidden-'.$h.' ';
          endforeach;
      }
    $dom = new DOMDocument;
    $dom->loadXML($content);
    if(!$dom->documentElement) {
        $element = $dom->createElement('p', $content);
        $dom->appendChild($element);
    }
    $dom->documentElement->setAttribute('class', $dom->documentElement->getAttribute('class') . ' ' . $classes);
    $return = $dom->saveXML();
    
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_modal
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_modal( $atts, $content = null ) {
    extract(shortcode_att(array(
      "text" => '',
      "title" => '',
      "xclass" => ''
    ), $atts));
    $sani_title = 'modal'. strtolower($title);
    $return ='<a data-toggle="modal" href="#'. $sani_title .'" class="'. $xclass .'">'. $text .'</a>';
    $return .='<div class="modal fade" id="'. $sani_title .'" tabindex="-1" role="dialog" aria-hidden="true">';
    $return .='<div class="modal-dialog">';
    $return .='<div class="modal-content">';
    $return .='<div class="modal-header">';
    $return .='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    $return .='<h4 class="modal-title">'. $title .'</h4>';
    $return .='</div>';
    $return .='<div class="modal-body">';
    $return .= do_shortcode($content);
    $return .='</div>';
    $return .='</div><!-- /.modal-content -->';
    $return .='</div><!-- /.modal-dialog -->';
    $return .='</div><!-- /.modal -->';  
    return $return;
  }
  /*--------------------------------------------------------------------------------------
    *
    * bs_modal_footer
    *
    * @author Ead Hassan
    * @since 1.0
    *
    *-------------------------------------------------------------------------------------*/
  function bs_modal_footer( $atts, $content = null ) {
    return '<div class="modal-footer">' . do_shortcode( $content ) . '</div>';
  }

  if( ! function_exists('latest_posts') ) {
    function latest_posts( $atts, $content = null )
    {
      extract(shortcode_att(array(
        "limit" => '',
        "offset" => '',
        "category" => '',
        "layout" => ''
      ), $atts));

      $CI =& get_instance();

      $limit    = !empty($limit) ? $limit : null;
      $offset   = !empty($offset) ? $offset : 0;
      $category = !empty($category) ? $category : null;

      $str = '';

      foreach (list_posts($limit, $offset, $category) as $post) {
        $str .= '
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="post mb-20">
                  <div class="post-thumbnail"><a href="'.post_url($post).'"><img src="'.post_thumb($post, 'medium').'" alt="'.post_title($post).'"/></a></div>
                  <div class="post-header font-alt">
                    <h2 class="post-title"><a href="'.post_url($post).'">'.post_title($post).'</a></h2>
                    <div class="post-meta">By&nbsp;<a href="#">'.post_author($post).'</a> | '.post_date($post).' | '.count_comments($post).' Comments
                    </div>
                  </div> 
                  <div class="post-entry">
                    <p>'.post_excerpt($post, null, 20).'</p>
                  </div>
                  <div class="post-more"><a class="more-link" href="'.post_url($post).'">Read more</a></div>
                </div>
              </div>';

      }

      return $str;

    }
  }

  // Theme custom shortcodes
  add_shortcode('icon_box', 'debut_icon_box');
  add_shortcode('section', 'debut_section');
  add_shortcode('latest_works', 'themeone_latestworks');
  add_shortcode('slider', 'nova_slider' );

  // Bootstrap shortcodes
  add_shortcode('button', 'bs_button' );
  add_shortcode('button_group', 'bs_button_group' );
  add_shortcode('alert', 'bs_alert' );
  add_shortcode('code', 'bs_code' );
  add_shortcode('span', 'bs_span' );
  add_shortcode('row', 'bs_row' );
  add_shortcode('column', 'bs_column' );
  add_shortcode('label', 'bs_label' );
  add_shortcode('list_group', 'bs_list_group' );
  add_shortcode('list_group_item', 'bs_list_group_item' );
  add_shortcode('badge', 'bs_badge' );
  add_shortcode('icon', 'bs_icon' );
  add_shortcode('icon_white', 'bs_icon_white' );
  add_shortcode('table', 'bs_table' );
  add_shortcode('collapsibles', 'bs_collapsibles' );
  add_shortcode('collapse', 'bs_collapse' );
  add_shortcode('well', 'bs_well' );
  add_shortcode('tabs', 'bs_tabs' );
  add_shortcode('tab', 'bs_tab' );
  add_shortcode('tooltip', 'bs_tooltip' );
  add_shortcode('popover', 'bs_popover' );
  add_shortcode('panel', 'bs_panel' );
  add_shortcode('media', 'bs_media' );
  add_shortcode('media_object', 'bs_media_object' );
  add_shortcode('media_body', 'bs_media_body' );
  add_shortcode('jumbotron', 'bs_jumbotron' );
  add_shortcode('lead', 'bs_lead' );
  add_shortcode('emphasis', 'bs_emphasis' );
  add_shortcode('thumbnail', 'bs_thumbnail' );
  add_shortcode('responsive', 'bs_responsive' );
  add_shortcode('modal', 'bs_modal' );
  add_shortcode('modal_footer', 'bs_modal_footer' );
  add_shortcode('latest_posts', 'latest_posts' );
  add_shortcode('contact_box', 'contact_box' );

  register_shortcode_css(array(
    base_url('ez-content/themes/themeone/assets/lib/bootstrap/dist/css/bootstrap.min.css'), 
    base_url('ez-content/themes/themeone/assets/lib/animate.css/animate.css'), 
    base_url('ez-content/themes/themeone/assets/lib/components-font-awesome/css/font-awesome.min.css'), 
    base_url('ez-content/themes/themeone/assets/lib/flexslider/flexslider.css'), 
    base_url('ez-content/themes/themeone/assets/css/colors/default.css'), 
    base_url('ez-content/themes/themeone/assets/css/style.css'),
    base_url('ez-content/themes/themeone/assets/lib/et-line-font/et-line-font.css')
  ));