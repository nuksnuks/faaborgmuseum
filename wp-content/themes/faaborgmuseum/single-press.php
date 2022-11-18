<?php
get_header();
?>

<body data-bgcolor="<?php echo get_field('background_color'); ?>" style="background-color: <?php echo get_field('background_color');  ?>" data-currentSlideBgcolor="rgb(<?php echo implode(", ",hex2rgb(get_field('background_color'))); ?>)" class="template-calendar">

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

    <div class="row" style="margin: 30px -15px;">
        <div class="col-xs-12 text-left"><h3><?php echo the_title(); ?></h3></div>
    </div>

</div>

<div class="container" id="turnwhite">

    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="wpb_wrapper">
                        <p><?php echo get_the_content(); ?></p>
                    </div>
        </div>
    </div>

</div>

<?php
    get_footer();
?>

