<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
<h2><?php the_title();?></h2><br>
  <?php the_excerpt(); ?>


<?php endwhile; else: endif;?>
