<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.typekit.net/pzr1mrq.css">
    <title></title>
    <?php wp_head();?>
  </head>
  <body>
    <header id="menustylingsanker">
      <?php
      //logo
      if( is_active_sidebar('logo-sidebar') ) : dynamic_sidebar('logo-sidebar');
      endif;

      //menu
      wp_nav_menu(
        array( 'theme_location'=> 'menu' )
      );

      //søgebar
      get_search_form();
      ?>

    </header>
