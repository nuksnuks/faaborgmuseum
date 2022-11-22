<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php wp_head();?>
  </head>
  <body>

    <header>

      <?php
      wp_nav_menu(
        array(
          'theme_location'=> 'menu'
        )
      );
      ?>
    </header>
