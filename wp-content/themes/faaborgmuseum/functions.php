<?php

//---------------------------------------------------------------------------------------------------------------
// REMOVE DEFAULT JUNK
//---------------------------------------------------------------------------------------------------------------
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head','feed_links_extra', 3 );
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function remove_comments_rss($for_comments) {
    return;
}

if (function_exists('add_theme_support')) {
    add_theme_support( 'post-thumbnails' );
}

add_filter('show_admin_bar', '__return_false');


add_action('init', 'myoverride', 100);
function myoverride() {

    if (function_exists('visual_composer')) {
        remove_action('wp_head', array(visual_composer(), 'addMetaData'));
    }
}

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('FaaborgMuseum', get_template_directory() . '/languages');
}

//---------------------------------------------------------------------------------------------------------------
// REMOVE DEFAULT JUNK - DONE
//---------------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------------------
// HELPER FUNCS
//---------------------------------------------------------------------------------------------------------------

    function Hex2RGB($color)
    {
        $color = str_replace('#', '', $color);
        if (strlen($color) != 6) {
            return array(0, 0, 0);
        }
        $rgb = array();
        for ($x = 0; $x < 3; $x++) {
            $rgb[$x] = hexdec(substr($color, (2 * $x), 2));
        }
        return $rgb;
    }

function getOpenHours($opening_hours_array) {

    $currentMonth       = date('n', time());
    $currentWeekDay     = strtolower(date('l', time()));

    switch ($currentMonth) {

        case 11;
        case 12;
        case 1;
        case 2;
        case 3;
            $out = $opening_hours_array[$currentWeekDay."-1"];
        break;

        case 4;
        case 5;
        case 6;
        $out = $opening_hours_array[$currentWeekDay."-2"];
            break;

        case 7;
        case 8;
        $out = $opening_hours_array[$currentWeekDay."-3"];
            break;

        case 9;
        case 10;
        $out = $opening_hours_array[$currentWeekDay."-4"];
            break;

    }

    return $out;

}

function getTodaysTours() {


    $args=array(
        'post_type' => 'calendar',
        'meta_key' => 'date',
        'meta_compare' => '=',
        'meta_value' => date('Ymd')
    );
    $posts = new WP_Query($args);

    if ( $posts->have_posts() )
    {
        $posts->the_post();
        return get_field('time');
    } else {

        return __('Ingen omvisninger idag','FaaborgMuseum');
        //return "Ingen omvisninger i dag.";
    }

}

function custom_field_excerpt($title) {
    global $post;
    $text = get_field($title);
    if ( '' != $text ) {
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $excerpt_length = 20; // 20 words
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

    }
    return apply_filters('the_excerpt', $text);
}

//---------------------------------------------------------------------------------------------------------------
// LOAD SCRIPTS AND CSS
//---------------------------------------------------------------------------------------------------------------

add_action('get_header', 'da_theme_styles');
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );

function da_theme_styles() {
    if (!is_admin()) {
        //wp_enqueue_style('bootstrap', get_bloginfo('stylesheet_directory') . "/css/bootstrap.min.css");
        wp_enqueue_style('style', get_bloginfo('stylesheet_directory') . "/style.css", array());
        wp_enqueue_style('customstyle', get_bloginfo('stylesheet_directory') . "/style.min.css", array('style'));
    }

}

function theme_name_scripts() {

    if (!is_admin()) {

        wp_deregister_script('jquery');
        wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"), false, '1.11.3', true);
        wp_enqueue_script('jquery');

        wp_enqueue_script('bootstrap', get_bloginfo('stylesheet_directory') . "/js/bootstrap.min.js",array('jquery'),"1.0",true);
        wp_enqueue_script('sliderplugin', get_bloginfo('stylesheet_directory') . "/js/owl.carousel.min.js",array('jquery'),"1.0",true);
        wp_enqueue_script('sliderplugin_waypoints', get_bloginfo('stylesheet_directory') . "/js/jquery.waypoints.min.js",array('jquery'),"1.0",true);
        wp_enqueue_script('main', get_bloginfo('stylesheet_directory') . "/js/main.min.js",array('bootstrap','jquery','sliderplugin','sliderplugin_waypoints'),"1.0",true);
        wp_enqueue_script('main', get_bloginfo('stylesheet_directory') . "/src/main.js",true);

    }

}

//---------------------------------------------------------------------------------------------------------------
// BOGO
//---------------------------------------------------------------------------------------------------------------

add_filter('bogo_localizable_post_types', 'my_localizable_post_types', 10, 1);

function my_localizable_post_types($localizable) {
    $localizable[] = 'exhibitions';
    return $localizable;
}

//---------------------------------------------------------------------------------------------------------------
// THE NAVIGATION/WALKER
//---------------------------------------------------------------------------------------------------------------

function register_the_menu() {

    register_nav_menu( 'da_DK_top-menu', 'Top Menu DK' );
    register_nav_menu( 'de_DE_top-menu', 'Top Menu DE' );
    register_nav_menu( 'en_US_top-menu', 'Top Menu EN' );

}
add_action( 'init', 'register_the_menu' );

function add_language_prefix($menu_identifier) {
    global $post;
    $language_prefix = get_post_meta( $post->ID, '_locale', true );
    return $language_prefix . '_' . $menu_identifier;
}
add_filter('language_prefix_menu', 'add_language_prefix');

/* TODO: build cache */
function output_faaborg_menu()
{

    global $post;

    if (get_post_meta( $post->ID, '_locale', true ) != "") {
        $language_prefix = 'top-menu_'. get_post_meta( $post->ID, '_locale', true );
    }else {
        $language_prefix = 'top-menu_da_DK';
    }

    $args = array(
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false );

    $items = wp_get_nav_menu_items( $language_prefix, $args );

    $output = "";
    $i = 0;

    $output .= '<div class="row">'.PHP_EOL;

// First
    $output .= '<div class="col-sm-6 col-md-3">'.PHP_EOL;
    $output .= '<h5 class="navlist-toggler">'.$items[$i]->title.'</h5>'.PHP_EOL;
    $output .= '<ul class="collapse navlist">'.PHP_EOL;

    $i++;

    while ($items[$i]->menu_item_parent <> 0) {
        $output .= '<li><a href="'.$items[$i]->url.'" class="navlink">'.$items[$i]->title.'</a></li>'.PHP_EOL;
        $i++;
    }

    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;

// Second
    $output .= '<div class="col-sm-6 col-md-3">'.PHP_EOL;
    $output .= '<h5 class="navlist-toggler">'.$items[$i]->title.'</h5>'.PHP_EOL;
    $output .= '<ul class="collapse navlist">'.PHP_EOL;

    $i++;

    while ($items[$i]->menu_item_parent <> 0) {
        $output .= '<li><a href="'.$items[$i]->url.'" class="navlink">'.$items[$i]->title.'</a></li>'.PHP_EOL;
        $i++;
    }

    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;

// Third
    $output .= '<div class="col-sm-6 col-md-3">'.PHP_EOL;
    $output .= '<h5 class="navlist-toggler">'.$items[$i]->title.'</h5>'.PHP_EOL;
    $output .= '<ul class="collapse navlist">'.PHP_EOL;

    $i++;

    while ($items[$i]->menu_item_parent <> 0) {
        $output .= '<li><a href="'.$items[$i]->url.'" class="navlink">'.$items[$i]->title.'</a></li>'.PHP_EOL;
        $i++;
    }

    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;

// Language chooser
    $output .= '<div class="col-sm-6 col-md-3 hidden-xs">'.PHP_EOL;
    $output .= '<h5 class="navlist-toggler">' .__('SPROG','FaaborgMuseum'). '</h5>'.PHP_EOL;
    $output .= '<ul class="navlist">'.PHP_EOL;
    $output .= '<li>'.PHP_EOL;

    $output .= do_shortcode( '[bogo]' );

    //$output .= '<div class="btnwrapper"><a role="button" href="" class="col-xs-3 blackoutlinebox">DANSK</a></div>'.PHP_EOL;
    //$output .= '<div class="btnwrapper"><a role="button" href="" class="col-xs-3 blackoutlinebox">ENGLISH</a></div>'.PHP_EOL;
    //$output .= '<div class="btnwrapper"><a role="button" href="" class="col-xs-3 blackoutlinebox" style="padding: 5px 0">DEUTSCH</a></div>'.PHP_EOL;

    $output .= '</li>'.PHP_EOL;
    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;

    $output .= '</div>'.PHP_EOL;

// New row

    $output .= '<div class="row">'.PHP_EOL;

// Fourth
    $output .= '<div class="col-sm-6 col-md-3">'.PHP_EOL;
    $output .= '<h5 class="navlist-toggler">'.$items[$i]->title.'</h5>'.PHP_EOL;
    $output .= '<ul class="collapse navlist">'.PHP_EOL;

    $i++;

    while ($items[$i]->menu_item_parent <> 0) {
        $output .= '<li><a href="'.$items[$i]->url.'" class="navlink">'.$items[$i]->title.'</a></li>'.PHP_EOL;
        $i++;
    }

    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;


// Fifth

    $output .= '<div class="col-sm-6 col-md-3">'.PHP_EOL;
    $output .= '<h5 class="navlist-toggler">'.$items[$i]->title.'</h5>'.PHP_EOL;
    $output .= '<ul class="collapse navlist">'.PHP_EOL;

    $i++;

    while ($items[$i]->menu_item_parent <> 0) {
        $output .= '<li><a href="'.$items[$i]->url.'" class="navlink">'.$items[$i]->title.'</a></li>'.PHP_EOL;
        $i++;
    }

    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;

    /*
    $output .= '<div class="col-sm-6 col-md-3 hidden-xs">'.PHP_EOL;

    $output .= '<h5 class="navlist-toggler">' .__('NYHEDSBREV','FaaborgMuseum'). '</h5>'.PHP_EOL;
    $output .= '<ul class="navlist">'.PHP_EOL;
    $output .= '<li><input type="text" /></li>'.PHP_EOL;
    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;
*/
    $output .= '<div class="col-sm-12 col-md-3 hidden-xs">'.PHP_EOL;

    $output .= '<h5 class="navlist-toggler">' .__('SØG','FaaborgMuseum'). '</h5>'.PHP_EOL;
    $output .= '<ul class="navlist">'.PHP_EOL;
    $output .= '<li>'.get_search_form(false).'</li>'.PHP_EOL;
    $output .= '</ul>'.PHP_EOL;
    $output .= '</div>'.PHP_EOL;

    $output .= '</div>'.PHP_EOL;

    $topnavbottom = get_option('footers_array');

    $output .= '<div class="row navpusharea" style="padding-top: 15px">

                    <div class="col-sm-6 col-md-3">
                        <div class="whiteoutlinebox" style="text-transform: uppercase" >' .__('I dag','FaaborgMuseum'). ' D. '. date('j/n',time()).': '.getOpenHours(get_option('opening_hours_array')).'</div>
                    </div>

                    <div class="col-sm-6 col-md-3">
<!--
                      <ul class="navlist">
                         <li style="text-transform: uppercase">' .__('AKTUEL UDSTILLING','FaaborgMuseum'). '</li>
                         <li>'.nl2br(__('AKTUEL UDSTILLING TEKST','FaaborgMuseum'),true).'</li>
                      </ul>
-->
                    </div>
                    <div class="col-sm-6 col-md-3">

                        <ul class="navlist">
                            <li style="text-transform: uppercase">' .__('OMVISNINGER I DAG','FaaborgMuseum'). '</li>
                            <li>'.getTodaysTours().'</li>
                        </ul>

                    </div>
                    <div class="col-sm-6 col-md-3">

                        <ul class="navlist">
                           <li style="text-transform: uppercase">' .__('Priser','FaaborgMuseum'). '</li>
                            <li>' .nl2br(__('Priser tekst','FaaborgMuseum'),true). '</li>
                        </ul>

                    </div>

        </div>'.PHP_EOL;

    print $output;

}


//---------------------------------------------------------------------------------------------------------------
// CUSTOM POST TYPES
//---------------------------------------------------------------------------------------------------------------

add_action('init', 'exhibition_register');

function exhibition_register() {

    $labels = array(
        'name' => 'Udstillinger', 'post type general name',
        'singular_name' => 'Udstilling', 'post type singular name',
        'add_new' => 'Tilføj', 'event',
        'add_new_item' => 'Tilføj ny udstilling',
        'edit_item' => 'Redigere udstilling',
        'new_item' => 'Ny udstilling',
        'view_item' => 'Se udstilling',
        'search_items' => 'Søg udstilling',
        'not_found' =>  'Ingen udstillinger fundet',
        'not_found_in_trash' => 'Intet fundet i Trash',
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor','thumbnail')
    );

    register_post_type( 'exhibitions' , $args );
}

add_action('init', 'calendar_register');

function calendar_register() {

    $labels = array(
        'name' => 'Kalender', 'post type general name',
        'singular_name' => 'Kalender', 'post type singular name',
        'add_new' => 'Tilføj', 'event',
        'add_new_item' =>'Tilføj nyt kalender opslag',
        'edit_item' => 'Redigere kalender opslag',
        'new_item' => 'Nyt kalender opslag',
        'view_item' => 'Se kalender opslag',
        'search_items' => 'Søg i kalender opslag',
        'not_found' =>  'Ingen udstillinger fundet',
        'not_found_in_trash' => 'Intet fundet i Trash',
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => null,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor','thumbnail'),
        'taxonomies' => array('category')
    );

    register_post_type( 'calendar' , $args );
}

add_action('init', 'press_register');

function press_register() {

    $labels = array(
        'name' => 'Presse', 'post type general name',
        'singular_name' => 'Presse', 'post type singular name',
        'add_new' => 'Tilføj', 'presse',
        'add_new_item' => 'Tilføj ny pressemeddelse',
        'edit_item' => 'Redigere pressemeddelse',
        'new_item' => 'Ny pressemeddelse',
        'view_item' => 'Se pressemeddelse',
        'search_items' => 'Søg i pressemeddelser',
        'not_found' =>  'Ingen pressemeddelser fundet',
        'not_found_in_trash' => 'Intet fundet i Trash',
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => null,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor','thumbnail')
    );

    register_post_type( 'press' , $args );
}


//---------------------------------------------------------------------------------------------------------------
// ADMIN MENUS
//---------------------------------------------------------------------------------------------------------------

add_action('admin_menu', 'faaborg_admin_create_menu');

function faaborg_admin_create_menu() {

    add_menu_page('Fåborg Museum administration', 'Fåborg Museum', 'administrator', __FILE__, 'faaborg_admin_settings_page' , get_stylesheet_directory_uri() .'/images/icon.png' );
    add_action( 'admin_init', 'register_faaborg_admin_settings' );
}


function register_faaborg_admin_settings() {

    register_setting( 'faaborg_admin_settings-group', 'opening_hours_array' );
    register_setting( 'faaborg_admin_settings-group', 'footers_array' );
    register_setting( 'faaborg_admin_settings-group', 'calendar-topimage' );
    register_setting( 'faaborg_admin_settings-group', 'calendar-numberinlists' );
    register_setting( 'faaborg_admin_settings-group', 'late-css' );

}

function faaborg_admin_settings_page() {
    ?>
    <div class="wrap">
        <h2>Faaborg Museum</h2>

        <form method="post" action="options.php">
            <?php settings_fields( 'faaborg_admin_settings-group' ); ?>
            <?php do_settings_sections( 'faaborg_admin_settings-group' ); ?>
            <?php $opening_hours = get_option('opening_hours_array');?>
            <?php $footers = get_option('footers_array');?>

            <br />
            <h1>Åbningstider</h1>

            <h2>November-Marts</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mandag</th>
                    <td><input type="text" name="opening_hours_array[monday-1]" value="<?php echo esc_attr( $opening_hours['monday-1'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tirsdag</th>
                    <td><input type="text" name="opening_hours_array[tuesday-1]" value="<?php echo esc_attr( $opening_hours['tuesday-1'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Onsdag</th>
                    <td><input type="text" name="opening_hours_array[wednesday-1]" value="<?php echo esc_attr( $opening_hours['wednesday-1'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Torsdag</th>
                    <td><input type="text" name="opening_hours_array[thursday-1]" value="<?php echo esc_attr( $opening_hours['thursday-1'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Fredag</th>
                    <td><input type="text" name="opening_hours_array[friday-1]" value="<?php echo esc_attr( $opening_hours['friday-1'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Lørdag</th>
                    <td><input type="text" name="opening_hours_array[saturday-1]" value="<?php echo esc_attr( $opening_hours['saturday-1'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Søndag</th>
                    <td><input type="text" name="opening_hours_array[sunday-1]" value="<?php echo esc_attr( $opening_hours['sunday-1'] ); ?>" /></td>
                </tr>
            </table>

            <h2>April-Juni</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mandag</th>
                    <td><input type="text" name="opening_hours_array[monday-2]" value="<?php echo esc_attr( $opening_hours['monday-2'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tirsdag</th>
                    <td><input type="text" name="opening_hours_array[tuesday-2]" value="<?php echo esc_attr( $opening_hours['tuesday-2'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Onsdag</th>
                    <td><input type="text" name="opening_hours_array[wednesday-2]" value="<?php echo esc_attr( $opening_hours['wednesday-2'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Torsdag</th>
                    <td><input type="text" name="opening_hours_array[thursday-2]" value="<?php echo esc_attr( $opening_hours['thursday-2'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Fredag</th>
                    <td><input type="text" name="opening_hours_array[friday-2]" value="<?php echo esc_attr( $opening_hours['friday-2'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Lørdag</th>
                    <td><input type="text" name="opening_hours_array[saturday-2]" value="<?php echo esc_attr( $opening_hours['saturday-2'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Søndag</th>
                    <td><input type="text" name="opening_hours_array[sunday-2]" value="<?php echo esc_attr( $opening_hours['sunday-2'] ); ?>" /></td>
                </tr>
            </table>


            <h2>Juli-august</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mandag</th>
                    <td><input type="text" name="opening_hours_array[monday-3]" value="<?php echo esc_attr( $opening_hours['monday-3'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tirsdag</th>
                    <td><input type="text" name="opening_hours_array[tuesday-3]" value="<?php echo esc_attr( $opening_hours['tuesday-3'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Onsdag</th>
                    <td><input type="text" name="opening_hours_array[wednesday-3]" value="<?php echo esc_attr( $opening_hours['wednesday-3'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Torsdag</th>
                    <td><input type="text" name="opening_hours_array[thursday-3]" value="<?php echo esc_attr( $opening_hours['thursday-3'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Fredag</th>
                    <td><input type="text" name="opening_hours_array[friday-3]" value="<?php echo esc_attr( $opening_hours['friday-3'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Lørdag</th>
                    <td><input type="text" name="opening_hours_array[saturday-3]" value="<?php echo esc_attr( $opening_hours['saturday-3'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Søndag</th>
                    <td><input type="text" name="opening_hours_array[sunday-3]" value="<?php echo esc_attr( $opening_hours['sunday-3'] ); ?>" /></td>
                </tr>
            </table>

            <h2>September-Oktober</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mandag</th>
                    <td><input type="text" name="opening_hours_array[monday-4]" value="<?php echo esc_attr( $opening_hours['monday-4'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tirsdag</th>
                    <td><input type="text" name="opening_hours_array[tuesday-4]" value="<?php echo esc_attr( $opening_hours['tuesday-4'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Onsdag</th>
                    <td><input type="text" name="opening_hours_array[wednesday-4]" value="<?php echo esc_attr( $opening_hours['wednesday-4'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Torsdag</th>
                    <td><input type="text" name="opening_hours_array[thursday-4]" value="<?php echo esc_attr( $opening_hours['thursday-4'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Fredag</th>
                    <td><input type="text" name="opening_hours_array[friday-4]" value="<?php echo esc_attr( $opening_hours['friday-4'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Lørdag</th>
                    <td><input type="text" name="opening_hours_array[saturday-4]" value="<?php echo esc_attr( $opening_hours['saturday-4'] ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Søndag</th>
                    <td><input type="text" name="opening_hours_array[sunday-4]" value="<?php echo esc_attr( $opening_hours['sunday-4'] ); ?>" /></td>
                </tr>
            </table>

            <br />
            <h1>Kalender og Søg</h1>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Topbillede</th>
                    <td><input type="text" name="calendar-topimage" id="new_img" value="<?php echo esc_attr( get_option( 'calendar-topimage' ) ); ?>"></td>
                        <a class="button" onclick="upload_image('new_img');">Topbillede</a> </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Antal kalender visninger i lister</th>
                    <td><input type="text" name="calendar-numberinlists" value="<?php echo esc_attr( get_option( 'calendar-numberinlists' ) ); ?>"></td>
                </tr>
            </table>

            <h1>CSS</h1>
            <table class="form-table">
                <th scope="row">Sen CSS</th>
                <tr valign="top">
                    <td><textarea name="late-css" style="width: 600px; height: 400px"><?php echo esc_attr( get_option( 'late-css' ) ); ?></textarea></td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>

    <script>
        var uploader;
        function upload_image(id) {

          //Extend the wp.media object
          uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
              text: 'Choose Image'
            },
            multiple: false
          });

          //When a file is selected, grab the URL and set it as the text field's value
          uploader.on('select', function() {
            attachment = uploader.state().get('selection').first().toJSON();
            var url = attachment['url'];
            jQuery('#'+id).val(url);
          });

          //Open the uploader dialog
          uploader.open();
        }
    </script>

<?php }

//---------------------------------------------------------------------------------------------------------------
// VC extentions
//---------------------------------------------------------------------------------------------------------------

if (function_exists('vc_map')) {

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Link panels img, header, link, text
////////////////////////////////////////////////////////////////////////////////////


    vc_map(array(
        "name" => "Fåborg Link banner",
        "base" => "faaborglinkbanner",
        "category" => 'Fåborg Museum',
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "faaborglinkbanner-image",
                "heading" => "Image",
                "param_name" => "faaborglinkbannerimage",
                "value" => "",
                "description" => "Billed (262px x 373px)"
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "faaborglinkbanner-header",
                "heading" => "Overskrift",
                "param_name" => "faaborglinkbannerheader",
                "value" => "",
                "description" => ""
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "faaborglinkbanner-text",
                "heading" => "Tekst",
                "param_name" => "faaborglinkbannertext",
                "value" => "",
                "description" => ""
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "faaborglinkbanner-link",
                "heading" => "Link",
                "param_name" => "faaborglinkbannerlink",
                "value" => "",
                "description" => ""
            )
        )
    ));

    function renderFaaborgLinkBanner($atts, $content = null)
    {

        $output = "";
        $content = "";

        $enlarge = "";
        $header = "";
        $faaborglinkbannerimage = "";
        $faaborglinkbannerlink = "";
        $faaborglinkbannerheader = "";
        $faaborglinkbannertext = "";

        extract(shortcode_atts(array(
            'faaborglinkbannerimage' => '',
            'faaborglinkbannerheader' => '',
            'faaborglinkbannertext' => '',
            'faaborglinkbannerlink' => '',
        ), $atts));

        $img_id = preg_replace('/[^\d]/', '', $faaborglinkbannerimage);
        $img = wp_get_attachment_image_src($img_id, 'full');
        $items = wpb_js_remove_wpautop($items, true);

        $faaborglink = vc_build_link( $faaborglinkbannerlink );

        $output = '<div class="faaborglinkbanner"><a href="' . $faaborglink['url'] . '">';
        $output .= '<img class="img-responsive hidden-xs" src="' . $img[0] . '" alt="" title="">';
        $output .= '<div class="teasers--headline">' . $faaborglinkbannerheader . '</div>';
        $output .= '<div class="teasers--text">' . $faaborglinkbannertext . '</div>';
        $output .= '</a></div>';

        return $output;
    }

    add_shortcode('faaborglinkbanner', 'renderFaaborgLinkBanner');

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Aktuelle udstillinger
////////////////////////////////////////////////////////////////////////////////////

    vc_map(array(
        "name" => "Fåborg Aktuelle udstillinger",
        "base" => "faaborgcurrentexhibitions",
        "category" => 'Fåborg Museum',
        "params" => array()
    ));

    function renderFaaborgCurrentExhibitions($atts, $content = null)
    {
        global $wpdb;

        $output = "";

        $args = array(
            'post_type' => 'exhibitions',
            'meta_query'     => array(
                array(
                    'key'       => 'date_from',
                    'value'     => date('Ymd',time() ),
                    'compare'   => '<='
                ),
                array(
                    'key'       => 'date_to',
                    'value'     => date('Ymd',time() ),
                    'compare'   => '>='
                ),
            ),
            'meta_key'=>'date_from',
            'orderby' => 'meta_value_num',
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {

            $i = 0;

            $output .= '<div class="row" style="margin-bottom: 30px;">';

            while ($the_query->have_posts()) {

                $the_query->the_post();

                $i++;

                $the_img = get_field('poster_image');

                $output .= '<a href="' . get_the_permalink() . '" ><div class="col-xs-12 col-sm-6 col-md-4">';
                $output .= '<img class="img-responsive  hidden-xs" src="' . $the_img['url'] . '" alt="' . $the_img['alt'] . '" title="' . $the_img['title'] . '" width="' . $the_img['width'] . '" height="' . $the_img['height'] . '" />';
                $output .= '<div class="teasers--headline">' . get_the_title() . '</div>';
                $output .= '<div class=""><strong>' . date("d/n", strtotime(get_field('date_from'))) . '-' . date("d/n-Y", strtotime(get_field('date_to'))) . '</strong></div>';
                $output .= '</a></div>';

                if ($i % 3 == 0) {
                    $output .= '</div>';
                    $output .= '<div class="row" style="margin-bottom: 30px;">';
                }

            }

            $output .= '</div>';

        } else {
            $output .= "<h1>".__('Ingen udstillinger fundet.','FaaborgMuseum')."</h1>";
        }

        wp_reset_postdata();

        return $output;
    }

    add_shortcode('faaborgcurrentexhibitions', 'renderFaaborgCurrentExhibitions');

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Kommende udstillinger
////////////////////////////////////////////////////////////////////////////////////

    vc_map(array(
        "name" => "Fåborg kommende udstillinger",
        "base" => "faaborgupcomingexhibitions",
        "category" => 'Fåborg Museum',
        "params" => array()
    ));

    function renderFaaborgUpcomingExhibitions($atts, $content = null)
    {
        global $wpdb;

        $output = "";

        $args = array(
            'post_type' => 'exhibitions',
            'meta_query'     => array(
                array(
                    'key'       => 'date_from',
                    'value'     => date('Ymd',time() ),
                    'compare'   => '>='
                )
            ),
            'meta_key'=>'date_from',
            'orderby' => 'date_from',
            'order' => 'ASC',
        );

        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {

            $i = 0;

            $output .= '<div class="row" style="margin-bottom: 30px;">';

            while ($the_query->have_posts()) {

                $the_query->the_post();

                if (time() > strtotime(get_field('date_from'))) {
                    continue;
                }

                $i++;

                $the_img = get_field('poster_image');

                $output .= '<a href="' . get_the_permalink() . '" ><div class="col-xs-12 col-sm-6 col-md-4">';
                $output .= '<img class="img-responsive  hidden-xs" src="' . $the_img['url'] . '" alt="' . $the_img['alt'] . '" title="' . $the_img['title'] . '" width="' . $the_img['width'] . '" height="' . $the_img['height'] . '" />';
                $output .= '<div class="teasers--headline">' . get_the_title() . '</div>';
                $output .= '<div class=""><strong>' . date("d/n", strtotime(get_field('date_from'))) . '-' . date("d/n-Y", strtotime(get_field('date_to'))) . '</strong></div>';
                $output .= '</div></a>';

                if ($i % 3 == 0) {
                    $output .= '</div>';
                    $output .= '<div class="row" style="margin-bottom: 30px;">';
                }

            }

            $output .= '</div>';

        }

        if ($output == '<div class="row"></div>')
            $output = "<h4><em>Ingen udstillinger fundet.</em></h4>";

        wp_reset_postdata();

        return $output;
    }

    add_shortcode('faaborgupcomingexhibitions', 'renderFaaborgUpcomingExhibitions');

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Tidligere udstillinger
////////////////////////////////////////////////////////////////////////////////////

    vc_map(array(
        "name" => "Fåborg tidligere udstillinger",
        "base" => "faaborgpastexhibitions",
        "category" => 'Fåborg Museum',
        "params" => array()
    ));

    function renderFaaborgPastExhibitions($atts, $content = null)
    {
        global $wpdb;

        $output = "";

        $args = array(
            'post_type' => 'exhibitions',
            'meta_query'     => array(
                array(
                    'key'       => 'date_to',
                    'value'     => date('Ymd',time() ),
                    'compare'   => '<='
                )
            ),
            'meta_key'=>'date_from',
            'orderby' => 'date_from',
        );

        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {

            $i = 0;

            $output .= '<div class="row" style="margin-bottom: 30px;">';

            while ($the_query->have_posts()) {

                $the_query->the_post();

                if (time() < strtotime(get_field('date_to'))) {
                    continue;
                }

                $i++;

                $the_img = get_field('poster_image');

                $output .= '<a href="' . get_the_permalink() . '" ><div class="col-xs-12 col-sm-6 col-md-4">';
                $output .= '<img class="img-responsive  hidden-xs" src="' . $the_img['url'] . '" alt="' . $the_img['alt'] . '" title="' . $the_img['title'] . '" width="' . $the_img['width'] . '" height="' . $the_img['height'] . '" />';
                $output .= '<div class="teasers--headline">' . get_the_title() . '</div>';
                $output .= '<div class=""><strong>' . date("d/n", strtotime(get_field('date_from'))) . '-' . date("d/n Y", strtotime(get_field('date_to'))) . '</strong></div>';
                $output .= '</div></a>';

                if ($i % 3 == 0) {
                    $output .= '</div>';
                    $output .= '<div class="row" style="margin-bottom: 30px;">';
                }

            }

            $output .= '</div>';

        }

        if ($output == '<div class="row"></div>')
            $output = "<h4><em>".__('Ingen udstillinger fundet.','FaaborgMuseum')."</em></h4>";

        wp_reset_postdata();

        return $output;
    }

    add_shortcode('faaborgpastexhibitions', 'renderFaaborgPastExhibitions');

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Kalender
////////////////////////////////////////////////////////////////////////////////////

    $allcategories = get_categories(array("posttype" => "calendar"));

    $cat_array['Alle'] = -1;

    foreach ($allcategories as $cat) {
        $cat_array[$cat->name] = $cat->cat_ID;
    }

    vc_map(array(
            "name" => "Fåborg kalender",
            "base" => "faaborgcalendar",
            "category" => 'Fåborg Museum',
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => "Kategori",
                    'admin_label' => true,
                    "param_name" => "faaborgcalendarcategories",
                    "value" => $cat_array,
                    "description" => "Vælg kategori"
                )
            )
        )
    );

    function renderFaaborgCalendar($atts, $content = null)
    {
        global $wpdb;

        $faaborgcalendarcategories = "";

        extract(shortcode_atts(array(
            faaborgcalendarcategories => ''
        ), $atts));

        $output = "";

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
            'posts_per_page' => get_option( 'calendar-numberinlists' ),
            'no_found_rows'=>'true'
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {

            $lastdate = "";

            while ($the_query->have_posts()) {

                $the_query->the_post();


                $currentlang = get_post_meta( get_the_id() , '_locale', true );
                $calendarLink   = get_permalink(get_the_ID());

                if ( function_exists( 'bogo_get_post_translations' ) ) {
                    $translations = bogo_get_post_translations(get_the_ID());

                    if ( ! empty( $translations[$currentlang] ) ) {
                        $calendarLink = get_permalink( $translations[$currentlang] );
                    }
                }

                $output = '<div class="row calendar-row">';

                /*
                if (get_field('date') != $lastdate) {
                    $output = '<div class="row calendar-row">';
                } else {
                    $output = '<div class="row calendar-row-sameday">';
                }
                */

                $lastdate = get_field('date');

                if (get_field("date_start") <> get_field("date_end")) {
                    $output .= '<div class="col-xs-12 col-sm-1 calendar-date">' . date('j/n', strtotime(get_field("date_start"))) . ' - ' . date('j/n', strtotime(get_field("date_end"))) . '</div>';
                } else {
                    $output .= '<div class="col-xs-12 col-sm-1 calendar-date">' . date('j/n', strtotime(get_field("date_start"))) . '</div>';
                }
                $output .= '<div class="col-xs-6 col-sm-3 calendar-categories hidden-xs">';

                $categories = wp_get_post_categories(get_the_ID());

                $cat = get_category($categories[0]);
                $output .= mb_strtoupper($cat->name) . "<br />";

                $output .= '</div>';

                $output .= '<div class="col-xs-6 col-sm-5 calendar-title"><a href="' . $calendarLink . '">' . mb_strtoupper(get_the_title()) . '</a></div>';
                $output .= '<div class="col-xs-6 col-sm-3 calendar-time">' . get_field('time') . '</div>';

                $output .= '</div>';

                $outputArr[] = $output;

            }

        }

        if (count($outputArr) == 0)
            return "<h4><em>".__('Ingen opslag fundet.','FaaborgMuseum')."</em></h4>";

        wp_reset_postdata();

        //$outputArr = array_reverse($outputArr);

        return implode('',$outputArr);
    }

    add_shortcode('faaborgcalendar', 'renderFaaborgCalendar');

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Pressemeddelser
////////////////////////////////////////////////////////////////////////////////////

    vc_map(array(
        "name" => "Fåborg pressemeddelser",
        "base" => "faaborgpress",
    ));


    function renderFaaborgPress($atts, $content = null)
    {
        global $wpdb;

        extract(shortcode_atts(array(), $atts));

        $output = "";

        $args = array(
            'post_type' => 'press',
            'orderby' => 'date'
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {

            while ($the_query->have_posts()) {

                $the_query->the_post();

                $posthumb = get_field("thumb");

                $output .= '<a href="' . get_permalink() . '"><div class="row press-row">';

                $output .= '<div class="col-xs-12 col-sm-4 press-image"><img src="' . $posthumb['url'] . '" alt="'.get_the_title().'" title="'.get_the_title().'" /></div>'.PHP_EOL;

                $output .= '<div class="col-xs-12 col-sm-8 press-title">'.PHP_EOL.'<h4>' . mb_strtoupper(get_the_title()) . '</h4>'.PHP_EOL;
                $output .= '<span class="press-text">' . substr(strip_tags(get_the_content()),0,120) . '...'.PHP_EOL;

                $output .= '</span></div></div></a>'.PHP_EOL;

            }

        }

        if ($output == '<div class="row"></div>')
            $output = "<h4><em>".__('Ingen pressemeddelser fundet.','FaaborgMuseum')."</em></h4>";

        wp_reset_postdata();

        return $output;
    }

    add_shortcode('faaborgpress', 'renderFaaborgPress');

}
