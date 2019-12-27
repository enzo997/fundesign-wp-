<?php
define('THEME_URI', get_template_directory_uri());
define('DF_IMAGE', THEME_URI. '/assets/images/default');
define('TP_PART', THEME_URI. '/template-part');
define('THEME_DIR', get_template_directory());
include TEMPLATEPATH .'/function/function.php';
include TEMPLATEPATH .'/function/action-hook.php';

// Local JSON acf
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-field';
    return $path;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-field';
    return $paths;
}
// GOOGLE MAP
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyCNkKNWgDN1BD-m6ny8ViSvOireBGRvjDQ');
}
add_action('acf/init', 'my_acf_init');
//END GOOGLE 

// ADD CSS AND JS
function fundesign_style() {
	$date = date('l jS \of F Y h:i:s A');
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style('slick', THEME_URI. '/assets/css/slick.css');
    wp_enqueue_style('bootstrap', THEME_URI. '/assets/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome5', THEME_URI. '/assets/fonts/fontawesome/css/all.css');
    
    // Add CSS
    wp_enqueue_style('main', THEME_URI.'/assets/css/main.css?'.$date);
    wp_enqueue_style('main-for-WP', THEME_URI.'/assets/css/main-for-WP.css?'.$date);
    wp_enqueue_style('animate', THEME_URI.'/assets/css/animate.css?'.$date);

    // Add JS
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.js', '','' , true);
    wp_enqueue_script( 'jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.1.0.js', '','' , true);
    wp_enqueue_script( 'bootstrap', THEME_URI. '/assets/js/bootstrap.min.js', '','' , true);
    wp_enqueue_script( 'slick', THEME_URI. '/assets/js/slick.min.js', '','' , true);
    // wp_enqueue_script( 'call-slick', THEME_URI. '/assets/js/call-slick.js?'.$date, '','' , true);
    wp_enqueue_script( 'animation', THEME_URI. '/assets/js/WOW.js', '','' , true);
    // wp_enqueue_script( 'event', THEME_URI. '/assets/js/event.js?'.$date, '','' , true);
    wp_enqueue_script( 'main', THEME_URI. '/assets/js/main.js?'.$date, '','' , true);
    wp_enqueue_script( 'scripts', THEME_URI. '/assets/js/scripts.js?'.$date, '','' , true);
    wp_enqueue_script( 'ajax', THEME_URI. '/assets/js/ajax.js?'.$date, '','' , true);

    wp_localize_script('ajax', 'ajax_var', array('url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'fundesign_style' );

// Menu
register_nav_menus(
    array(
        'header_menu'  => __( 'Header Menu' ),
        'category_nav_menu_work' => __( 'Category Nav Menu Work' ),
        'category_nav_menu_Post' => __( 'Category Nav Menu Post' ),
    )
);
//acf_add_options_page('Theme Options');
if( function_exists('acf_add_options_page') ) {
    $parent = acf_add_options_page(array(
        'page_title'    => 'Theme Options',
        'menu_title'    => 'Theme Options',
        'menu_slug'     => 'Theme Option',
        'parent_slug'   => '',
        'redirect'      => false,
        'position'      => false,
        'icon_url'      => false,
    ));
};


