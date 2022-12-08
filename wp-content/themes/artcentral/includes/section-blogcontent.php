<?php
if( have_posts() ): while( have_posts() ): the_post(); ?>
<h2><?php the_title();?></h2>
<?php echo get_the_date('d/m/Y h:i:s');
the_content();
?> <br>
<?php
  $fname = get_the_author_meta('first_name');
  $lname = get_the_author_meta('last_name');
?>
<p>Skrevet af: <?php $fname; $lname;?></p>
  <?php the_author(); ?><br><br>

<p>tags: </p>
  <?php
    $tags = get_the_tags();
    foreach($tags as $tag):?>
      <a href="<?php echo get_tag_link($tag->term_id);?>" class="tag">
        <?php echo $tag->name;?>
      </a>
  <?php endforeach;

$categories = get_the_category();
foreach($categories as $cat):?>
  <a href="<?php echo get_category_link($cat -> term_id);?>">
  <?php echo $cat->name;?>
</a>
<?php endforeach;?>
<br><br>

<?php
//comments_template( '/comments.php', true );
endwhile; else: endif;
?>
