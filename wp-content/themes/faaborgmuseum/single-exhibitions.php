<?php
get_header();
?>

<body data-bgcolor="<?php echo get_field('background_color'); ?>" style="background-color: <?php echo get_field('background_color');  ?>" data-currentSlideBgcolor="rgb(<?php echo implode(", ",hex2rgb(get_field('background_color'))); ?>)" class="template-exhibitions">

<?php

get_template_part("navigation");
the_post();

?>

<div class="container">

    <div class="row">
        <?php
            echo get_the_post_thumbnail( get_the_id(), 'fulld', array( 'class' => 'img-responsive' ) )
        ?>
    </div>

    <div class="row" style="margin: 30px -15px;">
        <div class="col-xs-12 col-sm-6 text-left"><h3><?php echo the_title(); ?></h3></div>
        <div class="col-xs-12 col-sm-6 text-right"><h3><?php echo date('d/n-Y',strtotime(get_field('date_from'))); ?><br />—<br /><?php echo date('d/n-Y',strtotime(get_field('date_to'))); ?></h3></div>
    </div>

</div>

<div class="container">
    <?php

    echo the_content();

    ?>
</div>

<?php
get_footer();
?>

