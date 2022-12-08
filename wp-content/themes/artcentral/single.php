<?php get_header(); ?>

<section class="indhold">
<div class="container">


 <?php
 get_template_part('includes/section', 'blogcontent');
 wp_link_pages();
 ?>
</div>

</section>

<?php get_footer(); ?>
