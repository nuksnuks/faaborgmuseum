<?php

//loader css'en
function load_css() {
  wp_register_style('style',get_template_directory_uri(). '/css/style.css',array(),false,'all');
  wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts','load_css');
//loader javascript
function load_js() {
  wp_register_script('main',get_template_directory_uri(). '/js/main.js','jquery',false,true);
  wp_enqueue_script('main');
}
add_action('wp_enqueue_scripts','load_js');
/**
 * Register widget area.
 *
 * http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function nd_dosth_register_sidebars() {

   register_sidebar( array(
		'name'          => esc_html__( 'Footer Section One', 'nd_dosth' ),
		'id'            => 'footer-section-one',
		'description'   => esc_html__( 'Widgets added here would appear inside the first section of the footer', 'nd_dosth' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
    ) );

    register_sidebar( array(
		'name'          => esc_html__( 'Footer Section Two', 'nd_dosth' ),
		'id'            => 'footer-section-two',
		'description'   => esc_html__( 'Widgets added here would appear inside the second section of the footer', 'nd_dosth' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'nd_dosth_register_sidebars' );
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
add_image_size('blog-large', 800, 400,false);
add_image_size('blog-small',300,200,true);
