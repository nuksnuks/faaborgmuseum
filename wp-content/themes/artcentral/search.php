<?php get_header();?>
<section class="indhold">
  <div class="search-box">
    <h2>Søgeresultater for: '<?php echo get_search_query();?>'</h2>
    <?php
      get_template_part('includes/section', 'archive');
      previous_posts_link();
      next_posts_link();
    ?>
  </div>
</section>
<?php get_footer();?>
