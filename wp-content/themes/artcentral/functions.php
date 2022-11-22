<?php

//loader css'en

function load_css()
{
  wp_register_style('style',get_template_directory_uri(). '/css/style.css',array(),false,'all');

  wp_enqueue_style('style');



}
add_action('wp_enqueue_scripts','load_css');
//loader javascript

function load_js()
{
  wp_register_script('main',get_template_directory_uri(). '/js/main.js','jquery',false,true);

  wp_enqueue_script('main');



}
add_action('wp_enqueue_scripts','load_js');

// menu valgmulighed til wordpress
add_theme_support('menus');



// referer til menu fra header.php
register_nav_menus(
  array(

    'menu' => 'Hovedmenu',
    'mobil-menu'=>'Mobilmenu'
  )

);
