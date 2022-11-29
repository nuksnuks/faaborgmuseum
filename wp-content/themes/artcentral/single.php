<?php get_header(); ?>

<section class="indhold">
<div class="container">
  <?php if(has_post_thumbnail()):?>
    <img src="<?php the_post_thumbnail_url();?>" alt="<?php the_title();?>" class="thumbnail">
  <?php endif;?>
<h2><?php the_title(); ?></h2>
 <?php get_template_part('includes/section', 'blogcontent');?>
 <?php wp_link_pages();?>
</div>

</section>

<?php get_footer(); ?>
