 <?php get_header();
 if( is_active_sidebar('video-sidebar') ) : dynamic_sidebar('video-sidebar');
 endif;
 ?>


<section class="indhold">
<div class="container">
  <?php get_template_part('includes/section', 'frontcontent');?>

</div>

</section>

<?php get_footer(); ?>
