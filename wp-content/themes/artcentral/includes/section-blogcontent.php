<?php if( have_posts() ): while( have_posts() ): the_post(); ?>

  <?php the_content(); ?> <br>
  <?php the_author(); ?>

<?php endwhile; else: endif;?>
