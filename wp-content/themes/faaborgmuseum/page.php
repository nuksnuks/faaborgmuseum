<?php
get_header();
?>

<body data-bgcolor="<?php echo get_field('background_color'); ?>" style="background-color: <?php echo get_field('background_color');  ?>" class="template-page">

<?php
get_template_part("navigation");
the_post();

?>

<div class="container">

    <div class="row">
        <?php
            echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' => 'img-responsive' ) )
        ?>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 text-left pageheadline"><h3><?php echo the_title(); ?></h3></div>
    </div>

</div>

<div class="container" style="margin-top: 20px;">
    <?php
        echo the_content();
    ?>
</div>

<?php
    get_footer();
?>

