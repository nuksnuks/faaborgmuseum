<?php
get_header();
?>

<body class="template-search">

<?php
get_template_part("navigation");

?>

<div class="container">

    <div class="row">
        <img class="img-responsive" src="<?php echo get_option('calendar-topimage'); ?>" />
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 text-left"><h3><?php echo __('Søgeresultat','FaaborgMuseum'); ?></h3></div>
    </div>

</div>

<div class="container" style="margin-top: 20px;">

<?php

    if ( have_posts() ) {

        while ( have_posts() ) {

            the_post();

            $output .= '<a href="'.get_permalink().'">';
            $output .= '<div class="row search-row">';

            switch ( get_post_type() ) {

                case "page":
                    $output .= '<div class="col-xs-5 search-parent">';
                        $output .= mb_strtoupper(  str_replace('<br />','', get_the_title( wp_get_post_parent_id(get_the_ID()) )));
                    $output .= '</div>';
                    $output .= '<div class="col-xs-1">/</div>';
                    $output .= '<div class="col-xs-6 search-title">'.mb_strtoupper(str_replace('<br />','', get_the_title())).'</div>';
                break;

                case "calendar":
                    $output .= '<div class="col-xs-5 search-parent">KALENDER</div>';
                    $output .= '<div class="col-xs-1">/</div>';
                    $output .= '<div class="col-xs-6 search-title">'.mb_strtoupper(str_replace('<br />','', get_the_title())).'</div>';
                break;

                case "exhibitions":
                    $output .= '<div class="col-xs-5 search-parent">UDSTILLINGER</div>';
                    $output .= '<div class="col-xs-1">/</div>';
                    $output .= '<div class="col-xs-6 search-title">'.mb_strtoupper(str_replace('<br />','', get_the_title())).'</div>';
                break;

                default:
                    $output .= '<div class="col-xs-5 search-parent">'.get_post_type().'</div>';
                    $output .= '<div class="col-xs-1">/</div>';
                    $output .= '<div class="col-xs-6 search-title">'.mb_strtoupper(str_replace('<br />','', get_the_title())).'</div>';
                break;
            }

            $output .= '</div>';
            $output .= '</a>';

        }

    echo $output;

} else {

    get_search_form();

}
    ?>

</div>



<?php
get_footer();
?>
