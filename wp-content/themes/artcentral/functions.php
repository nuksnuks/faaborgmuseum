<?php
//loader javascript
function load_js() {
  wp_register_script('main',get_template_directory_uri(). '/js/main.js','jquery',false,true);
  wp_enqueue_script('main');
}
add_action('wp_enqueue_scripts','load_js');


//loader css'en
function load_css() {
  wp_register_style('style',get_template_directory_uri(). '/css/style.css',array(),false,'all');
  wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts','load_css');

/**
 * Register widget area.
 *
 * http://codex.wordpress.org/Function_Reference/register_sidebar
 */
// menu og widget valgmulighed til wordpress
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support( 'widgets' );
// referer til menu fra header.php
register_nav_menus(
  array(
    'menu' => 'Hovedmenu',
    'mobil-menu'=>'Mobilmenu'
  )
);

//Custom billede størrelser
add_image_size('blog-large', 800, 400, true);
add_image_size('blog-small',300,200,true);

//registrer sidebar widgets_init
function my_sidebars() {
  register_sidebar(
    array(
      'name'=> 'Min Sidebar',
      'id' => 'min-sidebar',
      'before_title'  => '<h3 class="widget-title">',
      'after_title' => '</h3>'
    )
  );
}
add_action('widgets_init','my_sidebars');
//header widget til logo
function logo_widget() {
  register_sidebar(
    array(
      'name'=> 'logo sidebar',
      'id' => 'logo-sidebar',
      'before_title'  => '<h3 class="logo-widget">',
      'after_title' => '</h3>'
    )
  );
}
add_action('widgets_init','logo_widget');

//registrer widget overlay
function my_video() {
  register_sidebar(
    array(
      'name'=> 'Video Sidebar',
      'id' => 'video-sidebar',
      'before_title'  => '<h3>',
      'after_title' => '</h3>'
    )
  );
};
add_action('widgets_init','my_video');
