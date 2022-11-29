<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
  <?php echo get_the_date('d/m/Y h:i:s');?>

  <?php the_content(); ?> <br>
  <?php
    $fname = get_the_author_meta('first_name');
    $lname = get_the_author_meta('last_name');
  ?>
  <p>Skrevet af: <?php $fname;?> <?php $lname;?></p>
  <?php the_author(); ?><br><br>

  <p>tags: </p>
  <?php
  $tags = get_the_tags();
  foreach($tags as $tag):?>
    <a href="<?php echo get_tag_link($tag->term_id);?>" class="tag">
      <?php echo $tag->name;?>
    </a>
<?php endforeach;?>

<?php
$categories = get_the_category();
foreach($categories as $cat):?>
  <a href="<?php echo get_category_link($cat -> term_id);?>">
  <?php echo $cat->name;?>
</a>

<?php endforeach;?>

<br>

<br>

<?php //comments_template( '/comments.php', true );     ?>

<?php endwhile; else: endif;?>
