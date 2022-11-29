<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
  <?php echo get_the_date();?>
  <?php the_content(); ?> <br>

  <?php
    $fname = get_the_author_meta('first_name');
    $lname = get_the_author_meta('last_name');
  ?>
  <p>Skrevet af: <?php $fname;?> <?php $lname;?></p>
  <?php the_author(); ?>

<?php endwhile; else: endif;?>
