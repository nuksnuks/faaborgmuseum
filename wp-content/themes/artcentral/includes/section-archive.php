<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
  <h2><?php the_title();?></h2><br>
  <?php the_excerpt(); ?><br>
  <a href="<?php the_permalink();?>">Læs mere</a><br>
<?php endwhile; else: endif;?>
