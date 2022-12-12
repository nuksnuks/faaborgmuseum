<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
  <div class="nyheder-blog">
    <div class="nyheder-blogfelt">
      <div class="nyheder-thumbnail">
        <?php if(has_post_thumbnail()):?>
          <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class="preview">
        <?php endif;?>
      </div>
      <div class="nyheder-container">
      <h3><?php the_title();?></h3><br>
      <?php the_excerpt(); ?><br>
      <a href="<?php the_permalink();?>">Læs mere</a><br>
    </div>
  </div>
<?php endwhile; else: endif;?>
