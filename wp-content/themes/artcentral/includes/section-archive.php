<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
  <div class="blog">
    <div class="blog-felt">
      <div class="thumbnailcontainer">
        <?php if(has_post_thumbnail()):?>
          <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class="thumbnail">
        <?php endif;?>
      </div>
      <div class="blog-container">
        <h3><?php the_title();?></h3><br>
        <?php the_excerpt(); ?><br>
        <a href="<?php the_permalink();?>">Læs mere</a><br>
    </div>
  </div>
<?php endwhile; else: endif;?>
