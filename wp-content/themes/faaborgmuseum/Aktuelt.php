<?php

/*
 * Template Name: Aktuelt
 */

get_header();


?>

<body data-bgcolor="<?php echo get_field('background_color'); ?>" style="background-color: <?php echo get_field('background_color');  ?>" class="template-fullwidth">

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

    <div class="row" id="turnwhite">
        <div class="col-xs-12 col-sm-6 text-left pageheadline"><h3><?php echo the_title(); ?></h3></div>
    </div>

</div>

<div class="container" style="margin-top: 20px;">
	 <div class="row">
        <div class="col-xs-12 pageheadline"><h4><?php echo __('AKTUELT','FaaborgMuseum'); ?></h4></div>
    </div>
        <?php

        $args = array(
            'post_type' => 'calendar',
            'meta_query'     => array(
                array(
                    'key'       => 'date_end',
                    'value'     => date('Ymd',time() ),
                    'compare'   => '>='
                )
            ),
            'meta_key'=>'date_start',
            'orderby' => 'meta_value_num',
            'order'=> 'ASC',
            'posts_per_page' => '4',
            'no_found_rows'=>'true'
        );
        $the_query = new WP_Query( $args );

        ?>

        <?php if ( $the_query->have_posts() ) : ?>

            <?php while ( $the_query->have_posts() ) : $the_query->the_post();  ?>

                <a href="<?php the_permalink(); ?>"><div class="col-xs-12 col-sm-6 col-md-3 faaborgaktueltlink">
                        <?php
                        $poster_img = get_field('poster_image');
                        ?>
                        <img class="img-responsive hidden-xs" src="<?php echo $poster_img['url']; ?>" alt="<?php echo $poster_img['alt']; ?>" title="<?php echo $poster_img['title']; ?>" width="<?php echo $poster_img['width']; ?>" height="<?php echo $poster_img['height']; ?>">
                        <div class="teasers--headline"><?php the_title();  ?></div>

                        <div class="teasers--text">
                            <?php
                            if ('' != get_field('excerpt') )
                            {
                                echo get_field('excerpt');
                            } else {
                                echo custom_field_excerpt('description');
                            }
                            ?>
                        </div>
                        <div class="teasers--link">
                            <?php

                            $cats = get_the_category();

                            echo $cats[0]->name;

                            ?>
                        </div>
                    </div></a>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

		    </div>		

	
<div class="container" style="margin-top: 20px;">
    <?php
    echo the_content();
    ?>
	
</div>	
<?php
get_footer();
?>

