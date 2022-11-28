<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
  <div class="blog">
    <div class="blog-felt">
      <h3><?php the_title();?></h3><br>
      <?php the_excerpt(); ?><br>
      <a href="<?php the_permalink();?>">Læs mere</a><br>
    </div>
  </div>
<?php endwhile; else: endif;?>
