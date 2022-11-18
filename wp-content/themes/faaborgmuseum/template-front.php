<?php
/*
 * Template Name: Frontpages
*
*/

get_header();
the_post();
?>

<body class="template-frontpage">

<?php
get_template_part("navigation");
?>

<div class="container">

    <div class="row faaslider">

        <?php

            if (get_field("layerslider_id"))
            {
                layerslider(get_field("layerslider_id"));
            } else {
                layerslider('frontslider');
            }

         ?>
    </div>
	</div>

	<div class="container">

    <div class="row">
        <?php
        	echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' => 'img-responsive' ) )
        ?>
    </div>

    <div class="row" id="turnwhite">
		
    </div>

    <?php
	

    ?>
	
 <div class="row" id="turnwhite">
		
    </div>

    <?php

    the_content();

    ?>
	
</div>

<?php
get_footer();
?>
