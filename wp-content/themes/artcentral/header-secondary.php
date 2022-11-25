<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.typekit.net/pzr1mrq.css">
    <title></title>
    <?php wp_head();?>
  </head>
  <body>

    <header>
<!--<img src=">< ?php the_post_thumbnail_url();?>" alt="" class="logo">-->
      <?php

      wp_nav_menu(
        array(
          'theme_location'=> 'menu'
        )
      );
      ?>
    </header>
