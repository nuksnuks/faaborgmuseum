 <?php get_header(); ?>

<section class="indhold">
<div class="container">
  <h2><?php the_title(); ?></h2><br>
  <?php get_template_part('includes/section', 'content');?>
  <?php get_search_form(); ?>
</div>

</section>

<?php get_footer(); ?>
