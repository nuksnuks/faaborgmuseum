<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
  <h2><?php the_title();?></h2><br>
  <?php the_content(); ?><br>
  <a href="<?php the_permalink();?>">Læs mere</a><br>
  <?php previous_posts_link();?><?php next_posts_link();?>
<?php endwhile; else: endif;?>
