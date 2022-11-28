<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
<?php the_content(); ?> <br>
<?php
  
?>
<?php endwhile; else: endif;?>
