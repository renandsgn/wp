<?php

function remove_useless_stuff() {
    if ( !is_admin() ) {
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action( 'wp_head', 'index_rel_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
        remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
        remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
        remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
    }
}
add_action( 'init', 'remove_useless_stuff', PHP_INT_MAX - 1 );


if( class_exists('ACF') ) {
    function add_custom_options_page() {
        acf_add_options_page( array(
            'page_title' => 'Opções Gerais',
            'menu_title' => 'Opções Gerais',
            'menu_slug' => 'opcoes-gerais',
            'capability' => 'edit_posts',
            'redirect' => false
        ) );
    }
    add_action( 'init', 'add_custom_options_page' );
}

function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');


function remove_admin_bar() {
    if (current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');

add_filter('use_block_editor_for_post', '__return_false', 10);

function smartwp_remove_wp_block_library_css() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css' );


add_filter( 'xmlrpc_enabled', '__return_false' );


function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}
add_filter( 'wp_headers', 'disable_x_pingback' );

// function remove_content_editor() {
//     if (isset($_GET['post'])) {
//         $id = $_GET['post'];
//         switch ($id) {
//             case 7:
//                 remove_post_type_support('page', 'editor');
//             break;
//         }
//     }
// }
// add_action('admin_head', 'remove_content_editor');

